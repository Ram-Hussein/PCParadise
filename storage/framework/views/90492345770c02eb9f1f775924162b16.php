
<?php $__env->startSection('content'); ?>


<div class="container my-4">
        <div class="banner-card">
            <h2 style="font-weight: 700;">Hardware That Elevates <span style="color: #23b5d3;">Your Work</span>.</h2>
            <p class="mb-0">Browse our extensive hardware collection and choose your next upgrade.</p>
        </div>

        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card filter-card sticky-filter p-3">
                    <h5 class="mb-3"><i class="bi bi-funnel-fill me-2"></i>Filters</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Search</label>
                        <input type="text" class="form-control" id="searchInput" placeholder="Product name...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <select class="form-select" id="categorySelect">
                            <option value="all">All Categories</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->name); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Brand</label>
                        <select class="form-select" id="brandSelect">
                            <option value="all">All Brands</option>
                            <option value="Nvidia">Nvidia</option>
                            <option value="AMD">AMD</option>
                            <option value="Intel">Intel</option>
                            <option value="Corsair">Corsair</option>
                            <option value="Logitech">Logitech</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Condition</label>
                        <select class="form-select" id="conditionSelect">
                            <option value="all">Any</option>
                            <option value="New">New</option>
                            <option value="Used">Used</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Availability</label>
                        <select class="form-select" id="stockSelect">
                            <option value="all">Any</option>
                            <option value="inStock">In Stock Only</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Price Range ($)</label>
                        <div class="d-flex gap-2">
                            <input type="number" class="form-control" id="minPrice" placeholder="Min" min="0">
                            <input type="number" class="form-control" id="maxPrice" placeholder="Max" min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Sort By</label>
                        <select class="form-select" id="sortSelect">
                            <option value="default">Featured</option>
                            <option value="priceLow">Price: Low to High</option>
                            <option value="priceHigh">Price: High to Low</option>
                            <option value="nameAZ">Name: A-Z</option>
                            <option value="nameZA">Name: Z-A</option>
                        </select>
                    </div>
                    
                    <button class="btn btn-custom-outline w-100 mt-2" id="resetFilters">Reset Filters</button>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row" id="productsContainer">
                    </div>
                <div id="noResults" class="text-center mt-5 d-none">
                    <i class="bi bi-search display-4 text-muted"></i>
                    <h3 class="mt-3 text-muted">No products found.</h3>
                    <p>Try adjusting your filters.</p>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
        // 1. Mock Data (Since we don't have a database)
        const products = [
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                id: <?php echo e($product->id); ?>,
                name: "<?php echo e($product->name); ?>",
                category: "<?php echo e($product->category->name); ?>",
                brand: "<?php echo e($product->Brand); ?>",
                price: <?php echo e($product->price); ?>,
                condition: "<?php echo e($product->condition); ?>",
                inStock: <?php echo e($product->in_stock); ?>,
                image: "https://placehold.co/400x300/23b5d3/ffffff?text=RTX+4090"
            },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            /* {
                id: 1,
                name: "GeForce RTX 4090",
                category: "Graphics Cards (GPUs)",
                brand: "Nvidia",
                price: 1599,
                condition: "New",
                inStock: true,
                image: "https://placehold.co/400x300/23b5d3/ffffff?text=RTX+4090"
            },
            {
                id: 2,
                name: "Radeon RX 7900 XTX",
                category: "Graphics Cards (GPUs)",
                brand: "AMD",
                price: 999,
                condition: "New",
                inStock: true,
                image: "https://placehold.co/400x300/6a5b6e/ffffff?text=RX+7900+XTX"
            },
            {
                id: 3,
                name: "Intel Core i9-13900K",
                category: "Processors (CPUs)",
                brand: "Intel",
                price: 580,
                condition: "Used",
                inStock: true,
                image: "https://placehold.co/400x300/navy/ffffff?text=i9+13900K"
            },
            {
                id: 4,
                name: "Ryzen 9 7950X",
                category: "Processors (CPUs)",
                brand: "AMD",
                price: 550,
                condition: "New",
                inStock: false,
                image: "https://placehold.co/400x300/orange/ffffff?text=Ryzen+9"
            },
            {
                id: 5,
                name: "Corsair Vengeance 32GB",
                category: "Memory (RAM)",
                brand: "Corsair",
                price: 120,
                condition: "New",
                inStock: true,
                image: "https://placehold.co/400x300/yellow/black?text=Corsair+RAM"
            },
            {
                id: 6,
                name: "Logitech G Pro X Superlight",
                category: "Peripherals",
                brand: "Logitech",
                price: 150,
                condition: "Used",
                inStock: true,
                image: "https://placehold.co/400x300/black/white?text=Logitech+Mouse"
            },
            {
                id: 7,
                name: "GeForce RTX 3060",
                category: "Graphics Cards (GPUs)",
                brand: "Nvidia",
                price: 320,
                condition: "Used",
                inStock: true,
                image: "https://placehold.co/400x300/23b5d3/ffffff?text=RTX+3060"
            },
            {
                id: 8,
                name: "ASUS ROG Maximus Motherboard",
                category: "Motherboards",
                brand: "Asus", // Note: I didn't add Asus to the filter dropdown for brevity, but the logic handles it
                price: 450,
                condition: "New",
                inStock: true,
                image: "https://placehold.co/400x300/red/white?text=ROG+Mobo"
            } */
        ];

        // 2. Select DOM Elements
        const container = document.getElementById('productsContainer');
        const noResults = document.getElementById('noResults');
        
        // Inputs
        const searchInput = document.getElementById('searchInput');
        const categorySelect = document.getElementById('categorySelect');
        const brandSelect = document.getElementById('brandSelect');
        const conditionSelect = document.getElementById('conditionSelect');
        const stockSelect = document.getElementById('stockSelect');
        const minPriceInput = document.getElementById('minPrice');
        const maxPriceInput = document.getElementById('maxPrice');
        const sortSelect = document.getElementById('sortSelect');
        const resetBtn = document.getElementById('resetFilters');

        // 3. Render Function
        function renderProducts(data) {
            container.innerHTML = ''; // Clear existing content

            if (data.length === 0) {
                noResults.classList.remove('d-none');
                return;
            } else {
                noResults.classList.add('d-none');
            }

            data.forEach(product => {
                const stockStatusHtml = product.inStock 
                    ? `<span class="text-in-stock"><i class="bi bi-check-circle-fill"></i> In Stock</span>`
                    : `<span class="text-out-stock"><i class="bi bi-x-circle-fill"></i> Out of Stock</span>`;

                const conditionBadge = product.condition === 'New'
                    ? `<span class="badge badge-new position-absolute top-0 start-0 m-2">New</span>`
                    : `<span class="badge badge-used position-absolute top-0 start-0 m-2">Used</span>`;

                const cardHtml = `
                    <div class="col-md-6 col-xl-4 mb-4">
                        <div class="card product-card h-100">
                            <div class="position-relative">
                                <a href="/Product/${product.id}">
                                    <img src="images/placeholder.png" class="card-img-top" alt="${product.name}"></a>
                                ${conditionBadge}
                            </div>
                            <div class="card-body d-flex flex-column">
                                <a href="/Product/${product.id}" class="text-decoration-none">
                                    <h5 class="card-title text-truncate" title="${product.name}">${product.name}</h5>
                                </a>
                                <p class="text-muted small mb-2">${product.brand} | ${product.category}</p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="price-tag">$${product.price.toFixed(2)}</span>
                                        ${stockStatusHtml}
                                    </div>
                                </div>
                            </div>
                            <form method="POST" hidden action="<?php echo e(route('CartItem.store')); ?>" id="add${product.id}">
                            <?php echo csrf_field(); ?>
                            <input type="number" name="product_id" value=${product.id}>
                            <input type="number" name="quantity" value=1>
                            </form>
                            <div class="card-footer bg-white border-top-0 d-flex gap-2 pb-3">
                                <button class="btn btn-sm btn-custom-outline flex-grow-1" onclick="window.location.href='/Product/${product.id}'">
                                    Details
                                </button>
                                <button class="btn btn-sm btn-custom-primary flex-grow-1" ${!product.inStock ? 'disabled' : ''} form="add${product.id}" onclick="submit">
                                    <i class="bi bi-cart-plus"></i> Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += cardHtml;
            });
        }

        // 4. Filter Logic
        function filterProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const category = categorySelect.value;
            const brand = brandSelect.value;
            const condition = conditionSelect.value;
            const stock = stockSelect.value;
            const minPrice = parseFloat(minPriceInput.value) || 0;
            const maxPrice = parseFloat(maxPriceInput.value) || Infinity;
            const sortType = sortSelect.value;

            let filtered = products.filter(product => {
                // Text Search
                const matchesSearch = product.name.toLowerCase().includes(searchTerm);
                // Category
                const matchesCategory = category === 'all' || product.category === category;
                // Brand
                const matchesBrand = brand === 'all' || product.brand === brand;
                // Condition
                const matchesCondition = condition === 'all' || product.condition === condition;
                // Stock
                const matchesStock = stock === 'all' || (stock === 'inStock' && product.inStock);
                // Price
                const matchesPrice = product.price >= minPrice && product.price <= maxPrice;

                return matchesSearch && matchesCategory && matchesBrand && matchesCondition && matchesStock && matchesPrice;
            });

            // Sorting Logic
            if (sortType === 'priceLow') {
                filtered.sort((a, b) => a.price - b.price);
            } else if (sortType === 'priceHigh') {
                filtered.sort((a, b) => b.price - a.price);
            } else if (sortType === 'nameAZ') {
                filtered.sort((a, b) => a.name.localeCompare(b.name));
            } else if (sortType === 'nameZA') {
                filtered.sort((a, b) => b.name.localeCompare(a.name));
            }

            renderProducts(filtered);
        }

        // 5. Event Listeners
        searchInput.addEventListener('input', filterProducts);
        categorySelect.addEventListener('change', filterProducts);
        brandSelect.addEventListener('change', filterProducts);
        conditionSelect.addEventListener('change', filterProducts);
        stockSelect.addEventListener('change', filterProducts);
        minPriceInput.addEventListener('input', filterProducts);
        maxPriceInput.addEventListener('input', filterProducts);
        sortSelect.addEventListener('change', filterProducts);

        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            categorySelect.value = 'all';
            brandSelect.value = 'all';
            conditionSelect.value = 'all';
            stockSelect.value = 'all';
            minPriceInput.value = '';
            maxPriceInput.value = '';
            sortSelect.value = 'default';
            filterProducts(); // Re-render all
        });

        // 6. Handle URL Parameters (Category Links from Navbar)
        const urlParams = new URLSearchParams(window.location.search);
        const categoryParam = urlParams.get('category');

        if (categoryParam) {
            // Check if the parameter exists in our dropdown options to avoid errors
            const optionExists = Array.from(categorySelect.options).some(opt => opt.value === categoryParam);
            if (optionExists) {
                categorySelect.value = categoryParam;
            }
        }

        // Initial Render - Use filterProducts() instead of renderProducts() 
        // to ensure the category selection above is applied immediately.
        filterProducts();

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Components.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCParadise\resources\views/products.blade.php ENDPATH**/ ?>