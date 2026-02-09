
<?php $__env->startSection('content'); ?>

<section class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h3>Welcome Back!</h3>
                <p class="mb-0 text-white-50">Please sign in to your account.</p>
            </div>
            <div class="auth-body">
                <form id="signinForm" novalidate>
                    <!-- Username or Email -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="loginKey" placeholder="Email or Username" required>
                        <label for="loginKey">Email or Username</label>
                        <div class="invalid-feedback">Please enter your email or username.</div>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <!-- Options -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label text-muted small" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="small text-decoration-none" style="color: navy;">Forgot Password?</a>
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
<?php $__env->startSection('script'); ?>

<script>
        // Simple form validation visual feedback
        const form = document.getElementById('signinForm');
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                event.preventDefault(); // Prevent actual submission
                alert("Sign in successful! (Demo)");
                // In real app: window.location.href = 'main.html';
            }
            form.classList.add('was-validated');
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Components.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCP\resources\views/signin.blade.php ENDPATH**/ ?>