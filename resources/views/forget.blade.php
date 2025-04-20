<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - GreenBird</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: var(--secondary-color);
            font-family: 'Nunito', sans-serif;
        }
        
        .auth-container {
            max-width: 1000px;
            margin: 50px auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .auth-image {
            background: linear-gradient(rgba(78, 115, 223, 0.8), rgba(78, 115, 223, 0.8)), 
                        url('https://source.unsplash.com/random/600x800?technology');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .auth-form {
            background: white;
            padding: 40px;
        }
        
        .form-title {
            color: var(--primary-color);
            margin-bottom: 30px;
            font-weight: 700;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }
        
        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-to-login a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }
        
        .form-floating label {
            color: var(--dark-color);
        }
        
        .success-message {
            display: none;
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .auth-image {
                display: none;
            }
            
            .auth-container {
                margin: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container-fluid bg-light text-dark w-100">
        <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
            <strong>Password Reset</strong> Enter your email to receive a password reset link.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row auth-container bg-white">
            <!-- Left Side - Image -->
            <div class="col-md-6 d-none d-md-block auth-image">
                <h1 class="display-4 mb-4">Forgot Your Password?</h1>
                <p class="lead">No worries! We'll help you reset your password and secure your account.</p>
                <div class="mt-5">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-shield-alt fa-2x me-3"></i>
                        <span>Secure password reset process</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-envelope fa-2x me-3"></i>
                        <span>Reset link sent to your email</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock fa-2x me-3"></i>
                        <span>Set a new strong password</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Form -->
            <div class="col-md-6 auth-form">
                <div class="text-center mb-4">
                    <i class="fas fa-key fa-3x text-primary mb-3"></i>
                    <h2 class="form-title">Reset Your Password</h2>
                    <p class="text-muted">Enter your email address and we'll send you a link to reset your password.</p>
                </div>
                
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Password reset link sent!</strong> Please check your email for instructions.
                </div>
                
                <form id="forgotPasswordForm" action="{{ route('forget_otp') }}" method="post">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="email" name="email" class="form-control" id="resetEmail" placeholder="name@example.com" required>
                        <label for="resetEmail">Email address</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mb-3" id="resetButton">
                        <span id="buttonText">Send OTP</span>
                        <span id="buttonSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                    </button>
                </form>
                
                <div class="back-to-login">
                    Remember your password? <a href="login.html">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forgotPasswordForm = document.getElementById('forgotPasswordForm');
            const successMessage = document.getElementById('successMessage');
            const resetButton = document.getElementById('resetButton');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');
            
            if (forgotPasswordForm) {
                forgotPasswordForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    
                    // Show loading state
                    buttonText.textContent = 'Sending...';
                    buttonSpinner.classList.remove('d-none');
                    resetButton.disabled = true;
                    
                    // Simulate API call (replace with actual API call in production)
                    setTimeout(function() {
                        // Hide loading state
                        buttonText.textContent = 'Send Reset Link';
                        buttonSpinner.classList.add('d-none');
                        resetButton.disabled = false;
                        
                        // Show success message
                        successMessage.style.display = 'block';
                        forgotPasswordForm.reset();
                        
                        // In a real application, you would:
                        // 1. Validate the email
                        // 2. Send a request to your backend
                        // 3. Handle success/error responses
                        // Example:
                        /*
                        fetch('/api/password-reset', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                email: document.getElementById('resetEmail').value
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                successMessage.style.display = 'block';
                                forgotPasswordForm.reset();
                            } else {
                                alert(data.message || 'Error sending reset link');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        })
                        .finally(() => {
                            buttonText.textContent = 'Send Reset Link';
                            buttonSpinner.classList.add('d-none');
                            resetButton.disabled = false;
                        });
                        */
                    }, 1500);
                });
            }
        });
    </script> --}}
</body>
</html>