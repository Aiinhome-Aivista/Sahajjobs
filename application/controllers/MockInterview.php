<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MockInterview extends CI_Controller
{
    private $mistral_url = 'http://122.163.121.176:3041/api/generate';
    private $mistral_model = 'mistral-small:24b';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mock_interview_model');
        $this->load->model('Menu_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('EmailService');
    }

    private function check_auth()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect(base_url() . '?showLogin=true');
        }
        return $user_id;
    }

    public function index()
    {
        $user_id = $this->check_auth();
        $data['menu'] = $this->Menu_model->get_menu();
        $data['user_name'] = $this->session->userdata('user_name') ?: 'Candidate';

        // Check if user has uploaded a CV
        $resume = $this->Mock_interview_model->get_user_resume($user_id);
        $data['has_uploaded_cv'] = !empty($resume);

        // Check if user has added skills to profile
        $skills = $this->Mock_interview_model->get_user_skills($user_id);
        $data['has_skills'] = !empty($skills);

        $data['profile_url'] = base_url('Profile');

        $session_history = $this->Mock_interview_model->get_user_sessions($user_id);
        $data['session_history'] = $session_history;
        $data['history_total'] = count($session_history);
        $scores = [];
        foreach ($session_history as $session) {
            if (isset($session['overall_score']) && is_numeric($session['overall_score'])) {
                $scores[] = floatval($session['overall_score']);
            }
        }
        $data['history_average_score'] = $scores ? round(array_sum($scores) / count($scores), 1) : 0;
        $data['history_best_score'] = $scores ? max($scores) : 0;
        $data['history_last_interview_date'] = $session_history ? $session_history[0]['created_at'] : null;

        $data['seo'] = (object) [
            'title' => 'Mock Interview - SahajJobs',
            'description' => 'Practice Soft Skill and Technical interviews with our AI-driven system.',
            'keywords' => 'mock interview, ai interview, soft skill, technical interview, job practice'
        ];

        $this->load->view('includes/login_header', $data);
        $this->load->view('mock_interview/start', $data);
        $this->load->view('includes/footer');
    }

    public function start()
    {
        $user_id = $this->check_auth();
        $mode = $this->input->post('mode') ?: 'hybrid';
        $this->session->set_userdata('interview_mode', $mode);

        $interview_type = $this->input->post('interview_type') ?: 'soft_skill';

        if ($interview_type === 'technical') {
            $resume = $this->Mock_interview_model->get_user_resume($user_id);
            $skills = $this->Mock_interview_model->get_user_skills($user_id);
            if (!$resume && empty($skills)) {
                $this->session->set_flashdata('error', 'You must upload a CV or add skills to your profile before starting a Technical Interview.');
                redirect(base_url('mock-interview'));
            }

            // Auto-extract CV details on-the-fly if missing in cv_details
            if ($resume) {
                $cv_details = $this->Mock_interview_model->get_cv_details($user_id);
                if (!$cv_details) {
                    $cv_text = $this->get_cv_text($user_id);
                    if ($cv_text) {
                        $prompt = "You are an expert resume parsing AI. Below is the text content extracted from a candidate's CV:
---
$cv_text
---

TASK: Extract the candidate's skills and projects from the CV text.
Format your response exactly as a JSON object with the following two keys:
1. 'skills': A comma-separated string listing all the technical skills, programming languages, databases, libraries, tools, and soft skills mentioned in the CV (e.g. \"Python, SQL, JavaScript, React, Git, Agile\").
2. 'projects': A string detailing the projects described in the CV. Keep the project description concise, clear, and formatted as neat bullet points or short paragraphs.

Do not include any introductory text, markdown formatting blocks (like ```json), or explanations. Return ONLY the raw JSON string.";

                        $extracted_json = $this->call_mistral($prompt);
                        if ($extracted_json) {
                            $clean_json = preg_replace('/^```(?:json)?\s*|```\s*$/i', '', trim($extracted_json));
                            $parsed_data = json_decode($clean_json, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                $skills_extracted = $parsed_data['skills'] ?? '';
                                $projects_extracted = $parsed_data['projects'] ?? '';
                                $this->load->model('Profile_model');
                                $this->Profile_model->save_cv_details($user_id, $cv_text, $skills_extracted, $projects_extracted);
                            }
                        }
                    }
                }
            }
        }

        $job_role = ($interview_type === 'technical') ? 'Technical Interview' : 'Soft Skill Interview';

        // 1. Get or create active plan
        $plan = $this->Mock_interview_model->get_active_plan($user_id, $job_role);
        if (!$plan) {
            $plan_id = $this->Mock_interview_model->create_plan($user_id, $job_role);
        } else {
            $plan_id = $plan['id'];
        }

        // 2. Create session
        $session_id = $this->Mock_interview_model->create_session($plan_id, $user_id);

        // 3. Generate first question using Mistral
        $first_question = $this->generate_first_question($job_role, $user_id);

        // 4. Save question
        $this->Mock_interview_model->add_question($session_id, $first_question, 1, $user_id);

        redirect(base_url('mock-interview/session/' . $session_id));
    }

    public function session($session_id)
    {
        $user_id = $this->check_auth();
        $session = $this->Mock_interview_model->get_session($session_id);

        if (!$session || $session['user_id'] != $user_id) {
            show_404();
        }

        $data['menu'] = $this->Menu_model->get_menu();
        $data['session'] = $session;
        $data['user_name'] = $this->session->userdata('user_name') ?: 'Candidate';

        // Fetch questions for this session
        $questions = $this->Mock_interview_model->get_questions($session_id);
        $data['questions'] = $questions;

        // Get the latest unanswered question
        $current_question = null;
        foreach ($questions as $q) {
            if ($q['candidate_response'] === null) {
                $current_question = $q;
                break;
            }
        }
        $data['current_question'] = $current_question;
        $data['interview_mode'] = $this->session->userdata('interview_mode') ?: 'text';

        $data['seo'] = (object) [
            'title' => 'Active Mock Interview - SahajJobs',
            'description' => 'Your mock interview is in progress.',
            'keywords' => 'mock interview, live interview'
        ];

        $this->load->view('includes/login_header', $data);
        $this->load->view('mock_interview/session', $data);
        $this->load->view('includes/footer');
    }

    public function submit_answer()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'error' => 'Not authenticated']);
            return;
        }

        $session_id = $this->input->post('session_id');
        $question_id = $this->input->post('question_id');
        $answer = $this->input->post('answer');
        $mode = $this->input->post('mode') ?: 'text';

        $session = $this->Mock_interview_model->get_session($session_id);
        if (!$session || $session['user_id'] != $user_id) {
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            return;
        }

        // Save answer
        $this->Mock_interview_model->save_answer($question_id, $answer, $mode);

        // Check total questions answered
        $questions = $this->Mock_interview_model->get_questions($session_id);
        $next_order = count($questions) + 1;

        // Get plan and job role
        $plan = $this->Mock_interview_model->get_plan($session['plan_id']);
        $job_role = $plan ? $plan['job_role'] : 'Soft Skill Interview';

        // Fetch next question from Mistral
        $next_question_text = $this->generate_next_question($questions, $job_role, $user_id);

        // Save next question in DB
        $next_question_id = $this->Mock_interview_model->add_question($session_id, $next_question_text, $next_order, $user_id);

        echo json_encode([
            'success' => true,
            'next_question' => [
                'id' => $next_question_id,
                'question_text' => $next_question_text,
                'question_order' => $next_order
            ]
        ]);
    }

    public function complete($session_id)
    {
        $user_id = $this->check_auth();
        $session = $this->Mock_interview_model->get_session($session_id);

        if (!$session || $session['user_id'] != $user_id) {
            show_404();
        }

        if ($session['status'] === 'started') {
            // Update status to complete
            $this->Mock_interview_model->update_session($session_id, [
                'status' => 'completed',
                'completed_at' => date('Y-m-d H:i:s')
            ]);

            // Get plan and job role
            $plan = $this->Mock_interview_model->get_plan($session['plan_id']);
            $job_role = $plan ? $plan['job_role'] : 'Soft Skill Interview';

            // Run evaluation
            $questions = $this->Mock_interview_model->get_questions($session_id);
            $eval = $this->evaluate_interview($questions, $job_role, $user_id);

            if (!$eval) {
                // Revert status to started so candidate can retry
                $this->Mock_interview_model->update_session($session_id, [
                    'status' => 'started',
                    'completed_at' => null
                ]);
                $this->session->set_flashdata('error', 'Evaluation failed due to an external service timeout or error. Please try again.');
                redirect(base_url('mock-interview'));
                return;
            }

            // Ensure evaluation text fields are strings (converting parsed JSON arrays if returned by LLM)
            foreach (['strengths', 'weaknesses', 'improvement_suggestions', 'feedback', 'summary'] as $key) {
                if (isset($eval[$key])) {
                    if (is_array($eval[$key])) {
                        $eval[$key] = implode("\n", array_map(function ($item) {
                            return is_array($item) ? json_encode($item) : trim($item);
                        }, $eval[$key]));
                    } else {
                        $eval[$key] = trim($eval[$key]);
                    }
                } else {
                    $eval[$key] = '';
                }
            }

            // Handle recommended_resources array and fallback logic
            $recommended_resources_array = [];
            if (isset($eval['recommended_resources'])) {
                if (is_array($eval['recommended_resources'])) {
                    $recommended_resources_array = $eval['recommended_resources'];
                } else if (is_string($eval['recommended_resources'])) {
                    $decoded = json_decode($eval['recommended_resources'], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $recommended_resources_array = $decoded;
                    }
                }
            }

            if (empty($recommended_resources_array)) {
                if ($job_role === 'Technical Interview') {
                    $skills = $this->Mock_interview_model->get_user_skills($user_id);
                    $cv_details = $this->Mock_interview_model->get_cv_details($user_id);
                    if (!empty($skills)) {
                        $skills_str = implode(', ', array_column($skills, 'skill_name'));
                    } else {
                        $skills_str = $cv_details ? ($cv_details['skills'] ?? '') : '';
                    }

                    $topic = 'generic';
                    $context_text = strtolower($skills_str);
                    foreach ($questions as $q) {
                        $context_text .= ' ' . strtolower($q['question_text'] ?? '');
                    }

                    if (strpos($context_text, 'java') !== false && strpos($context_text, 'javascript') === false && strpos($context_text, 'react') === false) {
                        $topic = 'java';
                    } elseif (strpos($context_text, 'python') !== false) {
                        $topic = 'python';
                    } elseif (strpos($context_text, 'ui') !== false || strpos($context_text, 'ux') !== false || strpos($context_text, 'design') !== false || strpos($context_text, 'figma') !== false) {
                        $topic = 'ui';
                    } elseif (strpos($context_text, 'react') !== false || strpos($context_text, 'javascript') !== false || strpos($context_text, 'html') !== false || strpos($context_text, 'css') !== false) {
                        $topic = 'web';
                    } elseif (strpos($context_text, 'qa') !== false || strpos($context_text, 'test') !== false || strpos($context_text, 'selenium') !== false) {
                        $topic = 'qa';
                    }

                    if ($topic === 'java') {
                        $recommended_resources_array = [
                            [
                                'title' => 'Oracle Java Documentation',
                                'type' => 'Official Documentation',
                                'description' => 'Official guides and API documentation for Java standard libraries.',
                                'url' => 'https://docs.oracle.com/en/java/'
                            ],
                            [
                                'title' => 'Baeldung Java Tutorials',
                                'type' => 'Tutorial',
                                'description' => 'Comprehensive, practical tutorials covering core Java and Spring frameworks.',
                                'url' => 'https://www.baeldung.com/'
                            ],
                            [
                                'title' => 'Spring Boot Documentation',
                                'type' => 'Official Documentation',
                                'description' => 'Official guides and reference documentation for building applications with Spring Boot.',
                                'url' => 'https://spring.io/projects/spring-boot'
                            ]
                        ];
                    } elseif ($topic === 'ui') {
                        $recommended_resources_array = [
                            [
                                'title' => 'Figma Learn Center',
                                'type' => 'Official Documentation',
                                'description' => 'Official design tutorials and documentation for Figma UI/UX tools.',
                                'url' => 'https://help.figma.com/'
                            ],
                            [
                                'title' => 'Interaction Design Foundation',
                                'type' => 'Online Course',
                                'description' => 'Industry-standard educational materials and design lessons for UX/UI practitioners.',
                                'url' => 'https://www.interaction-design.org/'
                            ],
                            [
                                'title' => 'Nielsen Norman Group',
                                'type' => 'Article',
                                'description' => 'Evidence-based user experience research, articles, and UI/UX design guidelines.',
                                'url' => 'https://www.nngroup.com/'
                            ]
                        ];
                    } elseif ($topic === 'web') {
                        $recommended_resources_array = [
                            [
                                'title' => 'MDN Web Docs',
                                'type' => 'Official Documentation',
                                'description' => 'Comprehensive resources and reference guides for HTML, CSS, and modern JavaScript.',
                                'url' => 'https://developer.mozilla.org/'
                            ],
                            [
                                'title' => 'React Documentation',
                                'type' => 'Official Documentation',
                                'description' => 'Official guides and interactive docs for React development.',
                                'url' => 'https://react.dev/'
                            ],
                            [
                                'title' => 'W3Schools CSS Tutorial',
                                'type' => 'Tutorial',
                                'description' => 'Easy-to-follow interactive reference for CSS styles, selectors, and layout mechanics.',
                                'url' => 'https://www.w3schools.com/'
                            ]
                        ];
                    } elseif ($topic === 'qa') {
                        $recommended_resources_array = [
                            [
                                'title' => 'Ministry of Testing',
                                'type' => 'Official Documentation',
                                'description' => 'A premier community platform containing guides, tutorials, and testing methodologies.',
                                'url' => 'https://www.ministryoftesting.com/'
                            ],
                            [
                                'title' => 'Guru99 Software Testing Tutorial',
                                'type' => 'Tutorial',
                                'description' => 'Comprehensive online tutorials covering manual and automated testing tools.',
                                'url' => 'https://www.guru99.com/software-testing.html'
                            ],
                            [
                                'title' => 'Selenium Documentation',
                                'type' => 'Official Documentation',
                                'description' => 'Official guides and reference docs for automated browser testing via Selenium.',
                                'url' => 'https://www.selenium.dev/documentation/'
                            ]
                        ];
                    } else {
                        // Python / default technical
                        $recommended_resources_array = [
                            [
                                'title' => 'Official Python Documentation',
                                'type' => 'Official Documentation',
                                'description' => 'Comprehensive guide for standard libraries, basic syntax, and data structures.',
                                'url' => 'https://docs.python.org/3/'
                            ],
                            [
                                'title' => 'Real Python Tutorials',
                                'type' => 'Tutorial',
                                'description' => 'Interactive and detailed tutorials covering core Python concepts and projects.',
                                'url' => 'https://realpython.com/'
                            ],
                            [
                                'title' => 'SQLBolt Interactive SQL',
                                'type' => 'Tutorial',
                                'description' => 'An interactive introduction to relational databases and basic SQL syntax.',
                                'url' => 'https://sqlbolt.com/'
                            ]
                        ];
                    }
                } else {
                    $recommended_resources_array = [
                        [
                            'title' => 'Toastmasters International',
                            'type' => 'Official Website',
                            'description' => 'Guidelines and workshops to improve public speaking and communications.',
                            'url' => 'https://www.toastmasters.org/'
                        ],
                        [
                            'title' => 'Coursera - Communication in the Workplace',
                            'type' => 'Online Course',
                            'description' => 'Course focused on modern communication skills and professional presentations.',
                            'url' => 'https://www.coursera.org/learn/communication-in-the-workplace'
                        ],
                        [
                            'title' => 'Indeed Career Guide',
                            'type' => 'Article',
                            'description' => 'Career guide for answering behavioral questions and soft-skills prep.',
                            'url' => 'https://www.indeed.com/career-advice/interviewing'
                        ]
                    ];
                }
            }

            // Save back into eval for email view sending
            $eval['recommended_resources'] = $recommended_resources_array;
            $recommended_resources_json = json_encode($recommended_resources_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            // Save results to database
            $update_data = [
                'overall_score' => $eval['overall_score'],
                'technical_score' => isset($eval['technical_score']) ? $eval['technical_score'] : $eval['overall_score'],
                'communication_score' => isset($eval['communication_score']) ? $eval['communication_score'] : $eval['overall_score'],
                'feedback' => $eval['feedback'],
                'strengths' => $eval['strengths'],
                'weaknesses' => $eval['weaknesses'],
                'improvement_suggestions' => $eval['improvement_suggestions'],
                'recommended_resources' => $recommended_resources_json,
                'summary' => $eval['summary']
            ];

            // Log final array before database update
            log_message('error', 'Final array before database update: ' . json_encode($update_data));

            $this->Mock_interview_model->update_session($session_id, $update_data);

            // Send Email to candidate
            $user = $this->Mock_interview_model->get_user_by_id($user_id);
            if ($user) {
                $this->send_result_email($user, $eval, $session_id);
            }
        }

        redirect(base_url('mock-interview/result/' . $session_id));
    }

    public function result($session_id)
    {
        $user_id = $this->check_auth();
        $session = $this->Mock_interview_model->get_session($session_id);

        if (!$session || $session['user_id'] != $user_id) {
            show_404();
        }

        // Get plan and job role
        $plan = $this->Mock_interview_model->get_plan($session['plan_id']);
        $job_role = $plan ? $plan['job_role'] : 'Soft Skill Interview';

        $recommended = [];
        if (!empty($session['recommended_resources'])) {
            $decoded = json_decode($session['recommended_resources'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $recommended = $decoded;
            }
        }

        $data['menu'] = $this->Menu_model->get_menu();
        $data['session'] = $session;
        $data['questions'] = $this->Mock_interview_model->get_questions($session_id);
        $data['user_name'] = $this->session->userdata('user_name') ?: 'Candidate';
        $data['job_role'] = $job_role;
        $data['recommended_resources'] = $recommended;

        $data['seo'] = (object) [
            'title' => 'Interview Results - SahajJobs',
            'description' => 'View feedback and scores for your mock interview.',
            'keywords' => 'mock interview result, feedback'
        ];

        $this->load->view('includes/login_header', $data);
        $this->load->view('mock_interview/result', $data);
        $this->load->view('includes/footer');
    }

    public function history()
    {
        $user_id = $this->check_auth();
        $data['menu'] = $this->Menu_model->get_menu();
        $data['user_name'] = $this->session->userdata('user_name') ?: 'Candidate';

        $session_history = $this->Mock_interview_model->get_user_sessions($user_id);
        $data['session_history'] = $session_history;
        $data['history_total'] = count($session_history);

        $scores = [];
        foreach ($session_history as $session) {
            if (isset($session['overall_score']) && is_numeric($session['overall_score'])) {
                $scores[] = floatval($session['overall_score']);
            }
        }
        $data['history_average_score'] = $scores ? round(array_sum($scores) / count($scores), 1) : 0;
        $data['history_best_score'] = $scores ? max($scores) : 0;
        $data['history_last_interview_date'] = $session_history ? $session_history[0]['created_at'] : null;

        $data['seo'] = (object) [
            'title' => 'Interview History - SahajJobs',
            'description' => 'Review all your completed mock interviews.',
            'keywords' => 'mock interview history, records'
        ];

        $this->load->view('includes/login_header', $data);
        $this->load->view('mock_interview/history', $data);
        $this->load->view('includes/footer');
    }

    /* LLM Calls and Parsers */

    private function get_cv_text($user_id)
    {
        $resume = $this->Mock_interview_model->get_user_resume($user_id);
        if (!$resume) {
            return null;
        }

        $resume_path = FCPATH . $resume['file_path'];
        if (!file_exists($resume_path)) {
            $resume_path = FCPATH . 'ALL_UPLOADS/resumes/' . $resume['file_name'];
        }

        if (!file_exists($resume_path)) {
            return null;
        }

        // $python = escapeshellarg(FCPATH . 'venv\\Scripts\\python.exe');
        // $python_script = escapeshellarg(APPPATH . 'helpers\\parse_resume.py');
        // $escaped_path = escapeshellarg($resume_path);

        // $command = "$python $python_script $escaped_path 2>&1";
        
        $python = escapeshellarg('/home/capdpgtz/sahajjobs.com/venv/bin/python');
        $python_script = escapeshellarg('/home/capdpgtz/sahajjobs.com/application/helpers/parse_resume.py');
        $escaped_path = escapeshellarg($resume_path);

        $command = "$python $python_script $escaped_path 2>&1";
        
        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);

        if ($return_var === 0) {
            return trim(implode("\n", $output));
        }

        return null;
    }

    private function generate_first_question($job_role, $user_id)
    {
        if ($job_role === 'Technical Interview') {
            $skills = $this->Mock_interview_model->get_user_skills($user_id);
            $cv_details = $this->Mock_interview_model->get_cv_details($user_id);

            if (!empty($skills)) {
                $skills_str = implode(', ', array_column($skills, 'skill_name'));
            } else {
                $skills_str = $cv_details ? ($cv_details['skills'] ?? '') : '';
            }

            if (!empty($skills_str)) {
                $all_skills = array_filter(array_map('trim', explode(',', $skills_str)));
                $target_skill = !empty($all_skills) ? reset($all_skills) : '';

                $prompt = "You are a strict technical interviewer.

Target Skill: $target_skill

Candidate Skills:
$skills_str

IMPORTANT RULES:

You MUST generate the first interview question directly about the target skill: $target_skill.

You are ONLY allowed to ask direct technical questions about the target skill: $target_skill.

Do NOT ask the candidate to describe a project, talk about a project they worked on, explain the architecture of their project, or reference their personal project experience in any way.

Do NOT use phrases like \"tell me about your project\", \"describe a project\", \"explain a project where you used...\", or \"in your project\".

You are NOT allowed to ask questions about any other programming language, framework, database, cloud technology, networking concept, operating system, computer science subject, or software tool that is not explicitly present above.

Do not infer missing skills, assume technologies, or expand to related technologies.

Every question must directly reference the target skill.

QUESTION VARIETY RULES:
- The question should be conceptual, introducing the target skill: $target_skill.
- Do NOT generate questions using patterns like \"What is the difference between...\" or \"Can you explain the difference between...\".
- Do NOT ask generic technical questions.

Ask only ONE warm, introductory technical question based on $target_skill. Do not include any introductory remarks. Just output the question text directly.";
            } else {
                $cv_text = $this->get_cv_text($user_id);
                if ($cv_text) {
                    $prompt = "You are an expert Technical interviewer. You are conducting a Technical mock interview with a candidate.
Below is the candidate's CV content:
---
$cv_text
---
CRITICAL REQUIREMENT: You MUST generate the first interview question based directly on the specific technologies, programming languages, libraries, frameworks, coding projects, or work experiences explicitly listed in the candidate's CV above.
Please construct the question according to these patterns:
- Ask about core language/framework concepts, features, or differences (e.g. data types, list vs tuple, primary keys, indexing, etc.).
- Ask about memory management, execution lifecycle, or architecture.
- Ask candidate to write a simple code snippet or query (e.g. finding duplicates, finding second highest salary).
- Ask combined/practical integration questions based on technologies and projects in their CV (e.g. database connectivity, fetching records).

Ask only ONE warm, introductory technical question based on their CV. Do not include any introductory remarks. Just output the question text directly.";
                } else {
                    $prompt = "You are an expert Technical interviewer. You are conducting a Technical mock interview with a candidate.
Generate the FIRST interview question. It should be a warm, introductory technical question, such as asking the candidate about their preferred programming language, a technical project they worked on, or their technical background.
Ask only ONE question. Do not include any introductory remarks. Just output the question text directly.";
                }
            }

            // Dynamic fallback question based on candidate's actual skills
            $skills_arr = !empty($skills) ? array_column($skills, 'skill_name') : ($cv_details ? explode(',', $cv_details['skills']) : []);
            $skills_arr = array_filter(array_map('trim', $skills_arr));
            if (!empty($skills_arr)) {
                $fallback = "What are the core features and use cases of " . $skills_arr[0] . "?";
            } else {
                $fallback = "What are the key advantages of your preferred programming language?";
            }
        } else {
            $prompt = "You are an expert HR and soft skills interviewer. You are conducting a Soft Skill mock interview with a candidate.
Generate the FIRST interview question. It should be a standard, warm, introductory soft skills or HR question, such as asking the candidate to introduce themselves or talk about their background.
Ask only ONE question. Do not include any introductory remarks. Just output the question text directly.";
            $fallback = "Tell me about yourself and what brings you to this career path.";
        }

        $response = $this->call_mistral($prompt);
        if ($response) {
            return $response;
        }

        return $fallback;
    }

    private function generate_next_question($questions, $job_role, $user_id)
    {
        $transcript = "";
        foreach ($questions as $q) {
            $transcript .= "Interviewer: " . $q['question_text'] . "\n";
            $transcript .= "Candidate: " . ($q['candidate_response'] ?: "(No response)") . "\n";
        }

        if ($job_role === 'Technical Interview') {
            $skills = $this->Mock_interview_model->get_user_skills($user_id);
            $cv_details = $this->Mock_interview_model->get_cv_details($user_id);

            if (!empty($skills)) {
                $skills_str = implode(', ', array_column($skills, 'skill_name'));
            } else {
                $skills_str = $cv_details ? ($cv_details['skills'] ?? '') : '';
            }

            if (!empty($skills_str)) {
                // Determine target skill deterministically
                $all_skills = array_filter(array_map('trim', explode(',', $skills_str)));
                $used_skills = [];
                if (!empty($questions)) {
                    foreach ($questions as $q) {
                        $q_text = strtolower($q['question_text']);
                        foreach ($all_skills as $s) {
                            $s_clean = strtolower($s);
                            if (strpos($q_text, $s_clean) !== false) {
                                if (!in_array($s, $used_skills)) {
                                    $used_skills[] = $s;
                                }
                            }
                        }
                    }
                }

                $unused_skills = array_diff($all_skills, $used_skills);
                if (empty($unused_skills)) {
                    if (!empty($all_skills)) {
                        $skill_counts = array_fill_keys($all_skills, 0);
                        foreach ($questions as $q) {
                            $q_text = strtolower($q['question_text']);
                            foreach ($all_skills as $s) {
                                if (strpos($q_text, strtolower($s)) !== false) {
                                    $skill_counts[$s]++;
                                }
                            }
                        }
                        asort($skill_counts);
                        reset($skill_counts);
                        $target_skill = key($skill_counts);
                    } else {
                        $target_skill = '';
                    }
                } else {
                    $target_skill = reset($unused_skills);
                }

                $prompt = "You are a strict technical interviewer. Below is the transcript of the ongoing Technical mock interview with a candidate:
$transcript

Target Skill: $target_skill

Candidate Skills:
$skills_str

IMPORTANT RULES:

You MUST ask the next question directly about the target skill: $target_skill.

You are ONLY allowed to ask direct technical questions about the target skill: $target_skill.

Do NOT ask the candidate to describe a project, talk about a project they worked on, explain the architecture of their project, or reference their personal project experience in any way.

Do NOT use phrases like \"tell me about your project\", \"describe a project\", \"explain a project where you used...\", or \"in your project\".

You are NOT allowed to ask questions about any other programming language, framework, database, cloud technology, networking concept, operating system, computer science subject, or software tool that is not explicitly present above.

Do not infer missing skills, assume technologies, or expand to related technologies.

QUESTION VARIETY & NO REPETITION RULES:
- Examine the transcript above. Do NOT ask the same question, question pattern, or focus on the same aspect/topic that has already been asked in the transcript.
- Do NOT generate questions using patterns like \"What is the difference between...\" or \"Can you explain the difference between...\".
- Vary the question type. The next question should focus on one of the following types, ensuring it is DIFFERENT from the question types and patterns used in the transcript so far:
  1. Conceptual questions (theory/mechanics)
  2. Scenario-based questions (conceptual scenarios, not candidate projects)
  3. Practical coding questions (e.g. write a code snippet, SQL query)
  4. Debugging questions (e.g. locate a bug in a hypothetical scenario)
  5. Best practices
  6. Performance optimization
  7. Real-world problem-solving questions
  8. API/design questions (where applicable)
- Each question must be unique and must focus on a different aspect of the target skill: $target_skill.

Based on the transcript above, ask only ONE next relevant Technical question based on $target_skill. Do not answer it yourself. Do not output any meta-text or explanations. Just output the next question text directly.";
            } else {
                $cv_text = $this->get_cv_text($user_id);
                if ($cv_text) {
                    $prompt = "You are an expert Technical interviewer. Below is the transcript of the ongoing Technical mock interview with a candidate:
$transcript

Here is the candidate's CV content:
---
$cv_text
---
CRITICAL REQUIREMENT: You MUST ask the next relevant Technical question based directly on the candidate's CV and the ongoing transcript.
Construct the question following these patterns:
- Ask about core language/framework concepts, features, or differences (e.g. data types, list vs tuple, primary keys, indexing, etc.).
- Ask about memory management, execution lifecycle, or architecture.
- Ask candidate to write a simple code snippet or query (e.g. finding duplicates, finding second highest salary).
- Ask combined/practical integration questions based on technologies and projects in their CV (e.g. database connectivity, database fetching, query optimization).

Ask only ONE question. Do not answer it yourself. Do not output any meta-text or explanations. Just output the next question text directly.";
                } else {
                    $prompt = "You are an expert Technical interviewer. Below is the transcript of the ongoing Technical mock interview with a candidate:
$transcript
Based on the transcript above, ask the next relevant Technical question (e.g., asking about coding logic, algorithms, system design, databases, debugging, or technical problem solving).
Ask only ONE question. Do not answer it yourself. Do not output any meta-text or explanations. Just output the next question text directly.";
                }
            }

            // Dynamic fallback questions based on candidate's actual skills
            $skills_arr = !empty($skills) ? array_column($skills, 'skill_name') : ($cv_details ? explode(',', $cv_details['skills']) : []);
            $skills_arr = array_filter(array_map('trim', $skills_arr));
            if (!empty($skills_arr) && !empty($target_skill)) {
                $fallbacks = [
                    "Can you explain a key concept in " . $target_skill . " that is crucial for building applications?",
                    "What are some common debugging techniques you use when working with " . $target_skill . "?",
                    "How do you manage exceptions and error handling in " . $target_skill . "?",
                    "How do you optimize performance when using " . $target_skill . "?",
                    "What are the best practices for structuring code in " . $target_skill . "?"
                ];
            } else {
                $fallbacks = [
                    "What is the difference between an abstract class and an interface?",
                    "How would you optimize a slow database query?",
                    "Explain the concept of RESTful APIs and how you secure them.",
                    "How do you handle error logging and exception handling in your code?",
                    "What are some design patterns you have used in your previous projects?"
                ];
            }
        } else {
            $prompt = "You are an expert HR and soft skills interviewer. Below is the transcript of the ongoing Soft Skill mock interview with a candidate:
$transcript
Based on the transcript above, ask the next relevant soft skill or behavioral question (e.g., about teamwork, resolving conflicts, meeting deadlines, adaptability, or strengths).
Ask only ONE question. Do not answer it yourself. Do not output any meta-text or explanations. Just output the next question text directly.";

            $fallbacks = [
                "Why are you interested in joining our company?",
                "What do you consider to be your greatest strengths and weaknesses?",
                "Describe a challenging work or academic situation and how you handled it.",
                "Where do you see yourself in five years?",
                "How do you handle conflict or differing opinions with team members?",
                "How do you handle tight deadlines or stressful situations?"
            ];
        }

        $response = $this->call_mistral($prompt);
        if ($response) {
            return $response;
        }

        $index = count($questions) - 1;
        if ($index >= count($fallbacks)) {
            $index = $index % count($fallbacks);
        }
        return $fallbacks[$index];
    }

    private function evaluate_interview($questions, $job_role, $user_id)
    {
        $transcript = "";
        $questions_asked = count($questions);
        $questions_answered = 0;
        $total_length = 0;

        foreach ($questions as $q) {
            $transcript .= "Interviewer: " . $q['question_text'] . "\n";
            $response_trimmed = trim($q['candidate_response'] ?: '');
            $transcript .= "Candidate: " . ($response_trimmed ?: "(No response)") . "\n";
            if (!empty($response_trimmed)) {
                $questions_answered++;
                $total_length += strlen($response_trimmed);
            }
        }

        $evaluator_type = ($job_role === 'Technical Interview') ? "Technical evaluator" : "HR/Soft Skills evaluator";
        $interview_type_label = ($job_role === 'Technical Interview') ? "Technical mock interview" : "Soft Skill mock interview";
        $skill_criterion = ($job_role === 'Technical Interview') ? "Technical Depth: Demonstrating correct engineering concepts, logic, and coding knowledge." : "Communication Skills: Clarity, fluency, confidence, and professionalism.";

        $cv_context = "";
        if ($job_role === 'Technical Interview') {
            $skills = $this->Mock_interview_model->get_user_skills($user_id);
            if (!empty($skills)) {
                $skills_list = implode(', ', array_column($skills, 'skill_name'));
                $cv_context = "\nCandidate's Profile Skills:\n---\n$skills_list\n---\n";
            } else {
                $cv_text = $this->get_cv_text($user_id);
                if ($cv_text) {
                    $cv_context = "\nCandidate's CV:\n---\n$cv_text\n---\n";
                }
            }
        }

        $prompt = "You are an expert $evaluator_type. Evaluate the following transcript of a $interview_type_label:
$transcript
$cv_context

Please compare each candidate response with its corresponding question and assess how accurately it answers the question.
You must evaluate the candidate's performance based strictly on the following five criteria:
1. Accuracy: Correctness of the answer in relation to the question.
2. Relevance: Whether the answer directly addresses the question asked.
3. Technical/Subject Knowledge: Understanding of the concepts and practical applications.
4. Explanation Quality: Clarity, logical reasoning, and structure.
5. Overall Performance: General quality and consistency across the interview.

SCORING RULES (You must decide the scores based strictly on these rules):
- Correct and detailed answers -> high score (80-100)
- Partially correct/average answers -> medium score (50-79)
- Wrong, highly inaccurate, or empty answers -> low score (11-49)
- Random keyboard inputs, gibberish (e.g. 'nbgh', 'fgjhb', 'fbcv'), or completely irrelevant answers -> score between 0 and 10

Generate a single Overall Score (0-100), a Technical Score (0-100), and a Communication Score (0-100) representing the candidate's performance.

In addition to the main evaluation keys, you MUST dynamically generate between 3 and 8 personalized learning resources, documentation, tutorials, courses, and official websites in the \"recommended_resources\" JSON field based on the candidate's weak areas, incorrectly/poorly answered questions, and skills/concepts needing improvement in this session.
For each recommended resource, you MUST provide:
- \"title\": The specific title of the resource.
- \"type\": The type (e.g. \"Official Documentation\", \"Tutorial\", \"YouTube Video\", \"Article\", \"Online Course\").
- \"description\": A short description explaining why it is recommended based on the candidate's performance.
- \"url\": A valid, active, clickable URL to the resource.

CRITICAL RESOURCE MATCHING RULES:
- You MUST select resources that match the specific tech stack, programming language, or skill topic actually discussed in the interview transcript.
- If the transcript is about Java, recommend Java resources (do NOT recommend Python). If it is about UI/UX or design, recommend UI/UX or Figma resources. If it is about Web Development or JavaScript/React, recommend React/JavaScript/Web resources. If it is about Python, recommend Python resources. If it is about QA or testing, recommend Software Testing/QA resources.
- NEVER recommend Python resources for a Java, UI/UX, or other non-Python interviews under any circumstances.

Follow these resource guidelines when selecting links:
- Technical (Python): Prefer Official Python Documentation (https://docs.python.org/3/), Real Python (https://realpython.com/), FastAPI Documentation (https://fastapi.tiangolo.com/), or Django Documentation (https://www.djangoproject.com/).
- Technical (SQL/PostgreSQL): Prefer SQLBolt (https://sqlbolt.com/) or PostgreSQL Documentation (https://www.postgresql.org/docs/).
- Technical (Java): Prefer Oracle Java Documentation (https://docs.oracle.com/en/java/), Baeldung (https://www.baeldung.com/), or Spring Boot Documentation (https://spring.io/projects/spring-boot).
- Technical (UI/UX Design): Prefer Figma Learn (https://help.figma.com/), Interaction Design Foundation (https://www.interaction-design.org/), or Nielsen Norman Group (https://www.nngroup.com/).
- Technical (Web Development / JavaScript / React): Prefer MDN Web Docs (https://developer.mozilla.org/), React Documentation (https://react.dev/), or W3Schools (https://www.w3schools.com/).
- Technical (QA / Software Testing): Prefer Ministry of Testing (https://www.ministryoftesting.com/), Guru99 Testing (https://www.guru99.com/software-testing.html), or Selenium Documentation (https://www.selenium.dev/documentation/).
- Soft Skills: Prefer Toastmasters International (https://www.toastmasters.org/), Coursera Communication Skills (https://www.coursera.org/specializations/improve-english), Harvard Business Review (https://hbr.org/), or MindTools (https://www.mindtools.com/).
- HR Interview: Prefer LinkedIn Interview Prep (https://www.linkedin.com/interview-prep), Indeed Career Guide (https://www.indeed.com/career-advice/interviewing), or Glassdoor Interview Guide (https://www.glassdoor.com/blog/guide/interview-questions/).
Ensure all URLs are real, active links. Do not output placeholders.

The output MUST be a valid JSON object with the following keys and structure:
{
  \"overall_score\": [integer between 0 and 100],
  \"technical_score\": [integer between 0 and 100],
  \"communication_score\": [integer between 0 and 100],
  \"feedback\": \"[General feedback of the interview]\",
  \"strengths\": \"[List of candidate's strengths based on answers]\",
  \"weaknesses\": \"[List of candidate's weaknesses or areas of improvement]\",
  \"improvement_suggestions\": \"[Clear, actionable tips for candidate to improve]\",
  \"recommended_resources\": [
     {
        \"title\": \"[Resource Title]\",
        \"type\": \"[Resource Type]\",
        \"description\": \"[Short Description]\",
        \"url\": \"[Clickable URL]\"
     }
  ],
  \"summary\": \"[A meaningful, professional interviewer summary of exactly 3–4 lines (no more than 4 lines, approximately 50–70 words) written as a single well-structured paragraph. You must strictly follow these instructions: 1. State that the candidate attempted $questions_answered of the $questions_asked questions asked. 2. Evaluate overall communication quality (clarity, confidence, relevance) and note whether answers were detailed or too brief. 3. Reference the overall performance level based on the overall_score. 4. Describe 1 major strength and 1 area that needs improvement. 5. Provide a concluding sentence detailing the candidate's overall mock interview readiness. 6. Base the evaluation strictly on the interview transcript and evaluation data without hallucinating/inventing info. 7. Use a professional recruiter/HR tone and do not use bullet points. 8. Do NOT use generic filler phrases like 'The candidate completed a mock interview', 'The interview has ended', 'The candidate completed a Soft Skill mock interview', or 'The candidate participated in the interview'. Example styles: *Low performance*: 'The candidate attempted 2 out of 5 questions, but responses were extremely brief. Answers did not demonstrate structured thinking or clear communication. There was limited evidence of readiness, and they would benefit from preparing responses with real-world examples.' *Average performance*: 'The candidate answered 4 out of 5 questions, demonstrating a basic understanding. Responses addressed the questions but lacked depth and practical examples. Communication was generally clear, but delivery could be more structured. With more preparation, performance can be enhanced.' *Strong performance*: 'The candidate answered all 5 questions with clear, structured, and relevant responses. They communicated confidently and supported their answers with practical examples. Performance indicates solid interview readiness with only minor areas for refinement.']\"
}";

        // Set script execution time limit to prevent PHP timeouts
        @set_time_limit(120);

        // Log the exact prompt being sent (using error level to guarantee it appears in log threshold = 1)
        log_message('error', 'Mistral AI Prompt: ' . $prompt);

        $response = $this->call_mistral($prompt);
        $eval_data = null;
        if ($response) {
            $json_str = trim($response);

            // Log raw response text for inspection
            log_message('error', 'Mistral AI response text to parse: ' . $json_str);

            // Find first and last brace positions to reliably isolate the JSON object
            $first_brace = strpos($json_str, '{');
            $last_brace = strrpos($json_str, '}');
            if ($first_brace !== false && $last_brace !== false && $last_brace > $first_brace) {
                $json_str = substr($json_str, $first_brace, $last_brace - $first_brace + 1);
            }

            $eval_data = json_decode($json_str, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'Failed to decode json response: ' . json_last_error_msg());
            }
        }

        // Normalize keys case-insensitively and space-insensitively
        if (is_array($eval_data)) {
            $normalized = [];
            foreach ($eval_data as $k => $v) {
                $clean_key = strtolower(str_replace([' ', '_', '-'], '', $k));
                $normalized[$clean_key] = $v;
            }

            $key_mappings = [
                'overall_score' => 'overallscore',
                'technical_score' => 'technicalscore',
                'communication_score' => 'communicationscore',
                'feedback' => 'feedback',
                'strengths' => 'strengths',
                'weaknesses' => 'weaknesses',
                'improvement_suggestions' => 'improvementsuggestions',
                'recommended_resources' => 'recommendedresources',
                'summary' => 'summary'
            ];

            foreach ($key_mappings as $target => $clean) {
                if (isset($normalized[$clean])) {
                    $eval_data[$target] = $normalized[$clean];
                }
            }
        }

        // Log the parsed JSON evaluation object
        log_message('error', 'Parsed JSON Evaluation Object: ' . json_encode($eval_data));

        // Return null if evaluation failed or score is missing (NO manual fallbacks or fake scores allowed)
        if (!$eval_data || !isset($eval_data['overall_score'])) {
            log_message('error', 'LLM Evaluation failed or was invalid. No fallback generated.');
            return null;
        }

        // Return the raw scores directly as generated by the LLM
        $eval_data['overall_score'] = isset($eval_data['overall_score']) ? intval($eval_data['overall_score']) : 0;
        $eval_data['technical_score'] = isset($eval_data['technical_score']) ? intval($eval_data['technical_score']) : $eval_data['overall_score'];
        $eval_data['communication_score'] = isset($eval_data['communication_score']) ? intval($eval_data['communication_score']) : $eval_data['overall_score'];

        return $eval_data;
    }

    private function call_mistral($prompt)
    {
        $data = [
            'model' => $this->mistral_model,
            'prompt' => $prompt,
            'stream' => false
        ];

        $ch = curl_init($this->mistral_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); // Connect timeout separately from execution timeout
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);         // Execution timeout
        $response = curl_exec($ch);

        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            log_message('error', 'Mistral API Error (HTTP Code: ' . $http_code . '): ' . curl_error($ch));
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        // Log the raw HTTP response from the server before parsing
        log_message('error', 'Mistral AI Raw HTTP Response (HTTP Code: ' . $http_code . '): ' . $response);

        $json = json_decode($response, true);
        return isset($json['response']) ? trim($json['response']) : null;
    }

    private function send_result_email($user, $eval, $session_id)
    {
        $ci =& get_instance();
        $emailContent = $ci->load->view("emails/interview_result", [
            'name' => $user['full_name'],
            'score' => $eval['overall_score'],
            'summary' => $eval['summary'],
            'feedback' => $eval['feedback'],
            'strengths' => $eval['strengths'],
            'weaknesses' => $eval['weaknesses'],
            'suggestions' => $eval['improvement_suggestions'],
            'recommended_resources' => isset($eval['recommended_resources']) ? $eval['recommended_resources'] : [],
            'result_link' => base_url('mock-interview/result/' . $session_id)
        ], TRUE);

        $subject = 'Your Mock Interview Result: ' . $eval['overall_score'] . '/100';
        $this->emailservice->sendEmail($user['email'], $subject, $emailContent);
    }
}
