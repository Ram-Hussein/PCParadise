@extends('Components.layout')
@section('content')

<section class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h3>Welcome Back!</h3>
                <p class="mb-0 text-white-50">Please sign in to your account.</p>
            </div>
            <div class="auth-body">
                <form id="signinForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Username or Email -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                        <label for="loginKey">Please enter your email</label>
                        <div class="invalid-feedback">Please enter your email.</div>
                        @error('email')
                            <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="invalid-feedback">Please enter your password.</div>
                        @error('password')
                            <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Options -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label text-muted small" for="rememberMe">Remember me</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="small text-decoration-none" style="color: navy;">Forgot Password?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-auth">Sign In</button>
                    
                    <!-- Switch to Sign Up -->
                    <div class="auth-footer">
                        Don't have an account? <a href="{{ route('register') }}">Create Account</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
{{-- @section('script')

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

@endsection --}}