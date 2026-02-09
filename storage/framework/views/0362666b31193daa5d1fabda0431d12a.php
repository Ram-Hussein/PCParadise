
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
                                <input type="text" class="form-control" id="name" placeholder="John Doe" required>
                                <label for="name">Full Name</label>
                                <div class="invalid-feedback">Please enter your full name.</div>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="username" placeholder="johndoe123" required>
                                <label for="username">Username</label>
                                <div class="invalid-feedback">Please choose a username.</div>
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                        <label for="email">Email Address</label>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="invalid-feedback">Please provide a password.</div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Password" required>
                        <label for="password_confirmation">Confirm Your Password</label>
                        <div class="invalid-feedback">Please enter the same password.</div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Country & DOB Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="country" required>
                                    <option value="" selected disabled>Select...</option>
                                    <option value="US">United States</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="CA">Canada</option>
                                    <option value="DE">Germany</option>
                                    <option value="FR">France</option>
                                    <!-- Add more countries as needed -->
                                </select>
                                <label for="country">Country</label>
                                <div class="invalid-feedback">Please select your country.</div>
                                <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="dob" required>
                                <label for="dob">Date of Birth</label>
                                <div class="invalid-feedback" id="dobFeedback">You must be at least 18 years old.</div>
                                <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="" id="termsCheck" required>
                        <label class="form-check-label small text-muted" for="termsCheck">
                            I agree to the <a href="#" style="color: #23b5d3;">Terms of Service</a> and <a href="#" style="color: #23b5d3;">Privacy Policy</a>.
                        </label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-auth">Create Account</button>
                    
                    <!-- Switch to Sign In -->
                    <div class="auth-footer">
                        Already have an account? <a href="/SignIn">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script>
        // Form Validation Logic
        const form = document.getElementById('signupForm');
        const dobInput = document.getElementById('dob');
        const dobFeedback = document.getElementById('dobFeedback');

        form.addEventListener('submit', function (event) {
            let isValid = true;
            
            // 1. Standard HTML5 Validation check
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                isValid = false;
            }

            // 2. Custom Age Validation
            const dobValue = new Date(dobInput.value);
            const today = new Date();
            let age = today.getFullYear() - dobValue.getFullYear();
            const monthDiff = today.getMonth() - dobValue.getMonth();
            
            // Adjust age if birthday hasn't happened yet this year
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobValue.getDate())) {
                age--;
            }

            if (dobInput.value !== "" && age < 18) {
                dobInput.setCustomValidity("Invalid"); // Marks field as invalid
                dobFeedback.style.display = 'block';
                dobFeedback.textContent = "You must be 18 years or older to register.";
                event.preventDefault();
                event.stopPropagation();
                isValid = false;
            } else {
                dobInput.setCustomValidity(""); // Resets validity
            }

            form.classList.add('was-validated');

            if (isValid) {
                // Prevent actual submission for this demo
                event.preventDefault();
                alert("Account created successfully! (Demo)");
                // In a real app: window.location.href = 'main.html';
            }
        });

        // Clear custom validity on input change to allow re-check
        dobInput.addEventListener('input', () => {
            dobInput.setCustomValidity("");
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Components.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCP\resources\views/signup.blade.php ENDPATH**/ ?>