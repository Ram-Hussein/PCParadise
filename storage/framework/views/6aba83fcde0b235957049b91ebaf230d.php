
<?php $__env->startSection('content'); ?>

<section class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h3>Welcome Back!</h3>
                <p class="mb-0 text-white-50">Please sign in to your account.</p>
            </div>
            <div class="auth-body">
                <form id="signinForm" method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <!-- Username or Email -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                        <label for="loginKey">Please enter your email</label>
                        <div class="invalid-feedback">Please enter your email or username.</div>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <!-- Options -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label text-muted small" for="rememberMe">Remember me</label>
                        </div>
                        <a href="<?php echo e(route('password.request')); ?>" class="small text-decoration-none" style="color: navy;">Forgot Password?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-auth">Sign In</button>
                    
                    <!-- Switch to Sign Up -->
                    <div class="auth-footer">
                        Don't have an account? <a href="/SignUp">Create Account</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Components.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCParadise\resources\views/signin.blade.php ENDPATH**/ ?>