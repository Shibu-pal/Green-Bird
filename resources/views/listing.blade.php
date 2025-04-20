<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenBird</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    
    <style>
        body {
            padding-top: 80px;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: white !important;
        }
        
        .search-container {
            flex-grow: 1;
            max-width: 500px;
            margin: 0 15px;
        }
        
        .nav-item {
            margin: 0 5px;
        }
        
        .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.8rem;
        }
        
        .nav-icon-text {
            margin-top: 2px;
        }
        
        .listing-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .form-title {
            color: #4CAF50;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .form-label {
            font-weight: 500;
        }
        
        .condition-radio {
            margin-right: 15px;
        }
        
        .condition-radio input {
            margin-right: 5px;
        }
        
        .image-upload-container {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .image-upload-container:hover {
            border-color: #4CAF50;
        }
        
        .preview-image {
            max-width: 100px;
            max-height: 100px;
            margin: 5px;
            border-radius: 5px;
        }
        
        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        
        .btn-primary:hover {
            background-color: #3e8e41;
            border-color: #3e8e41;
        }
        
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 15px;
        }
        
        .image-preview-item {
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        
        .remove-image {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;
        }
        @media (max-width: 991.98px) {
    body {
        padding-top: 150px;
    }
    .search-container {
        width: 100%;
        order: 1;
        padding: 0.5rem 0;
    }
}
    </style>
</head>
<body>
    <!-- NavbarTop -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <!-- Brand Icon and Name -->
            <!-- <a class="navbar-brand me-2" href="#">
                <i class="bi bi-shop"></i> IGO
            </a> -->

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="images\GreenBird.png" height="50" class="me-2"
                    alt="GreenBird Logo">
                <span class="fw-bold"
                    style="font-family: 'Brush Script MT', cursive; background: linear-gradient(to right, #4CAF50, #FFEB3B); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">GreenBird</span>
            </a>

            <!-- Home -->
            <div class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="bi bi-house"></i>
                    <span class="nav-icon-text">Home</span>
                </a>
            </div>

            <!-- Search bar -->
            <!-- <div class="search-container">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div> -->

            <!-- Wallet -->
            <div class="nav-item">
                <a class="nav-link" href="A:\Green Bird\css\login\login.html">
                    <i class="bi bi-wallet2"></i>
                    <span class="nav-icon-text">Wallet</span>
                </a>
            </div>

            <!-- Chatbox -->
            <div class="nav-item">
                
                    <a class="nav-link" href="frontend\chat.html">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="nav-icon-text">Chatbox</span>
                    </a>
                
                
            </div>

            <!-- Notifications -->
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bell"></i>
                    <span class="nav-icon-text">Notifications</span>
                </a>
            </div>
            <!-- Profile -->
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
                    <li><a class="dropdown-item" href="#"><i class="bi bi-heart me-2"></i>Wishlist</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-clock-history me-2"></i>Purchase History</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                </ul>
            </div>

            <!-- Seller Button -->
            <div class="nav-item">
                <a class="btn btn-primary btn-sm" href="#">
                    <!-- <i class="bi bi-currency-dollar"></i> -->
                    <span class="nav-icon-text">Sell</span>
                </a>
            </div>

            <!-- Theme Dropdown -->
            <!-- <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-palette"></i>
                    <span class="nav-icon-text">Theme</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item theme-item" href="#" data-theme="light">Light</a></li>
                    <li><a class="dropdown-item theme-item" href="#" data-theme="dark">Dark</a></li>
                    <li><a class="dropdown-item theme-item" href="#" data-theme="blue">Blue</a></li>
                    <li><a class="dropdown-item theme-item" href="#" data-theme="green">Green</a></li>
                </ul>
            </div> -->
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="listing-container">
                    <h2 class="form-title text-center"><i class="bi bi-plus-circle"></i> List Your Item</h2>
                    
                    <form id="itemListingForm" action="{{ route('selling') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- Item Name -->
                        <div class="mb-3">
                            <label for="itemName" class="form-label">Item Name*</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="itemName" placeholder="What are you listing?" required>
                        </div>
                        
                        <!-- Item Description -->
                        <div class="mb-3">
                            <label for="itemDescription" class="form-label">Description*</label>
                            <textarea class="form-control" value="{{ old('description') }}" name="description" id="itemDescription" rows="3" placeholder="Describe your item in detail..." required></textarea>
                            <div class="form-text">Be honest about the condition and include any flaws.</div>
                        </div>
                        
                        <!-- Item Condition -->
                        <div class="mb-3">
                            <label class="form-label">Condition*</label>
                            <div class="d-flex flex-wrap">
                                <div class="condition-radio">
                                    <input type="radio" class="btn-check" value="New" name="condition" id="new" autocomplete="off" checked>
                                    <label class="btn btn-outline-success" for="new">New</label>
                                </div>
                                <div class="condition-radio">
                                    <input type="radio" class="btn-check" value="Like New" name="condition" id="likeNew" autocomplete="off">
                                    <label class="btn btn-outline-success" for="likeNew">Like New</label>
                                </div>
                                <div class="condition-radio">
                                    <input type="radio" class="btn-check" value="Good" name="condition" id="good" autocomplete="off">
                                    <label class="btn btn-outline-success" for="good">Good</label>
                                </div>
                                <div class="condition-radio">
                                    <input type="radio" class="btn-check" value="Fair" name="condition" id="fair" autocomplete="off">
                                    <label class="btn btn-outline-success" for="fair">Fair</label>
                                </div>
                                <div class="condition-radio">
                                    <input type="radio" class="btn-check" value="Poor" name="condition" id="poor" autocomplete="off">
                                    <label class="btn btn-outline-success" for="poor">Poor</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Price in Coins -->
                        <div class="mb-3">
                            <label for="itemPrice" class="form-label">Price (in GreenBird Coins)*</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-coin"></i></span>
                                <input type="number" value="{{ old('price') }}" name="price" class="form-control" id="itemPrice" placeholder="100" min="1" required>
                            </div>
                            <div class="form-text">You currently have: {{ Auth::user()->points_balance }} coins</div>
                        </div>
                        
                        <!-- Category -->
                        <div class="mb-3">
                            <label for="itemCategory" class="form-label">Category*</label>
                            <select class="form-select" value="{{ old('category') }}" name="category" id="itemCategory" required>
                                <option value="" selected disabled>Select a category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Furniture">Furniture</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Books">Books</option>
                                <option value="Home & Garden">Home & Garden</option>
                                <option value="Sports & Outdoors">Sports & Outdoors</option>
                                <option value="Toys & Games">Toys & Games</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <!-- Location -->
                        <div class="mb-3">
                            <label for="itemLocation" class="form-label">Pickup Location*</label>
                            <input type="text" value="{{ old('location') }}" name="location" class="form-control" id="itemLocation" placeholder="Where can the buyer pick up the item?" required>
                            <div class="form-text">Exact address will be shared only after purchase confirmation</div>
                        </div>
                        
                        <!-- Images Upload -->
                        <div class="mb-4">
                            <label class="form-label">Item Photos*</label>
                            <div class="image-upload-container" id="imageUploadContainer">
                                <i class="bi bi-camera" style="font-size: 2rem; color: #6c757d;"></i>
                                <p class="mt-2">Click to upload or drag and drop</p>
                                <p class="small text-muted">Upload at least 1 photo (max 5)</p>
                                <input type="file" name="images[]" id="imageUpload" accept="image/*" multiple style="display: none;">
                            </div>
                            <div class="image-preview-container" id="imagePreviewContainer"></div>
                        </div>
                        
                        <!-- Terms Agreement -->
                        <div class="mb-4 form-check">
                            <input type="checkbox" name="check" class="form-check-input" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">I agree to GreenBird's <a href="#">Terms of Service</a> and confirm this item follows our <a href="#">Community Guidelines</a></label>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> List Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image upload functionality
            const imageUploadContainer = document.getElementById('imageUploadContainer');
            const imageUpload = document.getElementById('imageUpload');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            let uploadedImages = [];
            
            // Click on container triggers file input
            imageUploadContainer.addEventListener('click', function() {
                imageUpload.click();
            });
            
            // Handle file selection
            imageUpload.addEventListener('change', function(e) {
                const files = e.target.files;
                
                for (let i = 0; i < files.length; i++) {
                    if (uploadedImages.length >= 5) {
                        alert('You can upload a maximum of 5 images');
                        break;
                    }
                    
                    const file = files[i];
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(event) {
                            const imageData = event.target.result;
                            uploadedImages.push(imageData);
                            updateImagePreview();
                        };
                        
                        reader.readAsDataURL(file);
                    }
                }
            });
            
            // Update the image preview display
            function updateImagePreview() {
                imagePreviewContainer.innerHTML = '';
                
                uploadedImages.forEach((imageData, index) => {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'image-preview-item';
                    
                    const img = document.createElement('img');
                    img.src = imageData;
                    img.className = 'preview-image';
                    
                    const removeBtn = document.createElement('span');
                    removeBtn.className = 'remove-image';
                    removeBtn.innerHTML = '×';
                    removeBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        uploadedImages.splice(index, 1);
                        updateImagePreview();
                    });
                    
                    previewItem.appendChild(img);
                    previewItem.appendChild(removeBtn);
                    imagePreviewContainer.appendChild(previewItem);
                });
            }
            
            // Drag and drop functionality
            imageUploadContainer.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#4CAF50';
                this.style.backgroundColor = 'rgba(76, 175, 80, 0.1)';
            });
            
            imageUploadContainer.addEventListener('dragleave', function() {
                this.style.borderColor = '#ddd';
                this.style.backgroundColor = '';
            });
            
            // imageUploadContainer.addEventListener('drop', function(e) {
            //     e.preventDefault();
            //     this.style.borderColor = '#ddd';
            //     this.style.backgroundColor = '';
                
            //     const files = e.dataTransfer.files;
            //     const input = document.getElementById('imageUpload');
            //     input.files = files;
                
            //     // Trigger the change event
            //     const event = new Event('change');
            //     input.dispatchEvent(event);
            // });
            
            // Form submission
            // document.getElementById('itemListingForm').addEventListener('submit', function(e) {
            //     e.preventDefault();
                
            //     // Validate images
            //     if (uploadedImages.length === 0) {
            //         alert('Please upload at least one image of your item');
            //         return;
            //     }
                
            //     // If all validations pass
            //     alert('Item listed successfully!');
            //     // Here you would typically send the data to your backend
            //     // For now, we'll just log it
            //     const formData = {
            //         name: document.getElementById('itemName').value,
            //         description: document.getElementById('itemDescription').value,
            //         condition: document.querySelector('input[name="condition"]:checked').id,
            //         price: document.getElementById('itemPrice').value,
            //         category: document.getElementById('itemCategory').value,
            //         location: document.getElementById('itemLocation').value,
            //         images: uploadedImages
            //     };
                
            //     console.log('Form data:', formData);
                
            //     // Reset form
            //     this.reset();
            //     uploadedImages = [];
            //     updateImagePreview();
            // });
        });
        
    </script>
</body>
</html>