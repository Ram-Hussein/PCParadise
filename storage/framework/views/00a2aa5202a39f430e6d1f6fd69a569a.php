
<?php $__env->startSection('content'); ?>

<section class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h3>Join PC Paradise</h3>
                <p class="mb-0 text-white-50">Create your account to start upgrading.</p>
            </div>
            <div class="auth-body">
                <form id="signupForm" method="POST" action="<?php echo e(route('register')); ?>">
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
                                    <?php $__currentLoopData = DB::table('countries')->orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                    <!-- Terms -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="" name="termsCheck" id="termsCheck" required>
                        <label class="form-check-label small text-muted" for="termsCheck">
                            I agree to the <a href="#" style="color: #23b5d3;">Terms of Service</a> and <a href="#" style="color: #23b5d3;">Privacy Policy</a>.
                        </label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-auth">Create Account</button>
                    
                    <!-- Switch to Sign In -->
                    <div class="auth-footer">
                        Already have an account? <a href="<?php echo e(route('login')); ?>">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Components.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCParadise\resources\views/auth/register.blade.php ENDPATH**/ ?>