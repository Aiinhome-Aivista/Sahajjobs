<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php'; // Load Composer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Basic SMTP setup
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'teamsahajjobs@gmail.com'; // your Gmail
        $this->mail->Password = 'pejq rhtf qpsw hsjh';     // Gmail App Password
        $this->mail->CharSet = 'UTF-8';
        $this->mail->isHTML(true);

        // SSL issue bypass (useful on shared hosting)
        $this->mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ]
        ];

        // Default sender
        $this->mail->setFrom('teamsahajjobs@gmail.com', 'SahajJobs');
        $this->mail->addReplyTo('teamsahajjobs@gmail.com', 'SahajJobs');
    }

    public function sendWelcomeEmail($toEmail, $toName, $password, $template = 'welcome_email')
    {
        $ci =& get_instance();
        $emailContent = $ci->load->view("emails/{$template}", [
            'name' => $toName,
            'email' => $toEmail,
            'password' => $password
        ], TRUE);

        $this->mail->clearAddresses();
        $this->mail->clearCCs();
        $this->mail->clearAttachments();
        $this->mail->addAddress($toEmail, $toName);
        $this->mail->addCC('support@sahajjobs.com', 'SahajJobs Support');
        $this->mail->Subject = 'Welcome to SahajJobs - Registration Successful';
        $this->mail->Body = $emailContent;

        // --- Try STARTTLS on 587 first ---
        try {
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            if ($this->mail->send()) {
                return true;
            }
        } catch (Exception $e) {
            log_message('error', 'Mailer Error (TLS/587): ' . $this->mail->ErrorInfo);
        }

        // --- If that fails, try SMTPS on 465 ---
        try {
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->Port = 465;

            if ($this->mail->send()) {
                return true;
            }
        } catch (Exception $e) {
            log_message('error', 'Mailer Error (SSL/465): ' . $this->mail->ErrorInfo);
        }

        // If both fail
        log_message('error', 'Email could not be sent. Final Error: ' . $this->mail->ErrorInfo);

        // For debugging (you can remove this in production)
        echo 'Email failed: ' . $this->mail->ErrorInfo;

        return false;
    }


    public function sendApplicationStatusEmail($toEmail, $toName, $jobPosition, $status, $company)
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->clearCCs();
            $this->mail->clearAttachments();

            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            $this->mail->addAddress($toEmail, $toName);
            $this->mail->addCC('support@sahajjobs.com', 'SahajJobs Support');
            $this->mail->Subject = 'Your Job Application Status at SahajJobs';

            if (strtolower($status) === 'accepted') {
                $body = "
            <p>Dear <strong>$toName</strong>,</p>
            <p>Congratulations! We are pleased to inform you that your application for the position of <strong>$jobPosition</strong> has been <span style='color:green; font-weight:bold;'>accepted</span> for the <strong>$company</strong>.</p>
            <p>Our team will be reaching out to you shortly with further details. We look forward to having you join us.</p>
            <p>Best wishes,<br/>SahajJobs Team</p>
        ";
            } else {
                $body = "
            <p>Dear <strong>$toName</strong>,</p>
            <p>Thank you for your interest in the <strong>$jobPosition</strong> position at <strong>$company</strong>.</p>
            <p>After careful consideration, we regret to inform you that your application has not been accepted at this time.</p>
            <p>We encourage you to keep an eye on future opportunities and wish you success in your job search.</p>
            <p>Sincerely,<br/>SahajJobs Team</p>
        ";
            }

            $this->mail->Body = $body;
            $this->mail->isHTML(true);

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            log_message('error', 'Application status email failed to send. Error: ' . $this->mail->ErrorInfo);
            echo 'Email failed: ' . $this->mail->ErrorInfo;
            return false;
        }
    }


    public function sendEmail($toEmail, $subject, $content)
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->clearCCs();
            $this->mail->clearAttachments();

            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or SMTPS with port 465
            $this->mail->Port = 587;

            $this->mail->addAddress($toEmail);
            $this->mail->addCC('support@sahajjobs.com', 'SahajJobs Support');
            $this->mail->Subject = $subject;
            $this->mail->Body = $content;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            log_message('error', 'Email could not be sent. Error: ' . $this->mail->ErrorInfo);
            echo 'Email failed: ' . $this->mail->ErrorInfo; // for debugging
            return false;
        }
    }


}