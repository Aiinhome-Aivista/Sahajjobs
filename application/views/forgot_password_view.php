<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .forgot-password-container {
            max-width: 500px;
            margin: 80px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .forgot-password-container h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
        }

        .alert {
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            margin-bottom: 15px;
        }

        .bgcolor{
            background-color: #FFF44F;
            border-color: #FFF44F;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forgot-password-container">

            <!-- Step 1: Send Verification Email -->
            <div id="step1">
                <h2>Forgot Password</h2>
                <form id="email-form">
                    <div id="email-msg"></div>
                    <div class="form-group">
                        <label for="email">Registered Email ID</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your registered email ID" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning bgcolor" id="validate-btn">Send Verification Email</button>
                    </div>
                </form>
            </div>

            <!-- Step 2: Reset Password (shown only after email verification) -->
            <div id="step2" style="display:none;">
                <h2>Reset Password</h2>
                <form id="password-form">
                    <div id="password-msg"></div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" class="form-control" id="new-password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Verify Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
                    </div>
                    <input type="hidden" id="email-hidden">
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning bgcolor" id="reset-btn">Submit</button>
                    </div>
                </form>
            </div>

            <!-- Step 3: Success Message -->
            <div id="step3" style="display:none;">
                <h2 class="text-success">Password Changed!</h2>
                <p class="alert alert-success">Your password has been successfully updated. Redirecting...</p>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const baseUrl = '<?= base_url(); ?>';

            // Step 1: Send verification email
            $('#email-form').on('submit', function (e) {
                e.preventDefault();
                const email = $('#email').val();
                const msgDiv = $('#email-msg');
                const validateBtn = $('#validate-btn');

                msgDiv.html('');
                validateBtn.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: baseUrl + 'login/verify_email', // backend sends token email
                    method: 'POST',
                    data: { email: email },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            msgDiv.html('<div class="alert alert-success">' + response.message + '</div>');
                        } else {
                            msgDiv.html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function () {
                        msgDiv.html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                    },
                    complete: function () {
                        validateBtn.prop('disabled', false).text('Send Verification Email');
                    }
                });
            });

            // Step 2: Show reset password form via verification link
            const urlParams = new URLSearchParams(window.location.search);
            const email = urlParams.get('email');
            const token = urlParams.get('token');

            if (email && token) {
                // Verify token and mark email as verified
                $.ajax({
                    url: baseUrl + 'login/verify_password_reset_token',
                    method: 'GET',
                    data: { email: email, token: token },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            $('#step1').hide();
                            $('#step2').show();
                            $('#email-hidden').val(email);
                        } else {
                            $('#step1').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function () {
                        $('#step1').html('<div class="alert alert-danger">Invalid password reset link.</div>');
                    }
                });
            }

            // Step 3: Handle password update
            $('#password-form').on('submit', function (e) {
                e.preventDefault();
                const newPassword = $('#new-password').val();
                const confirmPassword = $('#confirm-password').val();
                const email = $('#email-hidden').val();
                const msgDiv = $('#password-msg');
                const resetBtn = $('#reset-btn');

                msgDiv.html('');
                resetBtn.prop('disabled', true).text('Updating...');

                if (newPassword.length < 6) {
                    msgDiv.html('<div class="alert alert-danger">Password must be at least 6 characters long.</div>');
                    resetBtn.prop('disabled', false).text('Submit');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    msgDiv.html('<div class="alert alert-danger">Passwords do not match.</div>');
                    resetBtn.prop('disabled', false).text('Submit');
                    return;
                }

                $.ajax({
                    url: baseUrl + 'login/update_password',
                    method: 'POST',
                    data: { email: email, new_password: newPassword },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            $('#step2').hide();
                            $('#step3').show();
                            setTimeout(function () {
                                window.location.href = baseUrl;
                            }, 3000);
                        } else {
                            msgDiv.html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function () {
                        msgDiv.html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                    },
                    complete: function () {
                        resetBtn.prop('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>
</body>
</html>
