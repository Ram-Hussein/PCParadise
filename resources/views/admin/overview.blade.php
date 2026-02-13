@extends('admin.sidebar')
@section('content')

    <!-- Main Content -->
    <main class="admin-main">
        <h3 class="section-title">Dashboard Overview</h3>

        <!-- Stats Row -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="stat-card">
                    <p class="text-muted mb-1">Total Revenue</p>
                    <h2 class="fw-bold" style="color: navy;">${{$revenue}}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <p class="text-muted mb-1">Active Listings</p>
                    <h2 class="fw-bold" style="color: navy;">{{ count($products) }}</h2>
                    <span class="badge badge-new">142 Approved</span>
                    <span class="badge badge-used">{{ count($pending) }} Pending</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <p class="text-muted mb-1">Registered Users</p>
                    <h2 class="fw-bold" style="color: navy;">{{$users}}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <p class="text-muted mb-1">Shipped Orders</p>
                    <h2 class="fw-bold" style="color: navy;">{{$shipped}}</h2>
                    <span class="badge badge-new">{{ $shipping }} Pending</span>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Orders -->
            <div class="col-lg-7">
                <div class="table-card">
                    <div class="table-header d-flex justify-content-around">
                        <h5 class="m-0 me-5">Recent Orders</h5>
                        <a href="/dashboard/orders" style="color: beige"><h5 class="m-0 ms-5">View all orders</h5></a>
                    </div>
                    <div class="p-3">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->fname }} {{ $order->user->lname }}</td>
                                    <td>{{ count($order->items) }}</td>
                                    <td class="fw-bold">${{ $order->Total }}</td>
                                    <td><span class="badge 
                                        @switch($order->status->status)
                                             @case('Confirmed')
                                                 bg-primary
                                                 @break
                                             @case('Pending')
                                                 bg-warning text-dark
                                             @break
                                             @case('Delivered')
                                                 bg-success
                                             @break
                                             @case('Cancelled')
                                                 bg-danger
                                             @break                                                 
                                         @endswitch
                                        ">{{ $order->status->status }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pending User Products -->
            <div class="col-lg-5">
                <div class="table-card">
                    <div class="table-header bg-danger bg-gradient">
                        <h5 class="m-0">Pending User Submissions</h5>
                    </div>
                    <div class="p-3">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GTX 1660 Ti</td>
                                    <td>Alex88</td>
                                    <td><a href="admin_products.html" class="btn btn-sm btn-custom-primary">View</a></td>
                                </tr>
                                <tr>
                                    <td>DDR4 16GB RAM</td>
                                    <td>Techie_2</td>
                                    <td><a href="admin_products.html" class="btn btn-sm btn-custom-primary">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Homepage Featured Selector (Updated version from admin.html) -->
        <div class="table-card mt-4">
            <div class="table-header" style="background-color: navy;">
                <h5 class="m-0"><i class="fas fa-home me-2"></i>Homepage Featured Products</h5>
            </div>
            <form action="">
                <div class="p-4">
                <p class="text-muted small mb-4">Click on a slot to select a product to display on the homepage main grid.</p>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="featured-slot" id="slot-1" onclick="openProductSelector(1)">
                            <i class="fas fa-plus slot-icon"></i>
                            <span class="small text-muted fw-bold">Select Product 1</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="featured-slot" id="slot-2" onclick="openProductSelector(2)">
                            <i class="fas fa-plus slot-icon"></i>
                            <span class="small text-muted fw-bold">Select Product 2</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="featured-slot" id="slot-3" onclick="openProductSelector(3)">
                            <i class="fas fa-plus slot-icon"></i>
                            <span class="small text-muted fw-bold">Select Product 3</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="featured-slot" id="slot-4" onclick="openProductSelector(4)">
                            <i class="fas fa-plus slot-icon"></i>
                            <span class="small text-muted fw-bold">Select Product 4</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 border-top pt-3 text-end">
                    <button class="btn btn-custom-primary px-4" onclick="saveFeaturedConfig()">Save Configuration</button>
                </div>
            </div>
            </form>
        </div>
    </main>

    <!-- Product Selector Modal -->
    <div class="modal fade" id="productSelectorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Featured Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="p-3 border-bottom">
                        <input type="text" id="productSearchInput" class="form-control" placeholder="Search products..." oninput="filterProducts()">
                    </div>
                    <div class="list-group list-group-flush" id="productList">
                        @foreach ($products as $product)
                            <div class="list-group-item product-option d-flex align-items-center" onclick="selectProductForSlot('{{ $product->name }}', '{{ $product->category->name }}', '${{ $product->price }}', {{ $product->id }})">
                            <div class="bg-light p-2 rounded me-3"><i class="fas fa-microchip text-primary"></i></div>
                            <div>
                                <div class="fw-bold product-name">{{ $product->name }}</div>
                                <div class="small text-muted">{{ $product->category->name }} • ${{ $product->price }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="adminConfirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0"><h5 class="modal-title" id="adminModalTitle">Confirm Action</h5></div>
                <div class="modal-body text-center p-4">
                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                    <p id="adminModalMessage">Are you sure?</p>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-custom-primary" id="adminConfirmBtn" data-bs-dismiss="modal">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script
      src="{{ asset('Bootstrap/js/bootstrap.bundle.min.js') }}"
    ></script>
    @section('script')
    <script>
        let activeSlot = null;
        const selectorModal = new bootstrap.Modal(document.getElementById('productSelectorModal'));
        const adminModal = new bootstrap.Modal(document.getElementById('adminConfirmModal'));

        function openProductSelector(slotId) {
            activeSlot = slotId;
            // Reset input and view
            const searchInput = document.getElementById('productSearchInput');
            searchInput.value = '';
            
            // Show all items initially
            const items = document.querySelectorAll('#productList .product-option');
            items.forEach(item => item.style.display = 'flex');
            
            selectorModal.show();
        }

        function filterProducts() {
            const input = document.getElementById('productSearchInput');
            const filter = input.value.toLowerCase().trim();
            const items = document.querySelectorAll('#productList .product-option');

            items.forEach(item => {
                // Get the text from the product-name class
                const nameText = item.querySelector('.product-name').textContent.toLowerCase();
                // Get the text from the category/price section for better search
                const metaText = item.querySelector('.text-muted').textContent.toLowerCase();
                
                if (nameText.includes(filter) || metaText.includes(filter)) {
                    item.style.setProperty('display', 'flex', 'important');
                } else {
                    item.style.setProperty('display', 'none', 'important');
                }
            });
        }

        function selectProductForSlot(name, cat, price, id) {
            const slot = document.getElementById(`slot-${activeSlot}`);
            slot.classList.add('occupied');
            slot.innerHTML = `
                <div class="text-start w-100">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-light text-dark border">Slot ${activeSlot}</span>
                    </div>
                    <div class="fw-bold text-truncate">${name}</div>
                    <input type="number" name="product-${activeSlot}" id="product-${activeSlot}" hidden value=${id}>
                    <div class="small text-muted">${cat} • ${price}</div>
                    <button class="btn btn-link btn-sm text-info p-0 mt-2" onclick="event.stopPropagation(); openProductSelector(${activeSlot})">Change</button>
                </div>
            `;
            selectorModal.hide();
        }

        function saveFeaturedConfig() {
            document.getElementById('adminModalTitle').innerText = 'Update Featured Products';
            document.getElementById('adminModalMessage').innerText = 'The selected products will now appear on the public storefront homepage. Proceed?';
            adminModal.show();
        }
    </script>
    @endsection
{{-- </body>
</html> --}}