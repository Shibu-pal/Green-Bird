// <!-- Navbar top mobile threeline vertical dropdown -->
        // Initialize offcanvas
        document.addEventListener('DOMContentLoaded', function () {
            var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
            var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
                return new bootstrap.Offcanvas(offcanvasEl)
            });
        });


        function changeImage(thumbnail) {
            // Get all thumbnails
            const thumbnails = document.querySelectorAll('.thumbnail');

            // Remove active class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));

            // Add active class to clicked thumbnail
            thumbnail.classList.add('active');

            // Change main image source to clicked thumbnail's source
            const mainImage = document.getElementById('mainImage');
            mainImage.src = thumbnail.src;
            mainImage.alt = thumbnail.alt;
        }
        // <!-- Custom JavaScript -->

        // Sample data for items
        const items = [
            {
                id: 1,
                name: "Wooden Bookshelf",
                description: "Solid oak bookshelf with 5 shelves. Perfect condition, just needs a new home.",
                price: 150,
                condition: "Used - Like New",
                location: "Downtown",
                category: "Furniture",
                image: "https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80",
                posted: "2 days ago"
            },
            {
                id: 2,
                name: "Coffee Maker",
                description: "Barely used coffee maker with all original accessories. Works perfectly.",
                price: 50,
                condition: "Used - Good",
                location: "Westside",
                category: "Kitchenware",
                image: "https://images.unsplash.com/photo-1595854341625-f33ee10dbf94?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80",
                posted: "1 week ago"
            },
            {
                id: 3,
                name: "Winter Jacket",
                description: "Heavy winter jacket, size M. Worn only a few times, looks brand new.",
                price: 80,
                condition: "Used - Like New",
                location: "North District",
                category: "Clothing",
                image: "https://images.unsplash.com/photo-1551232864-3f0890e580d9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80",
                posted: "3 days ago"
            },
            {
                id: 4,
                name: "JavaScript Book Collection",
                description: "Set of 3 JavaScript programming books for beginners to advanced developers.",
                price: 30,
                condition: "Used - Fair",
                location: "Eastside",
                category: "Books",
                image: "https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80",
                posted: "5 days ago"
            },
            {
                id: 5,
                name: "Office Chair",
                description: "Ergonomic office chair with adjustable height and lumbar support.",
                price: 75,
                condition: "Used - Good",
                location: "Central",
                category: "Furniture",
                image: "https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80",
                posted: "1 day ago"
            },
            {
                id: 6,
                name: "Blender",
                description: "High-powered blender with multiple speed settings. Great for smoothies.",
                price: 40,
                condition: "Used - Fair",
                location: "South District",
                category: "Kitchenware",
                image: "https://images.unsplash.com/photo-1573521193826-58c7dc2e13e3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80",
                posted: "2 weeks ago"
            },
            {
                id: 7,
                name: "Wireless Headphones",
                description: "Brand new wireless headphones still in original packaging.",
                price: 120,
                condition: "New",
                location: "Downtown",
                category: "Electronics",
                image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80",
                posted: "4 days ago"
            },
            {
                id: 8,
                name: "Yoga Mat",
                description: "Eco-friendly yoga mat with carrying strap. Lightly used.",
                price: 25,
                condition: "Used - Good",
                location: "Westside",
                category: "Other",
                image: "https://images.unsplash.com/photo-1545389336-cf090694435e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80",
                posted: "1 week ago"
            }
        ];

        // Function to render items
        function renderItems(itemsToRender) {
            const container = document.getElementById('items-container');
            container.innerHTML = '';

            if (itemsToRender.length === 0) {
                container.innerHTML = `
                    <div class="no-items">
                        <i class="bi bi-exclamation-circle" style="font-size: 3rem;"></i>
                        <h3 class="mt-3">No items found</h3>
                        <p>Try adjusting your filters or check back later for new listings.</p>
                    </div>
                `;
                return;
            }

            itemsToRender.forEach(item => {
                let conditionClass = '';
                if (item.condition.includes('New')) {
                    conditionClass = 'condition-new';
                } else if (item.condition.includes('Good')) {
                    conditionClass = 'condition-used';
                } else {
                    conditionClass = 'condition-fair';
                }

                const itemElement = `
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card h-100">
                            <img src="${item.image}" class="card-img-top" alt="${item.name}">
                            <div class="card-body">
                                <h5 class="card-title">${item.name}</h5>
                                <p class="card-text text-muted">${item.description}</p>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="${conditionClass}">${item.condition}</span>
                                    <span class="location-badge"><i class="bi bi-geo-alt"></i> ${item.location}</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-badge">${item.price} <i class="bi bi-coin"></i></span>
                                    <button class="btn btn-outline-primary btn-sm" onclick="showItemDetails(${item.id})">
                                        <i class="bi bi-eye"></i> View
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += itemElement;
            });
        }

        // Function to filter items
        function filterItems() {
            const category = document.getElementById('category-filter').value;
            const condition = document.getElementById('condition-filter').value;
            const location = document.getElementById('location-filter').value;

            let filteredItems = [...items];

            if (category !== 'All Categories') {
                filteredItems = filteredItems.filter(item => item.category === category);
            }

            if (condition !== 'Any Condition') {
                filteredItems = filteredItems.filter(item => item.condition.includes(condition));
            }

            if (location !== 'Any Location') {
                // In a real app, you would filter by actual distance
                filteredItems = filteredItems.filter(item => item.location.includes(location.split(' ')[0]));
            }

            renderItems(filteredItems);
        }

        // Function to show item details (would redirect to item page in real app)
        function showItemDetails(itemId) {
            const item = items.find(i => i.id === itemId);
            alert(`You clicked on: ${item.name}\n\nThis would redirect to the item details page where you can message the seller and arrange pickup.`);
        }

        // Event listeners for filters
        document.getElementById('category-filter').addEventListener('change', filterItems);
        document.getElementById('condition-filter').addEventListener('change', filterItems);
        document.getElementById('location-filter').addEventListener('change', filterItems);
        document.getElementById('sort-by').addEventListener('change', filterItems);

        // Theme switcher
        // document.querySelectorAll('.theme-item').forEach(item => {
        //     item.addEventListener('click', function (e) {
        //         e.preventDefault();
        //         const theme = this.getAttribute('data-theme');
        //         document.body.className = theme;
        //         localStorage.setItem('theme', theme);
        //     });
        // });

        // Check for saved theme
        // const savedTheme = localStorage.getItem('theme');
        // if (savedTheme) {
        //     document.body.className = savedTheme;
        // }

        // Initial render
        renderItems(items);
    
    