<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - GreenBird</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --dark-color: #5a5c69;
            --success-color: #28a745;
            --error-color: #dc3545;
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
        
        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        .password-strength {
            height: 5px;
            background-color: #e9ecef;
            border-radius: 3px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }
        
        .password-requirements {
            margin-top: 10px;
            font-size: 0.85rem;
            color: var(--dark-color);
        }
        
        .requirement {
            margin-bottom: 5px;
        }
        
        .requirement i {
            margin-right: 5px;
            width: 15px;
        }
        
        .requirement.valid {
            color: var(--success-color);
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
            <strong>Password Reset</strong> Enter your email and set a new password for your account.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row auth-container bg-white">
            <!-- Left Side - Image -->
            <div class="col-md-6 d-none d-md-block auth-image">
                <h1 class="display-4 mb-4">Reset Your Password</h1>
                <p class="lead">Create a new strong password to secure your account.</p>
                <div class="mt-5">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-lock fa-2x me-3"></i>
                        <span>Minimum 8 characters</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-shield-alt fa-2x me-3"></i>
                        <span>At least one uppercase letter</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-key fa-2x me-3"></i>
                        <span>At least one number or special character</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Form -->
            <div class="col-md-6 auth-form">
                <div class="text-center mb-4">
                    <i class="fas fa-key fa-3x text-primary mb-3"></i>
                    <h2 class="form-title">Create New Password</h2>
                    <p class="text-muted">Enter your email and set a new password for your account.</p>
                </div>
                
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Password updated successfully!</strong> You can now login with your new password.
                </div>
                
                <form id="resetPasswordForm" action="{{ route('set_password') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="newPassword" placeholder="New Password" required>
                        <label for="newPassword">New Password</label>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="passwordStrengthBar"></div>
                        </div>
                        <div class="password-requirements">
                            <div class="requirement" id="lengthReq">
                                <i class="fas fa-circle"></i>
                                At least 8 characters
                            </div>
                            <div class="requirement" id="uppercaseReq">
                                <i class="fas fa-circle"></i>
                                At least one uppercase letter
                            </div>
                            <div class="requirement" id="numberReq">
                                <i class="fas fa-circle"></i>
                                At least one number or special character
                            </div>
                        </div>
                        <div class="error-message" id="passwordError">Password doesn't meet requirements</div>
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="error-message" id="confirmError">Passwords don't match</div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mb-3" id="resetButton">
                        <span id="buttonText">Reset Password</span>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resetPasswordForm = document.getElementById('resetPasswordForm');
            const successMessage = document.getElementById('successMessage');
            const resetButton = document.getElementById('resetButton');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');
            
            // Form elements
            const emailInput = document.getElementById('resetEmail');
            const newPasswordInput = document.getElementById('newPassword');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            
            // Error messages
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const confirmError = document.getElementById('confirmError');
            
            // Password strength elements
            const passwordStrengthBar = document.getElementById('passwordStrengthBar');
            const lengthReq = document.getElementById('lengthReq');
            const uppercaseReq = document.getElementById('uppercaseReq');
            const numberReq = document.getElementById('numberReq');
            
            // Validate email format
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            // Check password strength
            function checkPasswordStrength(password) {
                let strength = 0;
                
                // Check length
                if (password.length >= 8) {
                    strength += 1;
                    lengthReq.classList.add('valid');
                    lengthReq.querySelector('i').className = 'fas fa-check-circle';
                } else {
                    lengthReq.classList.remove('valid');
                    lengthReq.querySelector('i').className = 'fas fa-circle';
                }
                
                // Check uppercase letters
                if (/[A-Z]/.test(password)) {
                    strength += 1;
                    uppercaseReq.classList.add('valid');
                    uppercaseReq.querySelector('i').className = 'fas fa-check-circle';
                } else {
                    uppercaseReq.classList.remove('valid');
                    uppercaseReq.querySelector('i').className = 'fas fa-circle';
                }
                
                // Check numbers or special chars
                if (/[0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
                    strength += 1;
                    numberReq.classList.add('valid');
                    numberReq.querySelector('i').className = 'fas fa-check-circle';
                } else {
                    numberReq.classList.remove('valid');
                    numberReq.querySelector('i').className = 'fas fa-circle';
                }
                
                // Update strength bar
                const strengthPercent = (strength / 3) * 100;
                passwordStrengthBar.style.width = strengthPercent + '%';
                
                // Change color based on strength
                if (strengthPercent < 50) {
                    passwordStrengthBar.style.backgroundColor = '#dc3545'; // red
                } else if (strengthPercent < 100) {
                    passwordStrengthBar.style.backgroundColor = '#fd7e14'; // orange
                } else {
                    passwordStrengthBar.style.backgroundColor = '#28a745'; // green
                }
                
                return strength === 3;
            }
            
            // Validate form
            function validateForm() {
                let isValid = true;
                
                // Validate email
                if (!validateEmail(emailInput.value)) {
                    emailError.style.display = 'block';
                    emailInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    emailError.style.display = 'none';
                    emailInput.classList.remove('is-invalid');
                }
                
                // Validate password
                const isPasswordStrong = checkPasswordStrength(newPasswordInput.value);
                if (!isPasswordStrong) {
                    passwordError.style.display = 'block';
                    newPasswordInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    passwordError.style.display = 'none';
                    newPasswordInput.classList.remove('is-invalid');
                }
                
                // Validate password confirmation
                if (newPasswordInput.value !== confirmPasswordInput.value) {
                    confirmError.style.display = 'block';
                    confirmPasswordInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    confirmError.style.display = 'none';
                    confirmPasswordInput.classList.remove('is-invalid');
                }
                
                return isValid;
            }
            
            // Real-time validation
            newPasswordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value);
            });
            
            confirmPasswordInput.addEventListener('input', function() {
                if (this.value !== newPasswordInput.value) {
                    confirmError.style.display = 'block';
                    this.classList.add('is-invalid');
                } else {
                    confirmError.style.display = 'none';
                    this.classList.remove('is-invalid');
                }
            });
            
            // Form submission
            // if (resetPasswordForm) {
            //     resetPasswordForm.addEventListener('submit', function(event) {
            //         event.preventDefault();
                    
            //         if (!validateForm()) {
            //             return;
            //         }
                    
            //         // Show loading state
            //         buttonText.textContent = 'Updating...';
            //         buttonSpinner.classList.remove('d-none');
            //         resetButton.disabled = true;
                    
            //         // Simulate API call (replace with actual API call in production)
            //         setTimeout(function() {
            //             // Hide loading state
            //             buttonText.textContent = 'Reset Password';
            //             buttonSpinner.classList.add('d-none');
            //             resetButton.disabled = false;
                        
            //             // Show success message
            //             successMessage.style.display = 'block';
            //             resetPasswordForm.reset();
                        
            //             // In a real application, you would:
            //             // 1. Send the new password to your backend
            //             // 2. Handle success/error responses
            //             // Example:
            //             /*
            //             fetch('/api/reset-password', {
            //                 method: 'POST',
            //                 headers: {
            //                     'Content-Type': 'application/json',
            //                 },
            //                 body: JSON.stringify({
            //                     email: emailInput.value,
            //                     newPassword: newPasswordInput.value,
            //                     token: getTokenFromURL() // If using token from URL
            //                 }),
            //             })
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.success) {
            //                     successMessage.style.display = 'block';
            //                     resetPasswordForm.reset();
            //                 } else {
            //                     alert(data.message || 'Error resetting password');
            //                 }
            //             })
            //             .catch(error => {
            //                 console.error('Error:', error);
            //                 alert('An error occurred. Please try again.');
            //             })
            //             .finally(() => {
            //                 buttonText.textContent = 'Reset Password';
            //                 buttonSpinner.classList.add('d-none');
            //                 resetButton.disabled = false;
            //             });
            //             */
            //         }, 1500);
            //     });
            // }
        });
    </script>
</body>
</html>