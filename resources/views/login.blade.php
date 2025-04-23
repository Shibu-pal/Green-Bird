    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenBird</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Profile CSS -->
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
        
        .social-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s;
        }
        
        .social-btn i {
            margin-right: 10px;
        }
        
        .btn-google {
            background-color: #dd4b39;
            color: white;
        }
        
        .btn-facebook {
            background-color: #3b5998;
            color: white;
        }
        
        .btn-linkedin {
            background-color: #0077b5;
            color: white;
        }
        
        .btn-github {
            background-color: #333;
            color: white;
        }
        
        .btn-discord {
            background-color: #7289da;
            color: white;
        }
        
        .social-btn:hover {
            opacity: 0.9;
            color: white;
            transform: translateY(-2px);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        
        .divider-text {
            padding: 0 10px;
            color: var(--dark-color);
        }
        
        .auth-toggle {
            text-align: center;
            margin-top: 20px;
        }
        
        .auth-toggle a {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }
        
        .form-floating label {
            color: var(--dark-color);
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
            @if (Session::has('message'))
                {{ Session::get('message') }}
            @else
            {{-- session key dosen't exist  --}}
            
            <strong>Hi,you are not login yet</strong> Please login to buy,sells,chat with friend and access many others exclusive features and content.
            @endif
            
            <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row auth-container bg-white">
            <!-- Left Side - Image -->
            <div class="col-md-6 d-none d-md-block auth-image">
                <h1 class="display-4 mb-4">Welcome Back!</h1>
                <p class="lead">Join our community to access exclusive features and content. Sign in or create an account to get started.</p>
                <div class="mt-5">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <span>Secure authentication</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <span>Multiple login options</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <span>24/7 customer support</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Form -->
            <div class="col-md-6 auth-form">
                <ul class="nav nav-pills mb-4 justify-content-center" id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="{{ route('login') }}" id="signin-tab" data-bs-target="#signin" type="button" role="tab">Sign In</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('register') }}" id="signup-tab" data-bs-target="#signup" type="button" role="tab">Sign Up</a>
                    </li>
                </ul>
                
                <div class="tab-content" id="authTabsContent">
                    <!-- Sign In Tab -->
                    <div class="tab-pane fade show active" id="signin" role="tabpanel">
                        <h2 class="form-title">Sign In to Your Account</h2>
                        
                        <!-- Social Login Buttons -->
<!--                         <a href="{{ route('auth.redirect','google') }}" class="social-btn btn-google mb-3">
                            <i class="fab fa-google"></i> Sign in with Google
                        </a> -->
<!--                         {{-- <a href="{{ route('auth.redirect','facebook') }}" class="social-btn btn-facebook mb-3">
                            <i class="fab fa-facebook-f"></i> Sign in with Facebook
                        </a> --}}
                        
                        {{-- <div class="row">
                            <div class="col-md-6"> --}}
                                {{-- <a href="#" class="social-btn btn-linkedin mb-3">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a> --}}
                            {{-- </div>
                            <div class="col-md-6"> --}}
                                {{-- <a href="{{ route('auth.redirect','github') }}" class="social-btn btn-github mb-3">
                                    <i class="fab fa-github"></i> GitHub
                                </a> --}}
                            {{-- </div>
                        </div> --}}
                        
                        {{-- <a href="#" class="social-btn btn-discord mb-4">
                            <i class="fab fa-discord"></i> Discord
                        </a> --}} -->
                        
                        <div class="divider">
                            <span class="divider-text">OR</span>
                        </div>
                        
                        <!-- Email/Phone Form -->
                        <form id="signinForm" method="POST" action="{{ route('in') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="signinEmailPhone" placeholder="Email" required name="email">
                                <label for="signinEmailPhone">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="signinPassword" placeholder="Password" required name="password">
                                <label for="signinPassword">Password</label>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="">
                                    Forgot Your Password?
                                </div>
                                <a href="{{ route('forget') }}" class="text-primary">Click Here</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Sign In</button>
                        </form>
                        @if ($errors->any())
                            <div class="card-footer text-body-secondary">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="auth-toggle">
                            Don't have an account? <a href="{{ route('register') }}" id="switchToSignup">Sign Up</a>
                        </div>
                    </div>
                    
                    <!-- Sign Up Tab -->
                    <div class="tab-pane fade" id="signup" role="tabpanel">
                        <h2 class="form-title">Create Your Account</h2>
                        
                        <!-- Social Login Buttons -->
                        <!-- <a href="#" class="social-btn btn-google mb-3">
                            <i class="fab fa-google"></i> Sign up with Google
                        </a>
                        <a href="#" class="social-btn btn-facebook mb-3">
                            <i class="fab fa-facebook-f"></i> Sign up with Facebook
                        </a>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="social-btn btn-linkedin mb-3">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="social-btn btn-github mb-3">
                                    <i class="fab fa-github"></i> GitHub
                                </a>
                            </div>
                        </div>
                        <a href="#" class="social-btn btn-discord mb-4">
                            <i class="fab fa-discord"></i> Discord
                        </a>
                        <div class="divider">
                            <span class="divider-text">OR</span>
                        </div> -->
                        
                        <!-- Registration Form -->
                        <form id="signupForm" action="{{ route('up') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" value="{{ old('first') }}" class="form-control" id="firstName" placeholder="First Name" required name="first">
                                        <label for="firstName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" value="{{ old('last') }}" class="form-control" id="lastName" placeholder="Last Name" required name="last">
                                        <label for="lastName">Last Name</label>
                                    </div>
                                </div>
                            </div>
        
                            <div class="form-floating mb-3">
                                <input type="email" value="{{ old('email') }}" class="form-control" id="signupEmail" placeholder="Email" required name="email">
                                <label for="signupEmail">Email</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="tel" value="{{ old('phone') }}" class="form-control" id="phoneNumber" placeholder="Phone Number" name="phone">
                                <label for="phoneNumber">Phone Number (Optional)</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="signupPassword" placeholder="Password" required name="password">
                                <label for="signupPassword">Password</label>
                            </div>
                            
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required name="password_confirmation">
                                <label for="confirmPassword">Confirm Password</label>
                            </div>
                            <div class="form-floating mb-4">
                                <label for="DP">Profile Picture</label>
                                <br><br>
                                <input type="file" name="photo" id="DP" placeholder="Profile Picture">
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" value="{{ old('term') }}" type="checkbox" id="termsAgreement" required name="term">
                                <label class="form-check-label" for="termsAgreement" >
                                    I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mb-3">Create Account</button>
                        </form>
                        @if ($errors->any())
                            <div class="card-footer text-body-secondary">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="auth-toggle">
                            Already have an account? <a href="{{ route('login') }}" id="switchToSignin">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // const signinForm = document.getElementById('signinForm');
    // if (signinForm) {
    //     signinForm.addEventListener('submit', function(event) {
    //         event.preventDefault(); // Prevent the default form submission

    //         // For demonstration, let's just show a prompt to get the OTP
    //         const otp = prompt('Please enter the OTP sent to your email:');

    //         if (otp) {
    //             alert('You entered OTP: ' + otp + '\n(In a real application, you would now verify this OTP with the server.)');
    //             // In a real application, you would send the OTP to the server for verification.
    //             // For example:
    //             fetch('/verify-otp', {
    //                 method: 'POST',
    //                 headers: {
    //                     'Content-Type': 'application/json',
    //                 },
    //                 body: JSON.stringify({ otp: otp }),
    //             })
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.success) {
    //                     // Redirect or perform login actions
    //                     window.location.href = '{{ route('home') }}';
    //                 } else {
    //                     alert('Invalid OTP. Please try again.');
    //                 }
    //             })
    //             .catch(error => {
    //                 console.error('Error verifying OTP:', error);
    //                 alert('An error occurred during OTP verification.');
    //             });
    //         } else {
    //             alert('OTP cannot be empty.');
    //         }
    //     });
    // }

    // You can add similar logic for the signup form if you want to handle OTP there as well.
    // For example, you might send an OTP after the user submits the signup form.
    // const signupForm = document.getElementById('signupForm');
    // if (signupForm) {
    //     signupForm.addEventListener('submit', function(event) {
    //         event.preventDefault(); // Prevent the default form submission

    //         // Simulate sending OTP after signup data is submitted
    //         alert('A verification code has been sent to your email/phone.');

    //         const otp = prompt('Please enter the verification code:');

    //         if (otp) {
    //             alert('You entered verification code: ' + otp + '\n(In a real application, you would now verify this code with the server.)');
    //             // In a real application, you would send the signup data and OTP to the server.
    //         } else {
    //             alert('Verification code cannot be empty.');
    //         }
    //     });
    // }

    // Basic tab switching functionality (already handled by Bootstrap but kept for clarity)
    
    // const switchToSignup = document.getElementById('switchToSignup');
    // const switchToSignin = document.getElementById('switchToSignin');
    const signinTab = document.getElementById('signin-tab');
    const signupTab = document.getElementById('signup-tab');

    let siteUrl = window.location.href;
    if (siteUrl == 'http://localhost:8000/sign-in') {
        const signinTabBootstrap = new bootstrap.Tab(signinTab);
        signinTabBootstrap.show();
    } else if (siteUrl == 'http://localhost:8000/sign-up') {
        const signupTabBootstrap = new bootstrap.Tab(signupTab);
        signupTabBootstrap.show();
    }

    // if (switchToSignup && signupTab) {
    //     switchToSignup.addEventListener('click', function(event) {
    //         event.preventDefault();
    //         const signupTabBootstrap = new bootstrap.Tab(signupTab);
    //         signupTabBootstrap.show();
    //     });
    // }

    // if (switchToSignin && signinTab) {
    //     switchToSignin.addEventListener('click', function(event) {
    //         event.preventDefault();
    //         const signinTabBootstrap = new bootstrap.Tab(signinTab);
    //         signinTabBootstrap.show();
    //     });
    // }
});
    </script>
</body>
</html>
