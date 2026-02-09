@extends('Components.layout')
@section('content')

<section class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h3>Join PC Paradise</h3>
                <p class="mb-0 text-white-50">Create your account to start upgrading.</p>
            </div>
            <div class="auth-body">
                <form id="signupForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name & Username Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="John" value="{{ old('fname') }}" required>
                                <label for="fname">First Name</label>
                                <div class="invalid-feedback">Please enter your first name.</div>
                                @error('fname')
                                    <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Doe" value="{{ old('lname') }}" required>
                                <label for="lname">Last Name</label>
                                <div class="invalid-feedback">Please enter your last name.</div>
                                @error('lname')
                                    <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="PhoneNumber" id="PhoneNumber" placeholder="johndoe123" value="{{ old('PhoneNumber') }}" required>
                                <label for="PhoneNumber">Phone Number</label>
                                <div class="invalid-feedback">Please enter your phone number.</div>
                                @error('PhoneNumber')
                                    <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                                @enderror
                            </div>

                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="email">Email Address</label>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                        @error('email')
                            <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="invalid-feedback">Please provide a password.</div>
                        @error('password')
                            <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password" required>
                        <label for="password_confirmation">Confirm Your Password</label>
                        <div class="invalid-feedback">Please enter the same password.</div>
                        @error('password_confirmation')
                            <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Country & DOB Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="country" id="country" required>
                                    <option value="" selected disabled>Select...</option>
                                    @foreach (DB::table('countries')->orderBy('name')->get() as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                    <!-- Add more countries as needed -->
                                </select>
                                <label for="country">Country</label>
                                <div class="invalid-feedback">Please select your country.</div>
                                @error('country')
                                    <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob') }}" required>
                                <label for="dob">Date of Birth</label>
                                <div class="invalid-feedback" id="dobFeedback">You must be at least 18 years old.</div>
                                @error('dob')
                                    <p class="text-danger fs-6 fw-semibold ms-2">-{{ $message }}</p>
                                @enderror
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
                        Already have an account? <a href="/SignIn">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
{{-- @section('script')

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

            //if (isValid) {
                // Prevent actual submission for this demo
              //  event.preventDefault();
                //alert("Account created successfully! (Demo)");
                // In a real app: window.location.href = 'main.html';
            //}
        });

        // Clear custom validity on input change to allow re-check
        dobInput.addEventListener('input', () => {
            dobInput.setCustomValidity("");
        });
    </script>

@endsection --}}