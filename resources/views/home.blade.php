<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenBird</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Main CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <!-- Theme CSS -->
    {{-- <link id="theme-style" href="{{ asset('css/themes/light.css') }}" rel="stylesheet"> --}}
    <!-- ItemBox CSS -->
    <link href="{{ asset('css/itembox.css') }}" rel="stylesheet">
    
</head>

<body>
    
<!-------Navbartop ------------------------------------------------------------------------------------------>
    <!-- screen size Laptop and more -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <!-- Mobile menu toggle button -->
            <button class="navbar-toggler offcanvas-btn me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Brand Icon and Name -->
            <a class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('images/GreenBird.png') }}" height="30" class="me-2" alt="#">
                <span>GreenBird</span>
            </a>

            <!-- Desktop Navigation Items -->
            <div class="desktop-nav-items d-none d-lg-flex">
                <!-- Home -->
                <div class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="bi bi-house"></i>
                        <span class="nav-icon-text">Home</span>
                    </a>
                </div>

                <!-- Wallet -->
                <div class="nav-item mx-2">
                    <a class="nav-link" href="A:\Green Bird\css\login\login.html">
                        <i class="bi bi-wallet2"></i>
                        <span class="nav-icon-text">Wallet</span>
                    </a>
                </div>

                <!-- Chatbox -->
                <div class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('notification') }}">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="nav-icon-text">Chatbox</span>
                    </a>
                </div>

                

                <!-- Seller Button -->
                <div class="nav-item mx-2">
                    <a class="nav-link btn btn-primary btn-bg-primary btn-sm" href="{{ route('sell') }}">
                        <span class="nav-icon-text">Sell</span>
                    </a>
                </div>
            </div>

            <!-- Search bar - will move below on mobile -->
            <div class="search-container d-lg-flex">
                <form class="d-flex w-100">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <!-- Right side items - visible on all screens -->
            <div class="right-items d-flex align-items-center">
                <!-- Notifications -->
                <div class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('notification') }}">
                        <i class="bi bi-bell"></i>
                        <span class="nav-icon-text d-none d-lg-inline">Notifications</span>
                    </a>
                </div>

                <!-- Total cart -->
                <div class="nav-item mx-2">
                    <a class="nav-link cart-icon" href="{{ route('cart_list') }}">
                        <i class="bi bi-cart4"></i>
                        <span class="nav-icon-text d-none d-lg-inline">Cart</span>
                    </a>
                </div>
                @guest
                    
                
                <!-- Sign In -->
                <div class="nav-item mx-2">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="nav-icon-text">Sign In</span>
                    </a>
                </div>
                @endguest
                @auth
                    
                
                <!-- Profile Dropdown -->
                <div class="nav-item dropdown d-flex mx-2 ">
                    <a class="  nav-link dropdown-toggle d-flex justify-content-center align-items-center " href="#"
                        role="button" data-bs-toggle="dropdown">
                        <img src="@if (Auth::user()->profile_image != NULL)
                                    {{ asset('/storage/'.Auth::user()->profile_image); }}
                                @else
                                    {{ asset('/images/GreenBird.png'); }}
                                @endif" alt="..." class="rounded-circle me-1 bg-primary"
                            width="24" height="24">
                        <span class="nav-icon-text d-none d-lg-inline">Profile </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <div class="dropdown-header d-flex align-items-center px-3 py-2">
                                {{-- <img src="{{ if(Auth::user()->profile_image != NULL){ asset('/storage'.Auth::user()->profile_image);}else{ asset('/images/GreenBird.png');} }}" alt="Profile" class="rounded-circle me-2" --}}
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
                        <li><a class="dropdown-item" href="frontend/profile.html"><i
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
                @endauth
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
                <li class="nav-item">
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
                @guest
                    <!-- Sign In -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span class="nav-icon-text">Sign In</span>
                    </a>
                </li>
                @endguest
                

                <!-- Seller Button -->
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-sm" href="{{ route('sell') }}">
                        <span class="nav-icon-text">Sell</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- -----Navbardown----------------------------------------------------------------------------------------->
    <!-- NavbarDown -->
    <div class="container-fluid navbar_down bg-light py-2 d-flex justify-content-start">

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Items
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('category','Electronics') }}">Electronics</a></li>
                <li><a class="dropdown-item" href="{{ route('category','Furniture') }}">Furniture</a></li>
                <li><a class="dropdown-item" href="{{ route('category','Clothing') }}">Clothing</a></li>
                <li><a class="dropdown-item" href="{{ route('category','Books') }}">Books</a></li>
                <li><a class="dropdown-item" href="{{ route('category','Home & Garden') }}">Home & Garden</a></li>
                <li><a class="dropdown-item" href="{{ route('category','Sports & Outdoors') }}">Sports & Outdoors</a></li>
                <li><a class="dropdown-item" href="{{ route('category','Toys & Games') }}">Toys & Games</a></li>
                <li><a class="dropdown-item" href="{{ route('category','Other') }}">Other</a></li>

            </ul>
        </div>


        <div class="scrolling-wrapper d-flex flex-nowrap overflow-auto">
            <div class="items mx-1"><a class="btn @if (isset($item) && $item == 'Electronics')
                btn-primary
            @else
                btn-outline-primary
            @endif" href="{{ route('category','Electronics') }}">Electronics</a></div>
            <div class="items mx-1"><a class="btn @if (isset($item) && $item == 'Clothing')
                btn-primary
            @else
                btn-outline-primary
            @endif" href="{{ route('category','Clothing') }}">Clothing</a></div>
            <div class="items mx-1"><a class="btn @if (isset($item) && $item == 'Furniture')
                btn-primary
            @else
                btn-outline-primary
            @endif" href="{{ route('category','Furniture') }}">Furniture</a></div>
            <div class="items mx-1"><a class="btn @if (isset($item) && $item == 'Books')
                btn-primary
            @else
                btn-outline-primary
            @endif" href="{{ route('category','Books') }}">Books</a></div>
            <div class="items mx-1"><a class="btn @if (isset($item) && $item == 'Home & Garden')
                btn-primary
            @else
                btn-outline-primary
            @endif" href="{{ route('category','Home & Garden') }}">Home & Garden</a></div>
            <div class="items mx-1"><a class="btn @if (isset($item) && $item == 'Sports & Outdoors')
                btn-primary
            @else
                btn-outline-primary
            @endif" href="{{ route('category','Sports & Outdoors') }}">Sports & Outdoors</a></div>
            <div class="items mx-1"><a class="btn @if (isset($item) && $item == 'Toys & Games')
                btn-primary
            @else
                btn-outline-primary
            @endif" href="{{ route('category','Toys & Games') }}">Toys & Games</a></div>
            <div class="items mx-1"><a class="btn @if (isset($item) && $item == 'Other')
                btn-primary
            @else
                btn-outline-primary
            @endif" href="{{ route('category','Other') }}">Other</a></div>
        </div>
    </div>

    <!-- Products -->

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">Give Items a Second Life</h1>
            <p class="hero-subtitle">Find items you need or give away what you don't use anymore - all without spending
                real money!</p>
            <div>
                <span class="stats-badge"><i class="bi bi-arrow-repeat"></i> 1,245 items reused</span>
                <span class="stats-badge"><i class="bi bi-people"></i> 589 active users</span>
                <span class="stats-badge"><i class="bi bi-tree"></i> 3.2 tons CO2 saved</span>
            </div>
        </div>
    </div>
    <!-- Alerts -->
    <div class="container-fluid bg-light text-dark w-100">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="container-fluid bg-light text-dark w-100">
        @guest
            <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                <strong>Hi,</strong> For buy, or sell please login, if you don't have account then create one.
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Signin</a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-sm">Signup</a>
                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endguest
    </div>
    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row">
            <div class="col-md-3">
                <select class="form-select" id="category-filter">
                    <option {{ request('category') == '' || !request('category') ? 'selected' : '' }}>All Categories</option>
                    <option {{ request('category') == 'Furniture' ? 'selected' : '' }}>Furniture</option>
                    <option {{ request('category') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                    <option {{ request('category') == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                    <option {{ request('category') == 'Books' ? 'selected' : '' }}>Books</option>
                    <option {{ request('category') == 'Kitchenware' ? 'selected' : '' }}>Kitchenware</option>
                    <option {{ request('category') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="condition-filter">
                    <option {{ request('condition') == '' || !request('condition') ? 'selected' : '' }}>Any Condition</option>
                    <option {{ request('condition') == 'New' ? 'selected' : '' }}>New</option>
                    <option {{ request('condition') == 'Used - Like New' ? 'selected' : '' }}>Used - Like New</option>
                    <option {{ request('condition') == 'Used - Good' ? 'selected' : '' }}>Used - Good</option>
                    <option {{ request('condition') == 'Used - Fair' ? 'selected' : '' }}>Used - Fair</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="location-filter">
                    <option {{ request('location') == '' || !request('location') ? 'selected' : '' }}>Any Location</option>
                    <option {{ request('location') == 'Within 5 km' ? 'selected' : '' }}>Within 5 km</option>
                    <option {{ request('location') == 'Within 10 km' ? 'selected' : '' }}>Within 10 km</option>
                    <option {{ request('location') == 'Within 20 km' ? 'selected' : '' }}>Within 20 km</option>
                    <option {{ request('location') == 'Same City' ? 'selected' : '' }}>Same City</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="sort-by">
                    <option {{ request('sort') == '' || !request('sort') ? 'selected' : '' }}>Sort by</option>
                    <option {{ request('sort') == 'Newest First' ? 'selected' : '' }}>Newest First</option>
                    <option {{ request('sort') == 'Price: Low to High' ? 'selected' : '' }}>Price: Low to High</option>
                    <option {{ request('sort') == 'Price: High to Low' ? 'selected' : '' }}>Price: High to Low</option>
                    <option {{ request('sort') == 'Nearest First' ? 'selected' : '' }}>Nearest First</option>
                </select>
            </div>
        </div>
    </div>
    <!-- product -->
    <div class="container-fluid product ">
        <div id="product-list">
            @include('partials.product_list')
        </div>
    </div>

    <div id="pagination">
        {{ $items->links() }}
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white pt-4">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Green Bird</h6>
                    <hr class="mb-2 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #fff; height: 2px" />
                    <p>
                        *"Our app connects people who have unused items with those who need them—using virtual coins
                        instead of real money. Sellers list items, buyers request & chat to arrange pickup, and coins
                        are transferred automatically upon delivery. It’s a simple, eco-friendly way to reuse goods,
                        reduce waste, and cut pollution!"*
                    </p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold">Links</h6>
                    <hr class="mb-2 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #fff; height: 2px" />
                    <p><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></p>
                    <!-- <p><a href="#" class="text-white text-decoration-none">About</a></p>
                    <p><a href="#" class="text-white text-decoration-none">Services</a></p>
                    <p><a href="#" class="text-white text-decoration-none">Contact</a></p> -->
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold">Contact</h6>
                    <hr class="mb-2 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #fff; height: 2px" />
                    <p><i class="fas fa-home me-2"></i> Kolkatta</p>
                    <p><i class="fas fa-envelope me-2"></i> info@example.com</p>
                    <p><i class="fas fa-phone me-2"></i> + 91 2345 6788 67</p>
                </div>
            </div>
        </div>
        <div class="text-center p-3 bg-secondary">
            © 2025 Green Bird. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <!-- Theme Switcher JS -->
    <script src="{{ asset('js/themes/theme-switcher.js') }}"></script> --}}

    <script src="{{  asset('js/index.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('category-filter');
            const conditionFilter = document.getElementById('condition-filter');
            const locationFilter = document.getElementById('location-filter');
            const sortBy = document.getElementById('sort-by');

            function updateFilters() {
                const params = new URLSearchParams();
                params.set('category', categoryFilter.value);
                params.set('condition', conditionFilter.value);
                params.set('location', locationFilter.value);
                params.set('sort', sortBy.value);

                fetch('{{ route("home") }}?' + params.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('product-list').innerHTML = data.html;
                    document.getElementById('pagination').innerHTML = data.pagination;
                    // Update URL without reloading
                    window.history.pushState({}, '', '{{ route("home") }}?' + params.toString());
                })
                .catch(error => console.error('Error:', error));
            }

            categoryFilter.addEventListener('change', updateFilters);
            conditionFilter.addEventListener('change', updateFilters);
            locationFilter.addEventListener('change', updateFilters);
            sortBy.addEventListener('change', updateFilters);

            // Handle pagination clicks
            document.getElementById('pagination').addEventListener('click', function(e) {
                if (e.target.tagName === 'A') {
                    e.preventDefault();
                    const url = new URL(e.target.href);
                    const params = url.searchParams;
                    // Add current filter values
                    params.set('category', categoryFilter.value);
                    params.set('condition', conditionFilter.value);
                    params.set('location', locationFilter.value);
                    params.set('sort', sortBy.value);

                    fetch('{{ route("home") }}?' + params.toString(), {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('product-list').innerHTML = data.html;
                        document.getElementById('pagination').innerHTML = data.pagination;
                        window.history.pushState({}, '', '{{ route("home") }}?' + params.toString());
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

</body>

</html>