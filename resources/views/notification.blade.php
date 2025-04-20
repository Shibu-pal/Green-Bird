<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* Custom CSS for responsiveness */
        body {
            padding-top: 56px; /* Adjust based on your navbar height */
        }
        
        /* Navbar adjustments */
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: white !important;
        }
        
        .search-container {
            flex-grow: 1;
            max-width: 500px;
            margin: 0 15px;
        }
        
        .mobile-search {
            display: none;
            padding: 10px 15px;
            background-color: #f8f9fa;
            width: 100%;
        }
        
        .navbar_top_elements {
            padding: 8px 0;
        }
        
        .nav-icon-text {
            margin-left: 5px;
        }
        
        /* Notification alert adjustments */
        .alert-notification {
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
        }
        
        .notification-content {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        
        .notification-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .notification-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        
        .profile-avatar {
            margin-right: 10px;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        
        .item-image {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 15px;
        }
        
        .item-details {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            body{
                padding-top: 150px;
            }
            .search-container {
                display: none !important;
            }
            
            .mobile-search {
                display: block;
            }
            
            .desktop-nav-items {
                display: none !important;
            }
            
            .right-items {
                margin-left: auto;
            }
        }
        
        @media (max-width: 768px) {
            .item-image {
                width: 60px;
                height: 60px;
            }
            
            .notification-content {
                flex-direction: column;
            }
            
            .item-details span {
                font-size: 14px;
            }
            
            .notification-buttons {
                justify-content: center;
                width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-brand span {
                display: none;
            }
            body{
                padding-top: 150px;
            }
            .alert-notification {
                padding: 10px;
            }
            
            .item-image {
                width: 50px;
                height: 50px;
            }
            
            .profile-avatar {
                width: 40px;
                height: 40px;
            }
            
            .notification-item {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-------Navbartop ------------------------------------------------------------------------------------------>
    <!-- screen size Laptop and more -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <!-- Mobile menu toggle button -->
            <button class="navbar_top_elements navbar-toggler offcanvas-btn me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Brand Icon and Name -->
            <a class="navbar_top_elements navbar-brand d-flex align-items-center">
                <img src="images/GreenBird.png" height="30" class="me-2" alt="#">
                <span class="d-none d-sm-inline">GreenBird</span>
            </a>

            <!-- Desktop Navigation Items -->
            <div class="desktop-nav-items d-none d-lg-flex">
                <!-- Home -->
                <div class="navbar_top_elements nav-item mx-2">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        <span class="nav-icon-text">Home</span>
                    </a>
                </div>

                <!-- Wallet -->
                <div class="navbar_top_elements nav-item mx-2">
                    <a class="nav-link" href="A:\Green Bird\css\login\login.html">
                        <i class="bi bi-wallet2"></i>
                        <span class="nav-icon-text">Wallet</span>
                    </a>
                </div>

                <!-- Chatbox -->
                <div class="navbar_top_elements nav-item mx-2">
                    <a class="nav-link" href="{{ route('notification') }}">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="nav-icon-text">Chatbox</span>
                    </a>
                </div>

                <!-- Sign In -->
                {{-- <div class="navbar_top_elements nav-item mx-2">
                    <a class="nav-link" href="frontend/login.html">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="nav-icon-text">Sign In</span>
                    </a>
                </div> --}}

                <!-- Seller Button -->
                <div class="navbar_top_elements nav-item mx-2">
                    <a class="nav-link btn btn-primary btn-bg-primary btn-sm" href="{{ route('sell') }}">
                        <span class="nav-icon-text">Sell</span>
                    </a>
                </div>
            </div>

            <!-- Search bar - will move below on mobile -->
            <div class="search-container d-none d-lg-flex">
                <form class="d-flex w-100">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <!-- Right side items - visible on all screens -->
            <div class="right-items d-flex align-items-center">
                <!-- Notifications -->
                <div class="navbar_top_elements nav-item mx-2">
                    <a class="nav-link" href="{{ route('notification') }}">
                        <i class="bi bi-bell"></i>
                        <span class="nav-icon-text d-none d-lg-inline">Notifications <sup class="rounded-circle bg-primary">3</sup></span>
                    </a>
                </div>

                <!-- Total cart -->
                <div class="navbar_top_elements nav-item mx-2">
                    <a class="nav-link cart-icon" href="{{ route('cart_list') }}">
                        <i class="bi bi-cart4"></i>
                        <span class="nav-icon-text d-none d-lg-inline">Cart</span>
                    </a>
                </div>

                <!-- Profile Dropdown -->
                <div class="navbar_top_elements nav-item dropdown d-flex mx-2">
                    <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" href="#"
                        role="button" data-bs-toggle="dropdown">
                        <img src="@if (Auth::user()->profile_image != NULL)
                                    {{ asset('/storage/'.Auth::user()->profile_image); }}
                                @else
                                    {{ asset('/images/GreenBird.png'); }}
                                @endif" alt="..." class="rounded-circle me-1"
                            width="24" height="24">
                        <span class="nav-icon-text d-none d-lg-inline">Profile</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <div class="dropdown-header d-flex align-items-center px-3 py-2">
                                <img src="@if (Auth::user()->profile_image != NULL)
                                    {{ asset('/storage/'.Auth::user()->profile_image); }}
                                @else
                                    {{ asset('/images/GreenBird.png'); }}
                                @endif" alt="Profile" class="rounded-circle me-2"
                                    width="40" height="40">
                                <div>
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="@if (Auth::user()->profile_image != NULL)
                                    {{ asset('/storage/'.Auth::user()->profile_image); }}
                                @else
                                    {{ asset('/images/GreenBird.png'); }}
                                @endif"><i
                                    class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><a class="dropdown-item" href="{{ route('cart_list') }}"><i class="bi bi-heart me-2"></i>Wishlist</a></li>
                        <li><a class="dropdown-item" href="{{ route('notification') }}"><i class="bi bi-clock-history me-2"></i>Purchase
                                History</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Mobile search bar (hidden on desktop) -->
        <div class="mobile-search d-lg-none">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </nav>
    <!-- Mobile Menu Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <!-- Home -->
                <li class="navbar_top_elements nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        <span class="nav-icon-text">Home</span>
                    </a>
                </li>

                <!-- Wallet -->
                <li class="nav-item">
                    <a class="nav-link" href="A:\Green Bird\css\login\login.html">
                        <i class="bi bi-wallet2"></i>
                        <span class="nav-icon-text">Wallet</span>
                    </a>
                </li>

                <!-- Chatbox -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notification') }}">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="nav-icon-text">Chatbox</span>
                    </a>
                </li>

                <!-- Notifications (mobile only) -->
                <li class="nav-item mobile-only-items">
                    <a class="nav-link" href="{{ route('notification') }}">
                        <i class="bi bi-bell"></i>
                        <span class="nav-icon-text">Notifications</span>
                    </a>
                </li>

                <!-- Sign In -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="frontend/login.html">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="nav-icon-text">Sign In</span>
                    </a>
                </li> -->

                <!-- Seller Button -->
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-sm" href="{{ route('sell') }}">
                        <span class="nav-icon-text">Sell</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container mt-3">
        <!-- Buyer Notification -->
        
                
            
        @foreach ($senders as $sendGroup)
            <div class="alert alert-secondary alert-dismissible fade show alert-notification" role="alert">
            
                    
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                        @foreach ($sendGroup as $send)
                        @if ($loop->first)
                        <div class="d-flex flex-row align-items-center mb-2 mb-md-0 me-md-3">
                            <img class="item-image" src="{{ asset('/storage/' . ($send->item->item_pics && $send->item->item_pics->count() > 0 ? $send->item->item_pics->first()->image : 'default.png')) }}" alt="Gold Coin" height="100px">
                            <div class="item-details">
                                <span class="fw-bold">{{ $send->item->title }},</span>
                                <span>Price: {{ $send->item->points_required }},</span>
                                <span>Q: {{ $send->quantity }},</span>
                                <span>Total: {{ $send->item->points_required * $send->quantity }}</span>
                            </div>
                        </div>
                        
                        <div class="notification-content">

                            <div class="">
                                <img src="@if ($send->reciever->profile_image != NULL)
                                            {{ asset('/storage/'.$send->reciever->profile_image); }}
                                        @else
                                            {{ asset('/images/GreenBird.png'); }}
                                        @endif"
                                    class="profile-avatar rounded-circle"><strong>{{ $send->reciever->name }}</strong>
                            
                        @endif 
                        @endforeach
                        @foreach ($sendGroup as $send)
                                    <div class="chat">
                                        @if ($send->sender->name == Auth::user()->name)
                                        <div>
                                            <strong>You:</strong> {{ $send->message }}
                                        </div>
                                        @else
                                        <div>
                                            <strong>{{ $send->sender->name }} :</strong> {{ $send->message }}
                                        </div>
                                        @endif
                                        

                                        {{-- <div>
                                            <strong>{{ $send->reciever->name }}:</strong> Ok, contact: 91 0123456789 to arrange pickup
                                        </div> --}}
                                        
                                    </div>
                                    @if ($loop->last && $send->closed == 0)
                                    

                            
                            
                            
                            <div class="chat-input">
                                <form action="{{route('send_notification')}}" method="post">
                                    <div class="input-group mb-2">
                                    @csrf
                                    <input type="hidden" name="user" value="@if($send->reciever->name == Auth::user()->name){{$send->sender_id}}@else{{$send->reciever_id}}@endif">
                                    <input type="hidden" name="item" value="{{ $send->item_id }}">
                                    <input type="text" name="message" class="form-control" placeholder="Type a message...">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </div>
                            </form>
                            </div>
                            <div class="action-buttons">
                                    <a class="btn btn-success" href="{{ route('delete_notification',$send->item_id) }}">Received</a>
                                    <a class="btn btn-danger" href="{{ route('cancel_notification',$send->item_id) }}">Cancel</a>
                                </div>
                            
                            @endif
                            @endforeach
                        </div>
                    </div>
                        </div>
                    </div>
                @endforeach
            
        

        <!-- Seller Notification -->
        
            
            
        @foreach ($recievers as $sendGroup)
                <div class="alert alert-primary alert-dismissible fade show alert-notification" role="alert">
                    
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
                        @foreach ($sendGroup as $send)
                        @if ($loop->first)
                            <div class="d-flex flex-row align-items-center mb-2 mb-md-0 me-md-3">
                                <img class="item-image" src="{{ asset('/storage/' . ($send->item->item_pics && $send->item->item_pics->count() > 0 ? $send->item->item_pics->first()->image : 'default.png')) }}" alt="Gold Coin">
                                <div class="item-details">
                                    <span class="fw-bold">{{ $send->item->title }},</span>
                                    <span>Price: {{ $send->item->points_required }},</span>
                                    <span>Q: {{ $send->quantity }},</span>
                                    <span>Total: {{ $send->item->points_required * $send->quantity }}</span>
                                </div>
                            </div>
                        
                            <div class="notification-content">
                                <div><img src="@if ($send->sender->profile_image != NULL)
                                                    {{ asset('/storage/'.$send->sender->profile_image); }}
                                                @else
                                                    {{ asset('/images/GreenBird.png'); }}
                                                @endif"
                                        class="profile-avatar rounded-circle">
                                    <strong>{{ $send->sender->name }}</strong>
                                
                        @endif
                        @endforeach
                        @foreach ($sendGroup as $send)
                            <div class="chat">
                                @if ($send->sender->name == Auth::user()->name)
                                    <div>
                                        <strong>You:</strong> {{ $send->message }}
                                    </div>
                                    @else
                                    <div>
                                        <strong>{{ $send->sender->name }} :</strong> {{ $send->message }}
                                    </div>
                                @endif
                            </div>
                            
                            @if ($loop->last && $send->closed == 0)
                                
                            
                                <div class="chat-input">
                                    <form action="{{route('send_notification')}}" method="post">
                                            <div class="input-group mb-2">
                                            @csrf
                                            <input type="hidden" name="user" value="@if($send->reciever->name == Auth::user()->name){{$send->sender_id}}@else{{$send->reciever_id}}@endif">
                                            <input type="hidden" name="item" value="{{ $send->item_id }}">
                                            <input type="text" name="message" class="form-control" placeholder="Type a message...">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="bi bi-send"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <form action="{{ route('send_time') }}" method="post">
                                    @csrf
                                    <div class="datetime-picker">
                                        <input type="hidden" name="user" value="@if($send->reciever->name == Auth::user()->name){{$send->sender_id}}@else{{$send->reciever_id}}@endif">
                                        <input type="hidden" name="item" value="{{ $send->item_id }}">
                                        <label for="pickup-time">Pickup time:</label>
                                        <input type="datetime-local" id="pickup-time" name="pickup_time">
                                        <button type="submit" class="btn btn-primary">Set</button>
                                    </div>
                                </form>
            
                                <div class="action-buttons">
                                    <a href="{{ route('cancel_notification',$send->item_id) }}" class="btn btn-danger">Cancel</a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                                    
                </div>
                        
                    </div>
                    
                </div>
                @endforeach
        
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips if needed
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>