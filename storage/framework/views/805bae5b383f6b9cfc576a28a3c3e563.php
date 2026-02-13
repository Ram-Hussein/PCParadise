
<?php $__env->startSection('content'); ?>

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
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-search="<?php echo e($order->id); ?> <?php echo e($order->user->fname); ?> <?php echo e($order->user->lname); ?> <?php echo e($order->user->email); ?>" data-status="<?php echo e($order->status->status); ?>">
                        <td>#<?php echo e($order->id); ?></td>
                        <td><?php echo e($order->user->fname); ?> <?php echo e($order->user->lname); ?><br><small class="text-muted"><?php echo e($order->user->email); ?></small></td>
                        <td>$<?php echo e($order->Total); ?></td>
                        <td><span class="badge 
                            <?php switch($order->status->status):
                                             case ('Confirmed'): ?>
                                                 bg-primary
                                                 <?php break; ?>
                                             <?php case ('Pending'): ?>
                                                 bg-warning text-dark
                                             <?php break; ?>
                                             <?php case ('Delivered'): ?>
                                                 bg-success
                                             <?php break; ?>
                                             <?php case ('Cancelled'): ?>
                                                 bg-danger
                                             <?php break; ?>                                                 
                                         <?php endswitch; ?>
                            "><?php echo e($order->status->status); ?></span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary text-white" data-bs-toggle="collapse" data-bs-target="#details_<?php echo e($order->id); ?>">Details</button>
                            <?php if($order->status->status == 'Pending'): ?>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#confirmOrderModal<?php echo e($order->id); ?>">Confirm</button>
                                <!-- Confirm Order Modal -->
                                        <div class="modal fade" id="confirmOrderModal<?php echo e($order->id); ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title fw-bold">Confirm Order?</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="<?php echo e(route('Order.update', $order->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
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
                            <?php endif; ?>
                            <?php if($order->status->status == "Confirmed"): ?>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#completeOrderModal<?php echo e($order->id); ?>">Complete</button>
                                <!-- Complete Order Modal -->
                                        <div class="modal fade" id="completeOrderModal<?php echo e($order->id); ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title fw-bold">Complete Order?</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="<?php echo e(route('Order.update', $order->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
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
                            <?php endif; ?>
                            <?php if(($order->status->status != 'Cancelled') and ($order->status->status != 'Delivered')): ?>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#cancelOrderModal<?php echo e($order->id); ?>">Cancel</button>
                                <!-- Cancel Order Modal -->
                                        <div class="modal fade" id="cancelOrderModal<?php echo e($order->id); ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title fw-bold">Cancel Order?</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="<?php echo e(route('Order.destroy', $order->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
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
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="collapse" id="details_<?php echo e($order->id); ?>">
                        <td colspan="5">
                            <div class="order-details-box">
                                <h6>Status :</h6><p><?php echo e($order->status->description); ?></p>
                                <h6>Deliver to : </h6><p><?php echo e($order->address->StreetAddress); ?> , <?php echo e($order->address->City); ?> - <?php echo e($order->address->State); ?> | <?php echo e($order->address->PostalCode); ?></p>
                                <h6>Order Items:</h6>
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($item->product->name); ?> - $<?php echo e($item->product->price); ?> - x<?php echo e($item->quantity); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </main>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCParadise\resources\views/admin/orders.blade.php ENDPATH**/ ?>