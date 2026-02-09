@extends('Components.layout')
@section('content')

    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/Products">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page" id="breadcrumbName">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-lg-7 mb-4">
                <div class="product-gallery">
                    <div class="thumbnail-container" id="thumbnailContainer">
                        </div>
                    <div class="main-image-container">
                        <img src="" id="mainImage" class="main-image" alt="Product Image">
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <h2 id="productName" class="product-title">{{$product->name}}</h2>
                <p class="text-muted" id="productBrandCategory">{{ $product->Brand }} | {{ $product->category->name }}</p>

                <hr>

                <div class="mb-3">
                    <span class="product-price" id="productPrice">${{ $product->price }}</span>
                    <div class="mt-1" id="stockStatus">
                        </div>
                </div>

                <p class="mb-4" id="productDesc">
                    {{ $product->description }}
                </p>

                <h5 class="mb-3" style="color: navy;">Technical Specifications</h5>
                <table class="table table-sm table-striped mb-4 border">
                    <tbody id="specsTable">
                        @foreach ($specs as $spec)
                            <tr>
                                <td class="fw-bold">{{ $spec->spec->name }}</td>
                                <td>{{ $spec->value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>

                @auth
                    <form action="{{ route('CartItem.store') }}" method="POST">
                        @csrf
                        <div class="d-flex gap-3 align-items-center">
                    <div class="input-group" style="width: 10vw; height: 5vh">
                        <button class="btn btn-outline-secondary" type="button" onclick="decrementQty()">-</button>
                        <input type="text" class="form-control text-center" value="1" name="quantity" id="qtyInput" required>
                        <button class="btn btn-outline-secondary" type="button" onclick="incrementQty()">+</button>
                    </div>
                    <input type="number" class="form-control" value="{{ $product->id }}" name="product_id" hidden>
                    <button style="width: 30vw;height: 5vh" class="btn btn-buy flex-grow-1" type="submit" id="addToCartBtn">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                    </div>
                    @error('quantity')
                        <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                    @enderror
                    </form>
                @endauth
                @guest
                    <div class="d-flex gap-3 align-items-center">
                        <p><a href="{{ route('signin') }}">Log in</a>
                             or 
                             <a href="{{ route('signup') }}">Sign up</a>
                              to start shopping</p>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <h3 class="mb-4" style="color: navy; border-left: 5px solid #23b5d3; padding-left: 15px;">Similar Products</h3>
        <div class="row" id="similarProductsContainer">
            @if ($similarProducts->isEmpty())
                <p class="text-muted">No similar products found.</p>
            @else
                @foreach ($similarProducts as $p)
                <div class="col-6 col-md-3 mb-3">
                            <div class="card suggestion-card h-100">
                                <a href="/Product/{{ $p->id }}"><img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="{{ $p->name }}"></a>
                                <div class="card-body p-2 text-center">
                                    <a class="text-decoration-none" href="/Product/{{ $p->id }}"><h6 class="card-title text-truncate" style="font-size: 1.2rem;">{{$p->name}}</h6></a>
                                    <p class="card-text fw-bold" style="color: #23b5d3;">${{$p->price}}</p>
                                    <a href="{{ route('product details', ['id' => $p->id]) }}" class="btn btn-sm btn-outline-dark w-100" style="font-size: 0.8rem;">View</a>
                                </div>
                            </div>
                        </div>
            @endforeach
            @endif
            </div>
    </div>

@endsection
@section('script')

<script>
        // 1. SHARED DATA (Ideally this would be in a separate .js file shared by both pages)
        // I've expanded the data slightly to include descriptions and specs
        /* const productsDatabase = [
            {
                id: 1,
                name: "GeForce RTX 4090",
                category: "GPU",
                brand: "Nvidia",
                price: 1599,
                inStock: true,
                description: "The ultimate GeForce GPU. It brings an enormous leap in performance, efficiency, and AI-powered graphics.",
                specs: { "VRAM": "24GB GDDR6X", "Cores": "16384 CUDA", "Boost Clock": "2.52 GHz", "Power": "450W" },
                images: [
                    "https://placehold.co/500x500/23b5d3/ffffff?text=RTX+4090+Front",
                    "https://placehold.co/500x500/23b5d3/ffffff?text=RTX+4090+Back",
                    "https://placehold.co/500x500/23b5d3/ffffff?text=RTX+4090+Ports"
                ]
            },
            {
                id: 2,
                name: "Radeon RX 7900 XTX",
                category: "GPU",
                brand: "AMD",
                price: 999,
                inStock: true,
                description: "Experience the world's most advanced graphics for gamers and creators. Built on the groundbreaking AMD RDNA 3 architecture.",
                specs: { "VRAM": "24GB GDDR6", "Units": "96 CU", "Boost Clock": "2.5 GHz", "Power": "355W" },
                images: [
                    "https://placehold.co/500x500/6a5b6e/ffffff?text=RX+7900+Front",
                    "https://placehold.co/500x500/6a5b6e/ffffff?text=RX+7900+Back"
                ]
            },
            {
                id: 3,
                name: "Intel Core i9-13900K",
                category: "CPU",
                brand: "Intel",
                price: 580,
                inStock: true,
                description: "13th Gen Intel Core desktop processors deliver the world's best gaming experience and unmatched overclocking capabilities.",
                specs: { "Cores": "24 (8P + 16E)", "Threads": "32", "Max Turbo": "5.8 GHz", "Socket": "LGA 1700" },
                images: ["https://placehold.co/500x500/navy/ffffff?text=i9+13900K"]
            },
            {
                id: 4,
                name: "Ryzen 9 7950X",
                category: "CPU",
                brand: "AMD",
                price: 550,
                inStock: false,
                description: "The dominant gaming processor, with AMD 3D V-Cache technology for even more game performance.",
                specs: { "Cores": "16", "Threads": "32", "Max Boost": "5.7 GHz", "Socket": "AM5" },
                images: ["https://placehold.co/500x500/orange/ffffff?text=Ryzen+9"]
            },
            {
                id: 5,
                name: "Corsair Vengeance 32GB",
                category: "RAM",
                brand: "Corsair",
                price: 120,
                inStock: true,
                description: "Push the limits of your system with DDR5 memory that unlocks even faster frequencies.",
                specs: { "Type": "DDR5", "Speed": "5600MHz", "Capacity": "32GB (2x16)", "Latency": "CL36" },
                images: ["https://placehold.co/500x500/yellow/black?text=Corsair+RAM"]
            },
            {
                id: 6,
                name: "Logitech G Pro X Superlight",
                category: "Peripherals",
                brand: "Logitech",
                price: 150,
                inStock: true,
                description: "Meticulously designed in collaboration with many of the world’s leading esports pros.",
                specs: { "Weight": "63g", "Sensor": "HERO 25K", "Wireless": "LIGHTSPEED", "DPI": "25,600" },
                images: ["https://placehold.co/500x500/black/white?text=Logitech+Mouse"]
            },
            {
                id: 7,
                name: "GeForce RTX 3060",
                category: "GPU",
                brand: "Nvidia",
                price: 320,
                inStock: true,
                description: "The GeForce RTX™ 3060 lets you take on the latest games using the power of Ampere.",
                specs: { "VRAM": "12GB GDDR6", "Cores": "3584 CUDA", "Boost Clock": "1.78 GHz", "Power": "170W" },
                images: ["https://placehold.co/500x500/23b5d3/ffffff?text=RTX+3060"]
            },
             {
                id: 8,
                name: "ASUS ROG Maximus Motherboard",
                category: "Motherboard",
                brand: "Asus",
                price: 450,
                inStock: true,
                description: "Intel Z790 LGA 1700 ATX motherboard with 24+1 power stages, DDR5, 5x M.2 slots.",
                specs: { "Socket": "LGA 1700", "Chipset": "Z790", "Memory": "DDR5", "Form Factor": "ATX" },
                images: ["https://placehold.co/500x500/red/white?text=ROG+Mobo"]
            }
        ]; */

        // 2. Initialization
        /* const urlParams = new URLSearchParams(window.location.search);
        const productId = parseInt(urlParams.get('id')) || 1; // Default to ID 1 if not found
        

        const currentProduct = productsDatabase.find(p => p.id === productId); */

        const currentProduct = {
                id: {{ $product->id }},
                name: "{{ $product->name }}",
                category: "{{ $product->category->name }}",
                brand: "{{ $product->Brand }}",
                price: {{ $product->price }},
                inStock: {{ $product->in_stock }},
                description: "{{ $product->description }}",
                specs: { "Socket": "LGA 1700", "Chipset": "Z790", "Memory": "DDR5", "Form Factor": "ATX" },
                images: ["{{ asset('images/placeholder.png') }}",
                    "{{ asset('images/placeholder2.png') }}",
                ]
            };

        // 3. Render Product Details
        if (currentProduct) {
            // Text Info
            /* document.title = `${currentProduct.name} - PC Paradise`;
            document.getElementById('breadcrumbName').textContent = currentProduct.name;
            document.getElementById('productName').textContent = currentProduct.name;
            document.getElementById('productBrandCategory').textContent = `${currentProduct.brand} | ${currentProduct.category}`;
            document.getElementById('productPrice').textContent = `$${currentProduct.price.toFixed(2)}`;
            document.getElementById('productDesc').textContent = currentProduct.description; */

            @auth
                // Stock Status
            const stockEl = document.getElementById('stockStatus');
            const btnEl = document.getElementById('addToCartBtn');
            if(currentProduct.inStock) {
                stockEl.innerHTML = '<span class="in-stock"><i class="fas fa-check-circle"></i> In Stock</span>';
                btnEl.disabled = false;
            } else {
                stockEl.innerHTML = '<span class="out-stock"><i class="fas fa-times-circle"></i> Out of Stock</span>';
                btnEl.disabled = true;
                btnEl.textContent = "Out of Stock";
            }
            @endauth

            // Specs Table
            /* const specsTable = document.getElementById('specsTable');
            for (const [key, value] of Object.entries(currentProduct.specs)) {
                specsTable.innerHTML += `<tr><th>${key}</th><td>${value}</td></tr>`;
            } */

            // Images Logic
            const mainImg = document.getElementById('mainImage');
            const thumbContainer = document.getElementById('thumbnailContainer');
            
            // Set Initial Main Image
            mainImg.src = currentProduct.images[0];

            // Generate Thumbnails
            currentProduct.images.forEach((imgSrc, index) => {
                const thumb = document.createElement('img');
                thumb.src = imgSrc;
                thumb.classList.add('thumbnail');
                if(index === 0) thumb.classList.add('active');
                
                thumb.addEventListener('click', () => {
                    // Change main image
                    mainImg.src = imgSrc;
                    // Update active class
                    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                    thumb.classList.add('active');
                });
                
                thumbContainer.appendChild(thumb);
            });

            // 4. Render Suggestions (Same Category)
            /* const similarContainer = document.getElementById('similarProductsContainer');
            const similarProducts = productsDatabase
                .filter(p => p.category === currentProduct.category && p.id !== currentProduct.id)
                .slice(0, 4); // Show max 4

            if(similarProducts.length === 0) {
                similarContainer.innerHTML = '<p class="text-muted">No similar products found.</p>';
            } else {
                similarProducts.forEach(p => {
                    similarContainer.innerHTML += `
                        <div class="col-6 col-md-3 mb-3">
                            <div class="card suggestion-card h-100">
                                <img src="${p.images[0]}" class="card-img-top" alt="${p.name}">
                                <div class="card-body p-2 text-center">
                                    <h6 class="card-title text-truncate" style="font-size: 0.9rem;">${p.name}</h6>
                                    <p class="card-text fw-bold" style="color: #23b5d3;">$${p.price}</p>
                                    <a href="product-details.html?id=${p.id}" class="btn btn-sm btn-outline-dark w-100" style="font-size: 0.8rem;">View</a>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } */
        } else {
            document.querySelector('.container.mt-3').innerHTML = '<h3>Product not found.</h3><a href="products.html">Go back</a>';
        }

        // 5. Quantity Logic
        const qtyInput = document.getElementById('qtyInput');
        function incrementQty() {
            qtyInput.value = parseInt(qtyInput.value) + 1;
        }
        function decrementQty() {
            if(parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        }
    </script>
@endsection