
<?php $__env->startSection('content'); ?>
<main class="admin-main">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="section-title m-0">User Directory</h3>
            <button class="btn btn-custom-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-user-plus me-2"></i>Add New User
            </button>
        </div>

        <div class="bg-white p-3 rounded mb-4 shadow-sm">
            <input type="text" id="userSearch" class="form-control" placeholder="Search by name or email..." onkeyup="filterUsers()">
        </div>

        <div class="bg-white rounded shadow-sm">
            <table class="table align-middle" id="usersTable">
                <thead class="table-light">
                    <tr>
                        <th class="col-md-3">User</th>
                        <th class="col-md-2">Role</th>
                        <th class="col-md-2">Joined</th>
                        <th class="text-end col-md-5">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-search="<?php echo e($user->fname); ?> <?php echo e($user->lname); ?> <?php echo e($user->email); ?>">
                        <td><strong><?php echo e($user->fname); ?> <?php echo e($user->lname); ?></strong><br><small class="text-muted"><?php echo e($user->email); ?></small></td>
                        <td><span class="badge badge-used" style="color: beige">
                            <?php if($user->is_admin): ?>
                                Admin
                            <?php else: ?>
                                Member
                            <?php endif; ?></span></td>
                        <td><?php echo e($user->created_at); ?></td>
                        <td class="text-end px-4">
                            <button class="btn btn-sm btn-secondary" data-bs-toggle="collapse" data-bs-target="#edit_user_<?php echo e($user->id); ?>">Edit</button>
                            <button class="btn btn-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#adminConfirmModal">Change Password</button>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#adminConfirmModal">Make Admin</button>
                            <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#banConfirmModal">Ban</button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">Delete</button>
                        </td>
                    </tr>
                    <tr class="collapse" id="edit_user_<?php echo e($user->id); ?>">
                        <td colspan="4">
                            <div class="edit-user-panel">
                                <h6>Edit User Account</h6>
                                <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo e($user->fname); ?>">
                                                <?php $__errorArgs = ['fname'];
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
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo e($user->lname); ?>">
                                                <?php $__errorArgs = ['lname'];
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
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user->email); ?>">
                                                <?php $__errorArgs = ['email'];
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
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" value="0<?php echo e($user->PhoneNumber); ?>">
                                                <?php $__errorArgs = ['PhoneNumber'];
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
                                            <label class="form-label">Country</label>
                                            <select id="country" name="country" class="form-select">
                                                <option value="<?php echo e($user->country_id); ?>" selected><?php echo e($user->country->name); ?></option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo e($user->date_of_birth); ?>">
                                                <?php $__errorArgs = ['dob'];
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
                                    <div class="mt-4 pt-2">
                                        <input type="number" hidden name="user_id" value=<?php echo e($user->id); ?>>
                                        <button type="submit" class="btn btn-custom-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Admin Promotion Password Modal -->
    <div class="modal fade" id="adminConfirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0"><h5 class="modal-title">Upgrade to Admin?</h5></div>
                <div class="modal-body">
                    <p>Enter <strong>YOUR</strong> admin password to authorize this promotion.</p>
                    <input type="password" class="form-control" placeholder="Admin Password">
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger">Confirm Upgrade</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="auth-header"><h3>Create User</h3></div>
                <div class="auth-body">
                    <form id="signupForm" method="POST" action="<?php echo e(route('addUser')); ?>">
                    <?php echo csrf_field(); ?>
                    <!-- Name & Username Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="John" value="<?php echo e(old('fname')); ?>" required>
                                <label for="fname">First Name</label>
                                <div class="invalid-feedback">Please enter your first name.</div>
                                <?php $__errorArgs = ['fname'];
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
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Doe" value="<?php echo e(old('lname')); ?>" required>
                                <label for="lname">Last Name</label>
                                <div class="invalid-feedback">Please enter your last name.</div>
                                <?php $__errorArgs = ['lname'];
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
                    </div>
                    <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="PhoneNumber" id="PhoneNumber" placeholder="johndoe123" value="<?php echo e(old('PhoneNumber')); ?>" required>
                                <label for="PhoneNumber">Phone Number</label>
                                <div class="invalid-feedback">Please enter your phone number.</div>
                                <?php $__errorArgs = ['PhoneNumber'];
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

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?php echo e(old('email')); ?>" required>
                        <label for="email">Email Address</label>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                        <?php $__errorArgs = ['email'];
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

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="invalid-feedback">Please provide a password.</div>
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
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password" required>
                        <label for="password_confirmation">Confirm Your Password</label>
                        <div class="invalid-feedback">Please enter the same password.</div>
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

                    <!-- Country & DOB Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="country" id="country" required>
                                    <option value="" selected disabled>Select...</option>
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <!-- Add more countries as needed -->
                                </select>
                                <label for="country">Country</label>
                                <div class="invalid-feedback">Please select your country.</div>
                                <?php $__errorArgs = ['country'];
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
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="dob" id="dob" value="<?php echo e(old('dob')); ?>" required>
                                <label for="dob">Date of Birth</label>
                                <div class="invalid-feedback" id="dobFeedback">You must be at least 18 years old.</div>
                                <?php $__errorArgs = ['dob'];
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
                    </div>
                    <!-- Submit -->
                    <div class="form-floating mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="admin" value=1 id="checkDefault">
                            <label class="form-check-label" for="checkDefault">
                                Make Admin?
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-auth">Create Account</button>
                </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
        function filterUsers() {
            let search = document.getElementById('userSearch').value.toLowerCase();
            let rows = document.querySelectorAll('#usersTable tbody tr:not(.collapse)');
            rows.forEach(row => {
                let text = row.getAttribute('data-search').toLowerCase();
                row.style.display = text.includes(search) ? '' : 'none';
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCParadise\resources\views/admin/users.blade.php ENDPATH**/ ?>