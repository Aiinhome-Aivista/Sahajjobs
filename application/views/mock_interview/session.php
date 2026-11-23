<div class="mock-interview-wrapper"
    style="min-height: calc(100vh - 70px); display: flex; align-items: center; justify-content: space-between; padding: 30px 20px; font-family: 'Nunito', sans-serif; color: #333;">
    <div style="position: relative; top: -10%; left: 20%; display: flex; padding: 0; margin: 0;">
        <div
            style="position: relative; top: -8rem; left: calc(25% + 0.5in); align-items: center; justify-content: space-between;  padding: 0; margin: 0;">
            <div class="welcome_massage">
                <span style="font-size: 66px; font-weight: 800; color: #000000; line-height: 1.2; margin-bottom: 4px;">
                    <?= htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?>
                </span>
            </div>
            <!-- Timer Area -->
            <div id="timerContainer"
                style="display: inline-flex; align-items: center; justify-content: center; background: rgba(255, 255, 255, 0.25); padding: 10px 24px; border-radius: 8px; border: 1px solid rgba(16, 185, 129, 0.25); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(12px); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">
                <i id="timerIcon" class="fas fa-hourglass-half"
                    style="display: none; color: #10b981; font-size: 40px; animation: pulse 1s infinite alternate;"></i>
                <span id="timerText"
                    style="font-family: 'Nunito', sans-serif; font-size: 48px; font-weight: 800; color: #10b981; transition: all 0.3s ease; letter-spacing: 1px; line-height: 1;">02
                    : 00</span>
            </div>
        </div>
    </div>


    <div class="glass-container"
        style="backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(18px); margin-right: 80px; border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 20px; max-width: 754px; width: 100%; padding: 40px; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15); position: relative; overflow: hidden; animation: slideUp 0.6s ease-out; box-sizing: border-box;">

        <!-- Background decorative glows -->
        <div
            style="position: absolute; top: -10%; left: -10%; width: 250px; height: 250px; background: rgba(255, 244, 79, 0.03); filter: blur(80px); border-radius: 50%; pointer-events: none;">
        </div>
        <div
            style="position: absolute; bottom: -10%; right: -10%; width: 250px; height: 250px; background: rgba(168, 85, 247, 0.03); filter: blur(80px); border-radius: 50%; pointer-events: none;">
        </div>

        <!-- Dialogue Area (WhatsApp-style chat) -->
        <div style="margin-bottom: 20px;">
            <div id="chatDialogue"
                style="max-height: 380px; min-height: 220px; overflow-y: auto; display: flex; flex-direction: column; gap: 20px; padding: 12px 8px; scroll-behavior: smooth;">

                <!-- Initial interviewer question bubble (rendered server-side) -->
                <div class="chat-msg interviewer-msg" data-question-id="<?= $current_question['id']; ?>"
                    style="display: flex; gap: 14px; align-items: flex-start;">
                    <div
                        style="background: linear-gradient(135deg, #27365c 0%, #ffd500 100%); border-radius: 50%; padding: 10px; width: 40px; height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(39, 54, 92, 0.15); flex-shrink: 0; box-sizing: border-box;">
                        <i class="fas fa-user-tie" style="font-size: 18px; color: #fff;"></i>
                    </div>
                    <div class="bubble-content"
                        style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 14px 18px; border-radius: 4px 16px 16px 16px; max-width: calc(100% - 108px); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                            <p class="q-text"
                                style="margin: 0; font-size: 16px; line-height: 1.5; font-weight: 500; color: #1e293b;">
                                <?= htmlspecialchars($current_question['question_text'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <button type="button" class="speak-btn" onclick="speakBubble(this)"
                                style="flex-shrink: 0; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #ca8a04; transition: all 0.2s;"
                                title="Listen to question"
                                onmouseover="this.style.background='#fefce8'; this.style.color='#854d0e';"
                                onmouseout="this.style.background='#ffffff'; this.style.color='#ca8a04';">
                                <i class="fas fa-volume-up"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Right spacer to balance layout and align right boundaries -->
                    <div style="width: 40px; min-width: 40px; height: 40px; flex-shrink: 0; margin-left: auto;"></div>
                </div>

            </div>

            <!-- Speech/Typing Loader Indicator -->
            <div id="aiLoader"
                style="display: none; align-items: center; gap: 10px; margin-left: 8px; margin-top: 15px;">
                <span style="font-size: 14px; color: #64748b; font-weight: 500;">Analyzing and generating next
                    question...</span>
                <div class="typing-dots">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>

        <!-- Input Section -->
        <div id="responseFormSection" style="position: relative;">
            <input type="hidden" id="currentQuestionId" value="<?= $current_question['id']; ?>">

            <div style="margin-bottom: 25px; padding: 0 8px;">
                <!-- <label for="candidateAnswer"
                    style="display: block; font-size: 14px; font-weight: 800; color: #1e293b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px;">Your
                    Response</label> -->

                <div style="position: relative; display: flex; gap: 14px; align-items: flex-start;">
                    <!-- Avatar Emoji -->
                    <div
                        style="background: #e2e8f0; border-radius: 50%; width: 40px; height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border: 1px solid #cbd5e1; margin-top: 5px;">
                        👨‍💻
                    </div>

                    <div style="position: relative; display: flex; flex-direction: column; flex-grow: 1;">
                        <!-- Textarea & Mic Row -->
                        <div style="display: flex; gap: 14px; align-items: center; width: 100%;">
                            <!-- Textarea -->
                            <textarea id="candidateAnswer"
                                placeholder="Type your response here or click the microphone to speak..."
                                style="flex-grow: 1; height: 50px; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 12px 15px; color: #0f172a; font-size: 16px; line-height: 1.5; resize: none; outline: none; transition: height 0.3s ease, border-color 0.3s ease; box-sizing: border-box;"
                                onfocus="this.style.height='120px'; this.style.borderColor='#FFF44F';"
                                onblur="this.style.borderColor='#cbd5e1'; if(this.value.trim() === '') this.style.height='50px';"></textarea>

                            <!-- Mic Button outside Textarea -->
                            <button type="button" id="micBtn" onclick="toggleListening()"
                                style="width: 40px; height: 40px; min-width: 40px; border-radius: 50%; border: none; background: #f5e602; color: #333; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); transition: all 0.3s; position: relative; flex-shrink: 0;">
                                <i class="fas fa-microphone-slash" id="micIcon"></i>
                                <!-- Listening waves -->
                                <span class="mic-wave"
                                    style="display:none; position: absolute; top: -4px; left: -4px; right: -4px; bottom: -4px; border-radius: 50%; border: 2px solid #22c55e; opacity: 0.6; animation: scaleWave 1.2s infinite;"></span>
                            </button>
                        </div>

                        <!-- Voice Controls Status (displayed right below the textarea) -->
                        <div id="voiceControlPanel"
                            style="display: flex; align-items: center; gap: 8px; margin-top: 8px; font-size: 13px;">
                            <span id="voiceStatus" style="font-weight: 700; color: #ef4444;">Microphone Off</span>
                            <span style="color: rgba(0, 0, 0, 0.15)">|</span>
                            <span id="voiceInstruction" style="color: #64748b;">Click the microphone to speak your
                                response</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons bar -->
            <div style="display: flex; align-items: center; justify-content: end;">

                <!-- submit (Brand Yellow) -->
                <button type="button" id="submitAnswerBtn" onclick="submitAnswer()"
                    style="background: #FFF44F; border: none; border-radius: 30px; color: #27365c; font-size: 15px; font-weight: 700; padding: 12px 30px; cursor: pointer; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06); display: flex; align-items: center; gap: 8px; transition: all 0.2s; margin-right: 65px;"
                    onmouseover="this.style.background='#ffd500'; this.style.transform='translateY(-1px)';"
                    onmouseout="this.style.background='#FFF44F'; this.style.transform='none';" disabled>
                    <span> Continue</span>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>

        <!-- Evaluation Screen Overlay -->
        <div id="evaluationOverlay"
            style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(18px); -webkit-backdrop-filter: blur(12px); z-index: 100; align-items: center; justify-content: center; flex-direction: column; text-align: center;">
            <div
                style="position:relative;width:100px;height:100px;margin-bottom:25px;display:flex;align-items:center;justify-content:center;">

                <!-- Rotating Loader -->
                <div
                    style="position:absolute;width:100%;height:100%;border:4px solid rgba(39,54,92,0.15);border-top:4px solid #FFF44F;border-radius:50%;animation:spin 1s linear infinite;">
                </div>

                <!-- Fixed Logo -->
                <img src="<?= base_url('ALL_UPLOADS/images/favicon.ico'); ?>" alt="Logo"
                    style="width:70px;height:70px;border-radius:50%;background:#fff;padding:4px;object-fit:cover;z-index:2;">

            </div>
            <h2 style="font-size: 28px; font-weight: 800; color: #27365c; margin: 0 0 10px 0;">Evaluating Your
                Performance</h2>
            <p style="color: #555; font-size: 16px; max-width: 400px; line-height: 1.6; margin: 0 0 5px 0;">
                We’re preparing your scorecard, reviewing your interview transcript, and preparing your email summary...
            </p>
            <p style="color: #64748b; font-size: 13px;">This process will take a few seconds...</p>
        </div>

    </div>
</div>

<style>
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        from {
            opacity: 0.6;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes scaleWave {
        0% {
            transform: scale(1);
            opacity: 0.6;
        }

        100% {
            transform: scale(1.3);
            opacity: 0;
        }
    }

    /* Typing Dots Animation */
    .typing-dots {
        display: inline-flex;
        gap: 4px;
    }

    .typing-dots span {
        width: 6px;
        height: 6px;
        background: #ca8a04;
        border-radius: 50%;
        display: inline-block;
        animation: typingBounce 1.4s infinite ease-in-out both;
    }

    .typing-dots span:nth-child(1) {
        animation-delay: -0.32s;
    }

    .typing-dots span:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes typingBounce {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }

    button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
    }

    /* Chat scrollbar */
    #chatDialogue::-webkit-scrollbar {
        width: 6px;
    }

    #chatDialogue::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    #chatDialogue::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Chat message entry animation */
    .chat-msg {
        animation: msgIn 0.3s ease-out;
    }

    @keyframes msgIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== Wrapper & background ===== */
    .mock-interview-wrapper {
        width: 100%;
        min-height: calc(100vh - 70px);
        background: url("<?= base_url('./ALL_UPLOADS/images/mock_chat.png'); ?>") center/cover no-repeat;
        background-attachment: scroll;
        position: relative;
        box-sizing: border-box;
    }

    /* ===== Glass container ===== */
    .glass-container {
        backdrop-filter: blur(34px);
        -webkit-backdrop-filter: blur(34px);
        background: rgba(255, 255, 255, 0.25);
        z-index: 0;
        box-sizing: border-box;
        color: #333;
    }
</style>

<script>
    const base_url = '<?= base_url(); ?>';
    const session_id = '<?= $session['id']; ?>';
    const localStorageKey = 'mock_interview_start_' + session_id;
    let startTime = localStorage.getItem(localStorageKey);
    if (!startTime) {
        startTime = Math.floor(Date.now() / 1000);
        localStorage.setItem(localStorageKey, startTime);
    }
    startTime = parseInt(startTime, 10);
    let countdownInterval;
    let answerFormat = 'text';

    // Web Speech API STT and TTS properties
    let recognition;
    let isListening = false;
    let speaking = false;
    let currentlySpeakingBtn = null;
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    // Document Elements
    const timerText = document.getElementById('timerText');
    const textarea = document.getElementById('candidateAnswer');
    const submitBtn = document.getElementById('submitAnswerBtn');
    const voicePanel = document.getElementById('voiceControlPanel');
    const micBtn = document.getElementById('micBtn');
    const micWave = document.querySelector('.mic-wave');
    const micIcon = document.getElementById('micIcon');
    const voiceStatus = document.getElementById('voiceStatus');
    const voiceInstruction = document.getElementById('voiceInstruction');
    const currentQIdInput = document.getElementById('currentQuestionId');
    const aiLoader = document.getElementById('aiLoader');
    const evalOverlay = document.getElementById('evaluationOverlay');
    const chatDialogue = document.getElementById('chatDialogue');

    function checkInput() {
        if (textarea.value.trim() !== '') {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    // Initialize
    document.addEventListener("DOMContentLoaded", () => {
        // Start count down
        startTimer();

        // Stop ongoing speech on load (safety)
        window.speechSynthesis.cancel();

        // Scroll chat to bottom on load
        scrollChatToBottom();

        // Listen for typing events
        textarea.addEventListener('input', checkInput);
        textarea.addEventListener('change', checkInput);
        textarea.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                if (!submitBtn.disabled) {
                    submitAnswer();
                }
            }
        });

        // Setup STT
        if (SpeechRecognition) {
            recognition = new SpeechRecognition();
            recognition.continuous = true; // allow continuing speaking
            recognition.interimResults = true; // show interim results
            recognition.lang = 'en-US';

            recognition.onstart = () => {
                isListening = true;
                updateListeningUI(true);
            };

            recognition.onresult = (event) => {
                let interimTranscript = '';
                let finalTranscript = '';

                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    if (event.results[i].isFinal) {
                        finalTranscript += event.results[i][0].transcript;
                    } else {
                        interimTranscript += event.results[i][0].transcript;
                    }
                }

                // Append response text
                if (finalTranscript !== '') {
                    textarea.value += (textarea.value ? ' ' : '') + finalTranscript;
                    textarea.style.height = '120px';
                    answerFormat = 'voice';
                    checkInput();
                }
            };

            recognition.onerror = (event) => {
                console.error('Speech Recognition error', event);
                isListening = false;
                updateListeningUI(false);
            };

            recognition.onend = () => {
                isListening = false;
                updateListeningUI(false);
            };
        } else {
            console.warn('Web Speech API is not supported in this browser.');
        }
    });

    function updateTimer() {
        let currentTime = Math.floor(Date.now() / 1000);
        let remainingTime = (startTime + 120) - currentTime;

        if (remainingTime <= 0) {
            remainingTime = 0;
            clearInterval(countdownInterval);
            timerText.innerText = '00 : 00';
            finishInterview();
            return;
        }

        // Dynamic color coding based on remaining time
        let color, bgColor, borderColor, textColor;
        if (remainingTime >= 60) {
            // Green
            color = '#10b981';
            bgColor = 'rgba(255, 255, 255, 0.25)';
            borderColor = 'rgba(16, 185, 129, 0.25)';
            textColor = '#10b981';
        } else if (remainingTime >= 31) {
            // Orange
            color = '#f97316';
            bgColor = 'rgba(255, 255, 255, 0.25)';
            borderColor = 'rgba(249, 115, 22, 0.25)';
            textColor = '#f97316';
        } else {
            // Red
            color = '#ef4444';
            bgColor = 'rgba(255, 255, 255, 0.25)';
            borderColor = 'rgba(239, 68, 68, 0.25)';
            textColor = '#ef4444';
        }

        const container = document.getElementById('timerContainer');
        const icon = document.getElementById('timerIcon');

        if (container && icon) {
            container.style.backgroundColor = bgColor;
            container.style.borderColor = borderColor;
            icon.style.color = color;
        }
        timerText.style.color = textColor;

        let minutes = Math.floor(remainingTime / 60);
        let seconds = remainingTime % 60;

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        timerText.innerText = minutes + ' : ' + seconds;
    }

    function startTimer() {
        updateTimer();
        countdownInterval = setInterval(updateTimer, 1000);
    }

    function updateListeningUI(isActive) {
        if (isActive) {
            micBtn.style.background = '#22c55e';
            micBtn.style.color = '#fff';
            micIcon.className = 'fas fa-microphone';
            micWave.style.display = 'block';
            voiceStatus.innerText = 'Listening...';
            voiceStatus.style.color = '#22c55e';
            voiceInstruction.innerText = 'Speak now. The text will appear below.';
            micBtn.title = 'Stop Listening';
        } else {
            micBtn.style.background = '#f5e602';
            micBtn.style.color = '#333';
            micIcon.className = 'fas fa-microphone-slash';
            micWave.style.display = 'none';
            voiceStatus.innerText = 'Microphone Off';
            voiceStatus.style.color = '#ef4444';
            voiceInstruction.innerText = 'Click the microphone to speak your response';
            micBtn.title = 'Start Listening';
        }
    }

    function toggleListening() {
        if (!SpeechRecognition) {
            alert("Web Speech API is not supported in this browser. Please type your answer.");
            return;
        }

        // Cancel TTS if speaking
        if (speaking) {
            window.speechSynthesis.cancel();
            speaking = false;
            if (currentlySpeakingBtn) {
                resetSpeakBtn(currentlySpeakingBtn);
                currentlySpeakingBtn = null;
            }
        }

        if (isListening) {
            stopListening();
        } else {
            startListening();
        }
    }

    function startListening() {
        if (!recognition) return;
        try {
            recognition.abort();
        } catch (e) { }

        setTimeout(() => {
            try {
                recognition.start();
            } catch (e) {
                console.error("Error starting speech recognition:", e);
                isListening = true;
                updateListeningUI(true);
            }
        }, 50);
    }

    function stopListening() {
        if (!recognition) return;
        try {
            recognition.stop();
        } catch (e) {
            console.error("Error stopping speech recognition:", e);
        }
        isListening = false;
        updateListeningUI(false);
    }

    // ---- Chat helpers ----

    function scrollChatToBottom() {
        if (chatDialogue) {
            chatDialogue.scrollTop = chatDialogue.scrollHeight;
        }
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.innerText = str;
        return div.innerHTML;
    }

    function appendCandidateMessage(text) {
        const row = document.createElement('div');
        row.className = 'chat-msg candidate-msg';
        row.style.cssText = 'display:flex; gap:14px; align-items:flex-start; justify-content:flex-end;';
        row.innerHTML = `
        <div style="width: 40px; min-width: 40px; height: 40px; flex-shrink: 0; margin-right: auto;"></div>
        <div style="background:#dcf8c6; border:1px solid #b9e8a0; padding:14px 18px; border-radius:16px 4px 16px 16px; max-width: calc(100% - 108px); box-shadow:0 2px 8px rgba(0, 0, 0, 0.04);">
            <p style="margin:0; font-size:16px; line-height:1.5; color:#111b21; white-space:pre-wrap;">${escapeHtml(text)}</p>
        </div>
        <div style="background: #e2e8f0; border-radius: 50%; width: 40px; height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); border: 1px solid #cbd5e1; flex-shrink: 0;">
            👨‍💻
        </div>
    `;
        chatDialogue.appendChild(row);
        scrollChatToBottom();
    }

    function appendInterviewerMessage(text, questionId) {
        const row = document.createElement('div');
        row.className = 'chat-msg interviewer-msg';
        row.dataset.questionId = questionId;
        row.style.cssText = 'display:flex; gap:14px; align-items:flex-start;';
        row.innerHTML = `
        <div style="background: linear-gradient(135deg, #27365c 0%, #ffd500 100%); border-radius: 50%; padding: 10px; width: 40px; height: 40px; min-width: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(39, 54, 92, 0.15); flex-shrink: 0; box-sizing: border-box;">
            <i class="fas fa-user-tie" style="font-size: 18px; color: #fff;"></i>
        </div>
        <div class="bubble-content" style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 14px 18px; border-radius: 4px 16px 16px 16px; max-width: calc(100% - 108px); box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:10px;">
                <p class="q-text" style="margin:0; font-size:16px; line-height:1.5; font-weight:500; color:#1e293b;">${escapeHtml(text)}</p>
                <button type="button" class="speak-btn" onclick="speakBubble(this)" style="flex-shrink:0;background:#fff;border:1px solid #cbd5e1;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:#ca8a04;" title="Listen to question" onmouseover="this.style.background='#fefce8'; this.style.color='#854d0e';" onmouseout="this.style.background='#ffffff'; this.style.color='#ca8a04';">
                    <i class="fas fa-volume-up"></i>
                </button>
            </div>
        </div>
        <div style="width: 40px; min-width: 40px; height: 40px; flex-shrink: 0; margin-left: auto;"></div>
    `;
        chatDialogue.appendChild(row);
        scrollChatToBottom();
    }

    function resetSpeakBtn(btn) {
        const icon = btn.querySelector('i');
        icon.className = 'fas fa-volume-up';
        btn.style.color = '#ca8a04';
    }

    function speakBubble(btn) {
        const bubble = btn.closest('.bubble-content');
        const text = bubble.querySelector('.q-text').innerText;
        const icon = btn.querySelector('i');

        // If clicking the bubble that's currently speaking, stop it
        if (currentlySpeakingBtn === btn) {
            window.speechSynthesis.cancel();
            resetSpeakBtn(btn);
            currentlySpeakingBtn = null;
            speaking = false;
            return;
        }

        // Stop any other speech in progress
        window.speechSynthesis.cancel();
        if (currentlySpeakingBtn) {
            resetSpeakBtn(currentlySpeakingBtn);
        }

        // Stop listening if mic is active
        if (isListening) {
            stopListening();
        }

        if (text.trim() !== '') {
            const utterance = new SpeechSynthesisUtterance(text);

            utterance.onstart = () => {
                speaking = true;
                currentlySpeakingBtn = btn;
                icon.className = 'fas fa-volume-up fa-pulse';
                btn.style.color = '#16a34a';
            };

            utterance.onend = () => {
                speaking = false;
                resetSpeakBtn(btn);
                currentlySpeakingBtn = null;
            };

            utterance.onerror = () => {
                speaking = false;
                resetSpeakBtn(btn);
                currentlySpeakingBtn = null;
            };

            window.speechSynthesis.speak(utterance);
        }
    }

    // ---- Submit / flow ----

    function submitAnswer() {
        const question_id = currentQIdInput.value;
        const answer = textarea.value.trim();

        if (answer === '') return;

        // Stop listening/speaking before sending
        stopListening();
        window.speechSynthesis.cancel();
        speaking = false;
        if (currentlySpeakingBtn) {
            resetSpeakBtn(currentlySpeakingBtn);
            currentlySpeakingBtn = null;
        }

        // Optimistically render the candidate's answer bubble in the chat
        appendCandidateMessage(answer);

        // Disable input, clear textarea, show typing indicator
        textarea.value = '';
        textarea.style.height = '50px';
        textarea.disabled = true;
        submitBtn.disabled = true;
        aiLoader.style.display = 'flex';
        scrollChatToBottom();

        // Send via AJAX
        const formData = new FormData();
        formData.append('session_id', session_id);
        formData.append('question_id', question_id);
        formData.append('answer', answer);
        formData.append('mode', answerFormat);

        fetch(base_url + 'mock-interview/submit_answer', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                aiLoader.style.display = 'none';

                if (data.success) {
                    // Append the next question as a new interviewer bubble
                    currentQIdInput.value = data.next_question.id;
                    appendInterviewerMessage(data.next_question.question_text, data.next_question.id);

                    // Update question number badge (if present elsewhere on the page)
                    const qNumBadge = document.getElementById('questionNumberBadge');
                    if (qNumBadge && data.next_question.question_order) {
                        qNumBadge.innerText = 'Q' + data.next_question.question_order;
                    }

                    // Reset format
                    answerFormat = 'text';

                    // Re-enable after next question is loaded and displayed
                    textarea.disabled = false;
                    submitBtn.disabled = true; // Wait for candidate input for next question
                    textarea.focus();
                } else {
                    alert("Error: " + data.error);
                    textarea.disabled = false;
                    checkInput();
                }
            })
            .catch(err => {
                console.error(err);
                textarea.disabled = false;
                checkInput();
                aiLoader.style.display = 'none';
                alert("A network error occurred. Please try again.");
            });
    }

    function finishInterview() {
        stopListening();
        clearInterval(countdownInterval);

        // Stop speaking on finish
        window.speechSynthesis.cancel();

        // Display evaluating loader overlay
        evalOverlay.style.display = 'flex';

        // Submit final form
        window.location.href = base_url + 'mock-interview/complete/' + session_id;
    }

    function confirmEarlyExit() {
        if (confirm("Are you sure you want to finish the mock interview early? Your answers so far will be evaluated.")) {
            finishInterview();
        }
    }
</script>