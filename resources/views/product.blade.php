<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenBird</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }

        body {
            background-color: #f8f9fa;
            padding-top: 56px;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
            border-radius: 8px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--primary-color);
        }

        .product-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--success-color);
            margin-bottom: 1.5rem;
        }

        .product-rating {
            margin-bottom: 1.5rem;
        }

        .rating-stars {
            color: var(--warning-color);
            margin-right: 10px;
        }

        .rating-count {
            color: var(--secondary-color);
        }

        .product-description {
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6;
            background-color: white;
            font-size: 1.2rem;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            height: 40px;
            border-left: none;
            border-right: none;
            font-weight: 600;
        }

        .btn-add-to-cart {
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .btn-buy-now {
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .product-meta {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .meta-item {
            margin-bottom: 0.8rem;
        }

        .meta-label {
            font-weight: 600;
            margin-right: 10px;
            color: var(--dark-color);
        }

        .meta-value {
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .product-title {
                font-size: 1.6rem;
                margin-top: 1rem;
            }

            .product-price {
                font-size: 1.5rem;
            }

            .thumbnail-container {
                margin-top: 1rem;
                display: flex;
                overflow-x: auto;
                padding-bottom: 10px;
            }

            .thumbnail {
                margin-right: 10px;
                flex-shrink: 0;
            }

            .btn-add-to-cart,
            .btn-buy-now {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Green Bird</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Wallet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notification') }}">Chatbox</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notification') }}">Notifications</a>
                    </li>
                    @auth
                        <div class="nav-item dropdown btn btn-sm btn-outline-info">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="@if (Auth::user()->profile_image != NULL)
                                        {{ asset('/storage/'.Auth::user()->profile_image); }}
                                    @else
                                        {{ asset('/images/GreenBird.png'); }}
                                    @endif" alt="Profile" class="rounded-circle me-1" width="24"
                                    height="24">
                                <span class="nav-icon-text">{{ Auth::user()->name }}</span>
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
                                <li><a class="dropdown-item" href="frontend/profile.html"><i
                                            class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                <li><a class="dropdown-item" href="{{ route('cart_list') }}"><i class="bi bi-heart me-2"></i>Wishlist</a></li>
                                <li><a class="dropdown-item" href="{{ route('notification') }}"><i class="bi bi-clock-history me-2"></i>Purchase History</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link cart-icon" href="{{ route('cart_list') }}">
                            <i class="fas fa-shopping-cart"></i>
                            @auth
                            <span class="cart-count">{{ $cart_count }}</span>
                            @endauth
                            
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Product Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6">
                <div class="mb-4">
                    <img src="{{ asset('/storage/' . ($products->item_pics && $products->item_pics->count() > 0 ? $products->item_pics->first()->image : 'default.png')) }}" alt="{{ $products->title }}"
                        class="product-image" id="main-image">
                </div>
                <div class="thumbnail-container">
                    @foreach ($products->item_pics as $pics)
                    <img src="{{ asset('/storage/' . ($pics->image ?? 'default.png')) }}" alt="Thumbnail 1" class="thumbnail active"
                        onclick="changeImage(this)">
                    @endforeach
                    {{-- <img src="images/GreenBird_GoldCoin.png" alt="Thumbnail 2" class="thumbnail"
                        onclick="changeImage(this)">
                    <img src="images/GreenBird_GreenCoin_Boder.png" alt="Thumbnail 3" class="thumbnail"
                        onclick="changeImage(this)">
                    <img src="images/GreenBird_.png" alt="Thumbnail 4" class="thumbnail"
                        onclick="changeImage(this)"> --}}
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6">
                <h1 class="product-title">{{ $products->title }}</h1>
                {{-- <div class="product-rating">
                    <span class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </span>
                    <span class="rating-count">4.5 (128 reviews)</span>
                </div> --}}
                <div class="product-price"><img src="{{ asset('images/GreenBird_GreenCoin._3png.png') }}" height="40px" width="40px">{{ $products->points_required }}</div>
                <div class="product-description">
                    {{ $products->description }}
                    {{-- <p>Experience crystal-clear sound with our premium wireless headphones. Featuring active noise
                        cancellation, 30-hour battery life, and comfortable over-ear design. Perfect for music lovers
                        and professionals alike.</p>
                    <ul>
                        <li>Active Noise Cancellation technology</li>
                        <li>30-hour battery life with quick charge</li>
                        <li>Bluetooth 5.0 with 30ft range</li>
                        <li>Built-in microphone for calls</li>
                        <li>Foldable design with carrying case</li>
                    </ul> --}}
                </div>

                <div class="quantity-control">
                    <span class="me-3" style="font-weight: 500;">Quantity:</span>
                    <button class="quantity-btn minus">-</button>
                    <input type="number" class="form-control quantity-input" value="1" min="1">
                    <button class="quantity-btn plus">+</button>
                </div>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('add_cart',$products->id) }}" class="btn btn-primary btn-add-to-cart">
                        <i class="fas fa-cart-plus me-2"></i> Add to Cart
                    </a>
                    <a href="{{ route('set_notification',$products->id) }}" class="btn btn-buy-now btn btn-success text-white">
                        <i class="fas fa-bolt me-2"></i> Buy Now
                    </a>
                </div>

                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">Location:</span>
                        <span class="meta-value">{{ $products->location }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Condition:</span>
                        <span class="meta-value">{{ $products->condition }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Status:</span>
                        <span class="meta-value text-success">{{ $products->status }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Category:</span>
                        <span class="meta-value">{{ $products->category }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="container my-5">
        <h3 class="mb-4">You May Also Like</h3>
        <div class="row">
            <!-- Product 1 -->
            @foreach ($items as $item)
                
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('/storage/'.(($item->item_pics && $item->item_pics->count() > 0 ? $item->item_pics->first()->image : 'default.png'))) }}" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        {{-- <div class="text-warning mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div> --}}
                        <p class="card-text text-success fw-bold">{{ $item->points_required }}</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('add_cart',$item->id) }}" class="btn btn-sm btn-outline-primary w-100">Add to Cart</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Product 2 -->
            {{-- <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x300?text=Product+2" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Bluetooth Speaker</h5>
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p class="card-text text-success fw-bold">$59.99</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-sm btn-outline-primary w-100">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x300?text=Product+3" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Wired Headphones</h5>
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="card-text text-success fw-bold">$49.99</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-sm btn-outline-primary w-100">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300x300?text=Product+4" class="card-img-top" alt="Product 4">
                    <div class="card-body">
                        <h5 class="card-title">Portable DAC</h5>
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p class="card-text text-success fw-bold">$89.99</p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="frontend\cart.html"></a>
                        <button class="btn btn-sm btn-outline-primary w-100">Add to Cart</button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    <!-- Product JavaScript -->
    <script>
        // Change main image when thumbnail is clicked
        function changeImage(element) {
            const mainImage = document.getElementById('main-image');
            mainImage.src = element.src;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            element.classList.add('active');
        }

        // Quantity controls
        document.addEventListener('DOMContentLoaded', function () {
            const minusBtn = document.querySelector('.minus');
            const plusBtn = document.querySelector('.plus');
            const quantityInput = document.querySelector('.quantity-input');

            minusBtn.addEventListener('click', function () {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                }
            });

            plusBtn.addEventListener('click', function () {
                let value = parseInt(quantityInput.value);
                quantityInput.value = value + 1;
            });

            quantityInput.addEventListener('change', function () {
                if (parseInt(this.value) < 1) {
                    this.value = 1;
                }
            });

            // Add to cart button
            const addToCartBtn = document.querySelector('.btn-add-to-cart');
            addToCartBtn.addEventListener('click', function () {
                const productName = document.querySelector('.product-title').textContent;
                const quantity = parseInt(quantityInput.value);
                alert(`${quantity} ${productName} added to cart!`);

                // In a real app, you would add to cart here
            });

            // Buy now button
            const buyNowBtn = document.querySelector('.btn-buy-now');
            buyNowBtn.addEventListener('click', function () {
                const productName = document.querySelector('.product-title').textContent;
                const quantity = parseInt(quantityInput.value);
                alert(`You're buying ${quantity} ${productName} now!`);

                // In a real app, you would redirect to checkout
            });
        });
    </script>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>