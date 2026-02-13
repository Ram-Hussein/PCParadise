@extends('admin.sidebar')
@section('content')

<main class="admin-main">
        <h3 class="section-title">Order Management</h3>

        <div class="bg-white p-3 rounded shadow-sm mb-4 d-flex gap-3">
            <input type="text" id="orderSearch" class="form-control" placeholder="Search by Order #, Name or Email..." onkeyup="filterOrders()">
            <select class="form-select w-25" id="orderStatusFilter" onchange="filterOrders()">
                <option value="all">All Orders</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="bg-white rounded shadow-sm">
            <table class="table align-middle" id="ordersTable">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr data-search="{{ $order->id }} {{ $order->user->fname }} {{ $order->user->lname }} {{ $order->user->email }}" data-status="{{ $order->status->status }}">
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->fname }} {{ $order->user->lname }}<br><small class="text-muted">{{ $order->user->email }}</small></td>
                        <td>${{ $order->Total }}</td>
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
                        <td>
                            <button class="btn btn-sm btn-secondary text-white" data-bs-toggle="collapse" data-bs-target="#details_{{ $order->id }}">Details</button>
                            @if ($order->status->status == 'Pending')
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#confirmOrderModal{{ $order->id }}">Confirm</button>
                                <!-- Confirm Order Modal -->
                                        <div class="modal fade" id="confirmOrderModal{{ $order->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title fw-bold">Confirm Order?</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('Order.update', $order->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body p-4">
                                                        <p>Are you sure you want to confirm this order? This action cannot be undone.</p>
                                                        <input type="text" value="Confirm" name="status" hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Confirm Order</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                            @endif
                            @if ($order->status->status == "Confirmed")
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#completeOrderModal{{ $order->id }}">Complete</button>
                                <!-- Complete Order Modal -->
                                        <div class="modal fade" id="completeOrderModal{{ $order->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title fw-bold">Complete Order?</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('Order.update', $order->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body p-4">
                                                        <p>Are you sure you want to complete this order? This action cannot be undone.</p>
                                                        <input type="text" value="Complete" name="status" hidden>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Confirm completeion</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                            @endif
                            @if (($order->status->status != 'Cancelled') and ($order->status->status != 'Delivered'))
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#cancelOrderModal{{ $order->id }}">Cancel</button>
                                <!-- Cancel Order Modal -->
                                        <div class="modal fade" id="cancelOrderModal{{ $order->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title fw-bold">Cancel Order?</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('Order.destroy', $order->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body p-4">
                                                        <p>Are you sure you want to cancel this order? This action cannot be undone.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Confirm Cancelation</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                            @endif
                        </td>
                    </tr>
                    <tr class="collapse" id="details_{{ $order->id }}">
                        <td colspan="5">
                            <div class="order-details-box">
                                <h6>Status :</h6><p>{{$order->status->description}}</p>
                                <h6>Deliver to : </h6><p>{{ $order->address->StreetAddress }} , {{$order->address->City}} - {{$order->address->State}} | {{$order->address->PostalCode}}</p>
                                <h6>Order Items:</h6>
                                <ul class="mb-0">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->product->name }} - ${{ $item->product->price }} - x{{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>


@endsection
@section('script')

<script>
        function filterOrders() {
            let search = document.getElementById('orderSearch').value.toLowerCase();
            let status = document.getElementById('orderStatusFilter').value;
            let rows = document.querySelectorAll('#ordersTable tbody tr:not(.collapse)');
            
            rows.forEach(row => {
                let text = row.getAttribute('data-search').toLowerCase();
                let rowStatus = row.getAttribute('data-status').toLowerCase();
                row.style.display = (text.includes(search) && (status === 'all' || rowStatus === status)) ? '' : 'none';
            });
        }
    </script>

@endsection