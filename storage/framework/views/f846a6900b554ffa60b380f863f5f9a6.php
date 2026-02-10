<?php $__env->startSection('content'); ?>

<div class="container py-5">
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="settings-nav-card sticky-top" style="top: 100px; z-index: 10;">
                    <div class="p-4 border-bottom bg-light">
                        <h5 class="mb-0 fw-bold" style="color: var(--primary-purple);">Dashboard</h5>
                    </div>
                    <div class="list-group list-group-flush" id="settings-tabs">
                        <a onclick="navigateToSection('personal-info')" class="list-group-item list-group-item-action active" id="tab-personal-info">
                            <i class="fas fa-user me-2"></i> Personal Details
                        </a>
                        <a onclick="navigateToSection('my-orders')" class="list-group-item list-group-item-action" id="tab-my-orders">
                            <i class="fas fa-shopping-bag me-2"></i> My Orders
                        </a>
                        <a onclick="navigateToSection('security')" class="list-group-item list-group-item-action" id="tab-security">
                            <i class="fas fa-lock me-2"></i> Security
                        </a>
                        <a onclick="navigateToSection('addresses')" class="list-group-item list-group-item-action" id="tab-addresses">
                            <i class="fas fa-map-marker-alt me-2"></i> Addresses
                        </a>
                        <a onclick="navigateToSection('danger-zone')" class="list-group-item list-group-item-action text-danger" id="tab-danger-zone">
                            <i class="fas fa-exclamation-triangle me-2"></i> Delete Account
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9">
                
                <!-- Personal Info Section -->
                <div id="personal-info" class="settings-card active-section">
                    <h2 class="section-title">Edit Personal Information</h2>
                    <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo e(Auth::user()->fname); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo e(Auth::user()->lname); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="0<?php echo e(Auth::user()->PhoneNumber); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country</label>
                                <select id="country" name="country" class="form-select">
                                    <option value="<?php echo e(Auth::user()->country_id); ?>" selected><?php echo e(Auth::user()->country->name); ?></option>
                                    <?php $__currentLoopData = DB::table('countries')->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo e(Auth::user()->date_of_birth); ?>">
                            </div>
                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-custom-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
                </div>


                <!-- My Orders Section -->
                <div id="my-orders" class="settings-card">
                    <h2 class="section-title">Order History</h2>
                    <div class="accordion" id="ordersAccordion">
                        <?php $__currentLoopData = Auth::user()->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- Order 1 (Delivered) -->
                        <div class="card mb-3 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center entry-card-header" 
                                 data-bs-toggle="collapse" data-bs-target="#collapseOrder<?php echo e($order->id); ?>">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chevron-down me-3 text-muted small"></i>
                                    <div>
                                        <span class="text-muted small d-block">Order Number</span>
                                        <span class="fw-bold">ORD-<?php echo e($order->id); ?></span>
                                    </div>
                                    <div class="ms-4 d-none d-md-block">
                                        <span class="text-muted small d-block">Status</span>
                                        <span class="badge
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
                                             <?php default: ?>
                                                 
                                         <?php endswitch; ?>
                                         status-badge"><?php echo e($order->status->status); ?></span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="text-muted small d-block">Order Total</span>
                                    <span class="fw-bold" style="color: var(--navy-text);">$<?php echo e($order->Total); ?></span>
                                </div>
                            </div>
                            
                            <div id="collapseOrder<?php echo e($order->id); ?>" class="collapse" data-bs-parent="#ordersAccordion">
                                <div class="card-body pt-0 border-top">
                                    <div class="mt-3">
                                        <p class="mb-2 small"><strong style="color: var(--primary-purple);">Description:</strong> <?php echo e($order->description); ?></p>
                                        <div class="entry-details-area">
                                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="d-flex justify-content-between small">
                                                <a href="/Product/<?php echo e($item->product_id); ?>" class="text-decoration-none fw-bold"><span><?php echo e($item->product->name); ?></span></a>
                                                <span class="fw-bold">Qty: <?php echo e($item->quantity); ?></span>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php if(($order->status->status != 'Cancelled') and ($order->status->status != 'Delivered')): ?>
                                            <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelOrderModal<?php echo e($order->id); ?>">Cancel Order</button>
                                        </div>
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
                                                        <p>Are you sure you want to cancel this order? Please type your password to confirm your action.</p>
                                                        <input id="password" type="password" class="form-control" placeholder="*********" name="password" required>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>


                <!-- Password Section -->
                <div id="security" class="settings-card">
                    <h2 class="section-title">Security & Password</h2>
                    <form method="post" action="<?php echo e(route('password.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label">Current Password</label>
                                <input required type="password" class="form-control" id="update_password_current_password" name="current_password">
                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">New Password</label>
                                <input required type="password" class="form-control" id="update_password_password" name="password">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirm New Password</label>
                                <input required type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation">
                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-custom-primary">Update Password</button>
                        </div>
                    </form>
                </div>

                <!-- Address Section -->
                <div id="addresses" class="settings-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="section-title mb-0">Address Book</h2>
                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="collapse" data-bs-target="#newAddressForm">
                            <i class="fas fa-plus"></i> Add New
                        </button>
                    </div>

                    <!-- Collapsible New Address Form -->
                    <div class="collapse mb-4" id="newAddressForm">
                        <div class="p-4 border rounded bg-light">
                            <h6 class="fw-bold mb-3" style="color: var(--navy-text);">New Shipping Address</h6>
                            <form method="POST" action="<?php echo e(route('Address.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row g-3">
                                <div class="col-3">
                                    <input type="text" id="Name" name="Name" class="form-control" placeholder="Address Name" value="<?php echo e(old('Name')); ?>" required>
                                    <?php $__errorArgs = ['Name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="StreetAddress" name="StreetAddress" class="form-control" placeholder="Street Address" value="<?php echo e(old('StreetAddress')); ?>" required>
                                    <?php $__errorArgs = ['StreetAddress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="City" name="City" class="form-control" placeholder="City" value="<?php echo e(old('City')); ?>" required>
                                    <?php $__errorArgs = ['City'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="State" name="State" class="form-control" placeholder="State" value="<?php echo e(old('State')); ?>" required>
                                    <?php $__errorArgs = ['State'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" id="PostalCode" name="PostalCode" class="form-control" placeholder="Postal Code" value="<?php echo e(old('PostalCode')); ?>" required>
                                    <?php $__errorArgs = ['PostalCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-custom-primary btn-sm">Add Address</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="accordion" id="addressAccordion">
                        <?php $__currentLoopData = Auth::user()->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- Address 1 -->
                        <div class="card mb-3 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                            <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center entry-card-header" 
                                 data-bs-toggle="collapse" data-bs-target="#collapseAddr<?php echo e($address->id); ?>">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chevron-down me-3 text-muted small"></i>
                                    <div>
                                        <span class="text-muted small d-block">Address</span>
                                        <span class="fw-bold"><?php echo e($address->Name); ?></span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="text-muted small d-block">Location</span>
                                    <span class="fw-bold" style="color: var(--navy-text);"><?php echo e($address->City); ?>, <?php echo e($address->State); ?></span>
                                </div>
                            </div>
                            
                            <div id="collapseAddr<?php echo e($address->id); ?>" class="collapse" data-bs-parent="#addressAccordion">
                                <div class="card-body pt-0 border-top">
                                    <div class="mt-3">
                                        <div class="entry-details-area">
                                            <p class="mb-1 small"><strong><?php echo e(Auth::user()->fname); ?> <?php echo e(Auth::user()->lname); ?></strong></p>
                                            <p class="mb-1 small"><strong><?php echo e(Auth::user()->email); ?> | 0<?php echo e(Auth::user()->PhoneNumber); ?></strong></p>
                                            <p class="mb-1 small"><?php echo e($address->StreetAddress); ?></p>
                                            <p class="mb-0 small"><?php echo e($address->City); ?>, <?php echo e($address->State); ?> | <?php echo e($address->PostalCode); ?></p>
                                        </div>

                                        <div class="d-flex justify-content-end mt-3 gap-2">
                                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#editAddr<?php echo e($address->id); ?>">Edit</button>
                                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAddressModal<?php echo e($address->id); ?>">Delete</button>
                                        </div>

                                        <!-- Nested Edit Form -->
                                        <div class="collapse edit-form-container" id="editAddr<?php echo e($address->id); ?>">
                                            <h6 class="fw-bold mb-3 small" style="color: var(--primary-purple);">Edit Address</h6>
                                            <form action="<?php echo e(route('Address.update', $address->id)); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="row g-2">
                                                <div class="col-3">
                                                    <input type="text" class="form-control form-control-sm" required name="Name" value="<?php echo e($address->Name); ?>">
                                                    <?php $__errorArgs = ['Name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm" required name="StreetAddress" value="<?php echo e($address->StreetAddress); ?>">
                                                    <?php $__errorArgs = ['StreetAddress'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control form-control-sm" required name="City" value="<?php echo e($address->City); ?>">
                                                    <?php $__errorArgs = ['City'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control form-control-sm" required name="State" value="<?php echo e($address->State); ?>">
                                                    <?php $__errorArgs = ['State'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control form-control-sm" required name="PostalCode" value="<?php echo e($address->PostalCode); ?>">
                                                    <?php $__errorArgs = ['PostalCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <p class="text-danger fs-6 fw-semibold ms-2">-<?php echo e($message); ?></p>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-12 text-end mt-2">
                                                    <button type="submit" class="btn btn-custom-primary btn-sm">Save Changes</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Address Modal -->
                        <div class="modal fade" id="deleteAddressModal<?php echo e($address->id); ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title fw-bold">Delete Address?</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('Address.destroy', $address->id)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <div class="modal-body p-4">
                                        <p>Are you sure you want to delete this address? Please type your password to confirm your action.</p>
                                        <input id="password" type="password" class="form-control" placeholder="*********" name="password" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div id="danger-zone" class="settings-card border-top border-danger border-4">
                    <h2 class="section-title text-danger" style="border-bottom-color: #dc3545;">Danger Zone</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-3">
                        <div class="mb-3 mb-md-0">
                            <h5 class="fw-bold mb-1">Delete Account</h5>
                            <p class="text-muted small mb-0">Permanently delete your account and all associated data. This cannot be undone.</p>
                        </div>
                        <button class="btn btn-danger-custom btn-danger rounded" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            Delete Account
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold">Delete Account?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" action="<?php echo e(route('profile.destroy')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-body p-4">
                    <p>Are you sure you want to leave us? Please type your password to confirm account deletion.</p>
                    <input id="password" type="password" class="form-control" placeholder="*********" name="password" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>




    <script>
        /**
         * Core function to switch sections.
         */
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.settings-card');
            const navLinks = document.querySelectorAll('.list-group-item');
            
            const targetSection = document.getElementById(sectionId);
            if (!targetSection) return false;

            sections.forEach(section => section.classList.remove('active-section'));
            navLinks.forEach(link => link.classList.remove('active'));

            targetSection.classList.add('active-section');
            const targetTab = document.getElementById('tab-' + sectionId);
            if (targetTab) targetTab.classList.add('active');
            
            return true;
        }

        /**
         * Navigates to a section and updates the URL query parameter.
         * Using query parameters (e.g., ?section=my-orders) is more robust for 
         * persistence across refreshes on many servers.
         */
        function navigateToSection(sectionId) {
            if (showSection(sectionId)) {
                const url = new URL(window.location);
                url.searchParams.set('section', sectionId);
                // Update history without reloading the page
                window.history.pushState({ sectionId }, '', url);
            }
        }

        /**
         * Initialize the view based on the URL parameter 'section'.
         */
        function initFromUrlParams() {
            const urlParams = new URLSearchParams(window.location.search);
            const sectionParam = urlParams.get('section');
            const defaultSection = 'personal-info';

            // Check if section exists, otherwise fallback to default
            if (sectionParam && document.getElementById(sectionParam)) {
                showSection(sectionParam);
            } else {
                showSection(defaultSection);
            }
        }

        // Run when DOM is ready
        document.addEventListener('DOMContentLoaded', initFromUrlParams);

        /**
         * Listen for popstate events (when user clicks back/forward in browser)
         */
        window.addEventListener('popstate', (event) => {
            if (event.state && event.state.sectionId) {
                showSection(event.state.sectionId);
            } else {
                initFromUrlParams();
            }
        });

        function cancelOrder(orderId) {
            const confirmed = confirm(`Are you sure you want to cancel order ${orderId}?`);
            if (confirmed) {
                alert(`Order ${orderId} has been successfully cancelled.`);
            }
        }

        /**
         * Triggers a themed confirmation modal instead of standard alert/confirm
         */
        const actionModal = new bootstrap.Modal(document.getElementById('actionModal'));
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalConfirmBtn = document.getElementById('modalConfirmBtn');
        const passwordField = document.getElementById('passwordField');
        
        function triggerActionModal(type, identifier = '') {
            passwordField.classList.add('d-none');
            modalConfirmBtn.className = 'btn btn-danger px-4';

            switch(type) {
                case 'cancelOrder':
                    modalTitle.innerText = "Cancel Order";
                    modalMessage.innerText = `Are you sure you want to cancel order ${identifier}? This action cannot be undone once processed.`;
                    modalConfirmBtn.innerText = "Cancel Order";
                    modalConfirmBtn.onclick = () => { console.log('Order cancelled:', identifier); actionModal.hide(); };
                    break;
                case 'deleteAddress':
                    modalTitle.innerText = "Delete Address";
                    modalMessage.innerText = `Are you sure you want to delete your "${identifier}" address?`;
                    modalConfirmBtn.innerText = "Delete";
                    modalConfirmBtn.onclick = () => { console.log('Address deleted:', identifier); actionModal.hide(); };
                    break;
                case 'deleteAccount':
                    modalTitle.innerText = "Delete Account";
                    modalMessage.innerText = "This will permanently remove all your data, order history, and saved addresses. This action is irreversible.";
                    modalConfirmBtn.innerText = "Permanently Delete";
                    passwordField.classList.remove('d-none');
                    modalConfirmBtn.onclick = () => { console.log('Account deletion requested'); actionModal.hide(); };
                    break;
            }
            actionModal.show();
        }
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('components.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCParadise\resources\views/user.blade.php ENDPATH**/ ?>