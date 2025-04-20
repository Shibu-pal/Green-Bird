<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification | GreenBird</title>

    
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
        
        .otp-input-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .otp-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
        
        .otp-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
        }
        
        .resend-otp {
            text-align: center;
            margin-top: 20px;
        }
        
        .resend-otp a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }
        
        .timer {
            color: #dc3545;
            font-weight: bold;
        }
        
        .verification-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .auth-image {
                display: none;
            }
            
            .auth-container {
                margin: 20px;
            }
            
            .otp-input {
                width: 40px;
                height: 50px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <div class="container-fluid bg-light text-dark w-100">
        <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
            <strong>{{ $message }}</strong> Please enter the 6-digit code sent to your email to complete your login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row auth-container bg-white">
            <!-- Left Side - Image -->
            <div class="col-md-6 d-none d-md-block auth-image">
                <h1 class="display-4 mb-4">Secure Verification</h1>
                <p class="lead">We've sent a one-time password to your registered email for security verification.</p>
                <div class="mt-5">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-shield-alt fa-2x me-3"></i>
                        <span>Two-factor authentication</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-lock fa-2x me-3"></i>
                        <span>Secure account access</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock fa-2x me-3"></i>
                        <span>Code expires in 5 minutes</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - OTP Form -->
            <div class="col-md-6 auth-form">
                <div class="text-center">
                    <div class="verification-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h2 class="form-title">Verify Your Identity</h2>
                    <p class="text-muted">Enter the 6-digit verification code sent to<br>{{ $email }}</p>
                </div>
                
                <form id="otpForm" action="{{ route('forget_otp_validate') }}" method="POST">
                    @csrf
                    <div class="otp-input-container">
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="text" name="otp1" class="form-control otp-input" maxlength="1" pattern="[0-9]" required>
                        <input type="text" name="otp2" class="form-control otp-input" maxlength="1" pattern="[0-9]" required>
                        <input type="text" name="otp3" class="form-control otp-input" maxlength="1" pattern="[0-9]" required>
                        <input type="text" name="otp4" class="form-control otp-input" maxlength="1" pattern="[0-9]" required>
                        <input type="text" name="otp5" class="form-control otp-input" maxlength="1" pattern="[0-9]" required>
                        <input type="text" name="otp6" class="form-control otp-input" maxlength="1" pattern="[0-9]" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mb-3">Verify & Continue</button>
                    
                    <div class="resend-otp">
                        Didn't receive code? <a href="#">Resend OTP</a> <span class="timer">(04:59)</span>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="#" class="text-primary"><i class="fas fa-arrow-left me-2"></i>Back to login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let countdownTime = 300; // 5 minutes in seconds
        const timerElement = document.querySelector('.timer');
        const resendLink = document.querySelector('.resend-otp a');

        function updateTimer() {
            const minutes = Math.floor(countdownTime / 60);
            const seconds = countdownTime % 60;
            timerElement.textContent = `(${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')})`;

            if (countdownTime <= 0) {
                clearInterval(timerInterval);
                resendLink.style.pointerEvents = 'auto'; // Enable resend link
                resendLink.style.color = '#007bff'; // Change color to indicate it's clickable
                timerElement.textContent = '(00:00)'; // Reset timer display
            } else {
                countdownTime--;
            }
        }

        // Disable resend link initially
        resendLink.style.pointerEvents = 'none';
        resendLink.style.color = '#6c757d'; // Change color to indicate it's disabled

        const timerInterval = setInterval(updateTimer, 1000);
        
    </script>
</body>
</html>