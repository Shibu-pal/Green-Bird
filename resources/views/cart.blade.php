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

        .cart-item-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6;
            background-color: white;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border-left: none;
            border-right: none;
        }

        .summary-card {
            position: sticky;
            top: 80px;
        }

        .price-col {
            font-weight: bold;
            color: var(--success-color);
            font-size: 1.1rem;
        }

        .quantity-col {
            display: flex;
            align-items: center;
        }

        .buy-now-btn {
            background-color: var(--success-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            margin-left: 15px;
        }

        .buy-now-btn:hover {
            background-color: #157347;
            color: white;
        }

        .cart-item-container {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-actions {
            display: flex;
            align-items: center;
        }

        @media (max-width: 768px) {
            .cart-item-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item-img {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .item-actions {
                width: 100%;
                justify-content: space-between;
                margin-top: 15px;
            }

            .buy-now-btn {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand">
                <img src="images/GreenBird.png" height="10%" width="10%">
                GreenBird Bird
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Wallet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notification') }}">Chatbox</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notification') }}">Notifications</a>
                    </li>
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
                                @endif" alt="Profile" class="rounded-circle me-2" width="40"
                                        height="40">
                                    <div>
                                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="frontend/profile.html">
                                    <i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><a class="dropdown-item" href="{{ route('cart_list') }}"><i class="bi bi-heart me-2"></i>Wishlist</a></li>
                            <li><a class="dropdown-item" href="{{ route('notification') }}"><i class="bi bi-clock-history me-2"></i>Purchase
                                    History</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link cart-icon" href="{{ route('cart_list') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">4</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cart Content -->
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Shopping Cart (4 items)</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($carts as $cart)
                            
                        
                        <!-- Product 1 -->
                        <div class="cart-item-container">
                            <img src="{{ asset('/storage/' . ($cart->item->item_pics && $cart->item->item_pics->count() > 0 ? $cart->item->item_pics->first()->image : 'default.png')) }}" alt="{{ $cart->item->title }}" class="cart-item-img">
                            <div class="item-details">
                                <h5>{{ $cart->item->title }}</h5>
                                <p class="text-muted">{{ $cart->item->description }}</p>
                                <a class="btn btn-sm btn-outline-danger remove-item" href="{{ route('remove_cart',$cart->id) }}">
                                    <i class="fas fa-trash" href="#"></i> Remove
                                </a>
                            </div>
                            <div class="item-actions">
                                <div class="quantity-col">
                                    <button class="quantity-btn minus">-</button>
                                    <input type="number" class="form-control quantity-input" value="1" min="1">
                                    <button class="quantity-btn plus">+</button>
                                </div>
                                <div class="price-col ms-3 me-4">
                                    {{ $cart->item->points_required }}
                                </div>
                                <a href="{{ route('set_notification', $cart->item->id) }}"><button class="buy-now-btn">Buy Now</button></a>
                            </div>
                        </div>
                        @endforeach
                        {{-- <!-- Product 2 -->
                        <div class="cart-item-container">
                            <img src="https://via.placeholder.com/120" alt="Smart Watch" class="cart-item-img">
                            <div class="item-details">
                                <h5>Smart Watch</h5>
                                <p class="text-muted">Fitness tracker with heart rate monitor and GPS</p>
                                <button class="btn btn-sm btn-outline-danger remove-item">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="item-actions">
                                <div class="quantity-col">
                                    <button class="quantity-btn minus">-</button>
                                    <input type="number" class="form-control quantity-input" value="1" min="1">
                                    <button class="quantity-btn plus">+</button>
                                </div>
                                <div class="price-col ms-3 me-4">
                                    199.99
                                </div>
                                <a href="chat.html"><button class="buy-now-btn">Buy Now</button></a>

                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div class="cart-item-container">
                            <img src="https://via.placeholder.com/120" alt="Bluetooth Speaker" class="cart-item-img">
                            <div class="item-details">
                                <h5>Bluetooth Speaker</h5>
                                <p class="text-muted">Portable waterproof speaker with 20W output</p>
                                <button class="btn btn-sm btn-outline-danger remove-item">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="item-actions">
                                <div class="quantity-col">
                                    <button class="quantity-btn minus">-</button>
                                    <input type="number" class="form-control quantity-input" value="2" min="1">
                                    <button class="quantity-btn plus">+</button>
                                </div>
                                <div class="price-col ms-3 me-4">
                                    59.99
                                </div>
                                <a href="chat.html"><button class="buy-now-btn">Buy Now</button></a>
                            </div>
                        </div>

                        <!-- Product 4 -->
                        <div class="cart-item-container">
                            <img src="https://via.placeholder.com/120" alt="Laptop Backpack" class="cart-item-img">
                            <div class="item-details">
                                <h5>Laptop Backpack</h5>
                                <p class="text-muted">Water-resistant backpack with USB charging port</p>
                                <button class="btn btn-sm btn-outline-danger remove-item">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                            <div class="item-actions">
                                <div class="quantity-col">
                                    <button class="quantity-btn minus">-</button>
                                    <input type="number" class="form-control quantity-input" value="1" min="1">
                                    <button class="quantity-btn plus">+</button>
                                </div>
                                <div class="price-col ms-3 me-4">
                                    49.99
                                </div>
                                <a href="chat.html"><button class="buy-now-btn">Buy Now</button></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card summary-card">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal (4 items):</span>
                            <span id="subtotal">409.96</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span id="shipping">9.99</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <span id="tax">32.80</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3 fw-bold">
                            <span>Total:</span>
                            <span id="total">452.75</span>
                        </div>
                        {{-- <a href="chat.html"><button class="btn btn-primary w-100 mb-2" id="checkout-btn">Proceed to
                                Checkout</button></a> --}}

                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Functionality JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // DOM Elements
            const minusButtons = document.querySelectorAll('.minus');
            const plusButtons = document.querySelectorAll('.plus');
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const removeButtons = document.querySelectorAll('.remove-item');
            const buyNowButtons = document.querySelectorAll('.buy-now-btn');
            const subtotalElement = document.getElementById('subtotal');
            const shippingElement = document.getElementById('shipping');
            const taxElement = document.getElementById('tax');
            const totalElement = document.getElementById('total');
            const cartCountElement = document.querySelector('.cart-count');

            // Product data
            const products = [
                @foreach ($carts as $count)
                { price: {{ $count->item->points_required }}, quantity: 1 },
                @endforeach
                { price: 99.99, quantity: 1 },
                // { price: 199.99, quantity: 1 },
                // { price: 59.99, quantity: 2 },
                // { price: 49.99, quantity: 1 }
            ];

            // Initialize totals
            updateTotals();

            // Add event listeners to quantity buttons
            minusButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const input = this.nextElementSibling;
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                        updateProductQuantity(this);
                        updateTotals();
                    }
                });
            });

            plusButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const input = this.previousElementSibling;
                    input.value = parseInt(input.value) + 1;
                    updateProductQuantity(this);
                    updateTotals();
                });
            });

            // Add event listeners to quantity inputs
            quantityInputs.forEach(input => {
                input.addEventListener('change', function () {
                    if (parseInt(this.value) < 1) {
                        this.value = 1;
                    }
                    updateProductQuantity(this);
                    updateTotals();
                });
            });

            // Add event listeners to remove buttons
            // removeButtons.forEach(button => {
            //     button.addEventListener('click', function () {
            //         const cartItem = this.closest('.cart-item-container');
            //         cartItem.remove();
            //         updateTotals();
            //     });
            // });

            // Add event listeners to buy now buttons
            buyNowButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const cartItem = this.closest('.cart-item-container');
                    const productName = cartItem.querySelector('h5').textContent;
                    alert(`You're buying ${productName} now!`);
                    // In a real app, this would redirect to checkout with just this item
                });
            });

            // Function to update product quantity in the products array
            function updateProductQuantity(element) {
                const cartItem = element.closest('.cart-item-container');
                const index = Array.from(document.querySelectorAll('.cart-item-container')).indexOf(cartItem);
                const quantity = parseInt(cartItem.querySelector('.quantity-input').value);
                products[index].quantity = quantity;
            }

            // Function to calculate and update all totals
            function updateTotals() {
                // Calculate subtotal
                let subtotal = 0;
                let totalItems = 0;

                document.querySelectorAll('.cart-item-container').forEach((item, index) => {
                    const price = products[index].price;
                    const quantity = parseInt(item.querySelector('.quantity-input').value);
                    subtotal += price * quantity;
                    totalItems += quantity;
                });

                // Calculate shipping (free for orders over $100)
                const shipping = subtotal > 100 ? 0 : 9.99;

                // Calculate tax (8%)
                const tax = subtotal * 0.08;

                // Calculate total
                const total = subtotal + shipping + tax;

                // Update UI
                subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
                shippingElement.textContent = shipping === 0 ? 'FREE' : `$${shipping.toFixed(2)}`;
                taxElement.textContent = `$${tax.toFixed(2)}`;
                totalElement.textContent = `$${total.toFixed(2)}`;
                cartCountElement.textContent = totalItems;

                // Update cart header
                const cartHeader = document.querySelector('.card-header h4');
                cartHeader.textContent = `Shopping Cart (${totalItems} ${totalItems === 1 ? 'item' : 'items'})`;
            }
        });
    </script>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>