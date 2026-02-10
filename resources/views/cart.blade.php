@extends('components.layout')
@section('content')
<div class="container py-5">
        <h2 class="section-title">Your Shopping Cart</h2>
        
        <div class="row g-4">
            <!-- Left Side: Cart Items -->
            <div class="col-lg-8">
                <div id="cart-container">
                    <!-- Item 1 -->
                    @foreach ($cartItems as $item)
                        <div class="cart-card d-flex align-items-center justify-content-between" data-price="{{ $item->product->price }}">
                        <div class="d-flex align-items-center">
                            <div class="item-img me-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-microchip fa-2x text-muted"></i>
                            </div>
                            <div>
                                <a class="text-decoration-none" href="/Product/{{ $item->product_id }}"><h6 class="fw-bold mb-0">{{ $item->product->name }}</h6></a>
                                <small class="text-muted">Unit Price: ${{ $item->product->price }}</small>
                                <input type="number" name="product[{{ $item->id }}][id]" hidden value="{{ $item->product_id }}" form="orderForm">
                                <input type="number" name="items[{{ $item->id }}]" hidden value="{{ $item->id }}" form="orderForm">
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="input-group qty-group me-3">
                                <button class="btn qty-btn" type="button" onclick="changeQty(this, -1)">-</button>
                                <input type="number" class="form-control qty-input" form="orderForm" name="product[{{ $item->id }}][qty]" value="{{ $item->quantity }}" min="1" onchange="updateCart()">
                                <button class="btn qty-btn" type="button" onclick="changeQty(this, 1)">+</button>
                            </div>
                            {{-- <input type="number" class="form-control qty-input me-3" value="{{ $item->quantity }}" min="1" onchange="updateCart()"> --}}
                            <div class="text-end" style="min-width: 100px;">
                                <span class="fw-bold item-total">$899.99</span>
                                <br>
                                <form action="{{ route('CartItem.destroy', $item->id) }}" method="post">
                                    @csrf
                                @method('DELETE')
                                <small class="text-danger pointer" onclick="event.preventDefault(); this.closest('form').submit();" style="cursor:pointer">Remove</small>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <a href="/Products" class="text-decoration-none" style="color: var(--accent-cyan);">
                    <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                </a>
                <form action="{{ route('Order.store') }}" method="post" id="orderForm">
                    @csrf
                    <input type="text" name="total" value="" id="total" hidden>
                    <input type="number" name="address" value="" id="address" hidden>
                </form>
            </div>

            <!-- Right Side: Checkout Info -->
            <div class="col-lg-4">
                <div class="summary-card">
                    @if (count($addresses) > 0)
                        <h5 class="fw-bold mb-4" style="color: var(--navy-text);">Order Summary</h5>
                    
                    <!-- User Info Section -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Contact Details</label>
                        <p class="mb-1 small">{{auth()->user()->fname}} {{auth()->user()->lname}}</p>
                        <p class="mb-0 small">{{auth()->user()->email}}</p>
                        <p class="mb-0 small">0{{auth()->user()->PhoneNumber}}</p>
                    </div>

                    <!-- Address Selection -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Shipping Address</label>
                        @error('address')
                            <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                        @enderror
                        @foreach ($addresses as $address)
                            <div class="address-selector" onclick="selectAddress(this)" address_id="{{ $address->id }}">
                                {{-- <input type="number" hidden form="orderForm" value="{{ $address->id }}" name="address"> --}}
                                <p class="mb-0 fw-bold">{{$address->Name }}</p>
                                 <p class="mb-0 x-small text-muted" style="font-size: 0.85rem;">{{$address->StreetAddress }}</p>
                                <p class="mb-0 x-small text-muted" style="font-size: 0.75rem;">{{$address->City}}, {{$address->State}} | {{$address->PostalCode}}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Payment Summary -->
                    <div class="price-breakdown">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span id="shipping">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 total-row">
                            <span>Order Total</span>
                            <span id="grand-total">$0.00</span>
                        </div>
                    </div>

                    <button type="button" class="btn-order shadow" onclick="placeOrder()">Place Order</button>
                    @else
                        <h4><a class="text-decoration-none" href="/user?section=addresses">Add an address</a> to place your order.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
        function changeQty(btn, delta) {
            const input = btn.parentElement.querySelector('.qty-input');
            let currentValue = parseInt(input.value);
            let newValue = currentValue + delta;
            
            if (newValue >= 1) {
                input.value = newValue;
                updateCart();
            }
        }

        function updateCart() {
            let subtotal = 0;
            const items = document.querySelectorAll('.cart-card');
            
            items.forEach(item => {
                const price = parseFloat(item.getAttribute('data-price'));
                const qty = parseInt(item.querySelector('.qty-input').value);
                const itemTotal = price * qty;
                
                // Update item total display
                item.querySelector('.item-total').innerText = '$' + itemTotal.toFixed(2);
                
                subtotal += itemTotal;
            });

            // Calculate Shipping
            // 10% if subtotal < 100, else fixed 9.99
            let shipping = 0;
            if (subtotal > 0) {
                if (subtotal < 100) {
                    shipping = subtotal * 0.10;
                } else {
                    shipping = 9.99;
                }
            }

            const grandTotal = subtotal + shipping;

            // Update UI
            document.getElementById('subtotal').innerText = '$' + subtotal.toFixed(2);
            document.getElementById('shipping').innerText = '$' + shipping.toFixed(2);
            document.getElementById('grand-total').innerText = '$' + grandTotal.toFixed(2);
            document.getElementById('total').value = grandTotal;
        }

        function removeItem(element) {
            element.closest('.cart-card').remove();
            updateCart();
        }

        function selectAddress(element) {
            document.querySelectorAll('.address-selector').forEach(el => el.classList.remove('selected'));
            element.classList.add('selected');
            document.getElementById('address').value = element.getAttribute('address_id');
        }

        function placeOrder() {
            const total = document.getElementById('grand-total').innerText;
            if(parseFloat(total.replace('$', '')) <= 0) {
                alert('Your cart is empty!');
                return;
            }
            document.getElementById('orderForm').submit();
        }

        // Initial Calculation
        window.onload = updateCart;
    </script>
@endsection