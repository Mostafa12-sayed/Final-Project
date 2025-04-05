@extends('website::layouts.master')
@section('content')

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 300px;
        height: 44px;
    }
    
    .switch input {
        display: none;
    }
    
    .toggle {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #f5f5f5;
        border-radius: 44px;
        display: flex;
        align-items: center;
        justify-content: space-around; /* Changed from space-between */
        padding: 0;  /* Removed padding */
        overflow: hidden;
    }
    
    .toggle:before {
        content: '';
        position: absolute;
        width: 50%;
        height: 100%;
        background-color: #03a297;
        border-radius: 44px;
        left: 0;
        transition: transform 0.3s ease;
        z-index: 0;
    }
    
    .toggle-text {
        position: relative;
        padding: 8px 25px;
        border-radius: 20px;
        white-space: nowrap;
        z-index: 1;
        transition: color 0.3s ease;
        width: 50%; /* Added fixed width */
        text-align: center; /* Center text */
    }
    
    .toggle-text:first-child {
        color: white;
    }
    
    .toggle-text:last-child {
        color: #666;
    }
    
    input:checked + .toggle::before {
        transform: translateX(100%);
    }
    
    input:checked + .toggle .toggle-text:first-child {
        color: #666;
    }
    
    input:checked + .toggle .toggle-text:last-child {
        color: white;
    }

    /* Keep existing theme-btn styles */
    .theme-btn {
        background-color: #03a297 !important;
        color: white;
        padding: 12px 30px !important;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .theme-btn:hover {
        background-color: #027d75 !important;
    }
</style>

<div class="login-area py-100">
    <div class="container">
        <div class="col-md-7 mx-auto">
            <div class="login-form">
                <div class="login-header">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" />
                    <p>Create your free medica account</p>
                </div>

                <div class="mb-3 d-flex align-items-center justify-content-center">
                    <label class="switch">
                        <input type="checkbox" id="userTypeToggle">
                        <div class="toggle">
                            <span class="toggle-text">Customer</span>
                            <span class="toggle-text">Store Owner</span>
                        </div>
                    </label>
                </div>


                <!-- customer form -->
                <div id="customer_form">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <input type="hidden" class="@error('user_type') is-invalid @enderror" name="user_type" value="customer">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Your First Name"
                                        value="{{ old('name') }}" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input
                                        name="last_name"
                                        type="text"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        placeholder="Your Last Name"
                                        value="{{ old('last_name') }}" />
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input
                                name="phone"
                                type="tel"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Your Phone Number"
                                value="{{ old('phone') }}" />
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input
                                name="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Your Email"
                                value="{{ old('email') }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input
                                name="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Your Password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input
                                name="password_confirmation"
                                type="password"
                                class="form-control"
                                placeholder="Confirm Your Password" />
                        </div>
                        <div class="form-check form-group">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value=""
                                id="agree_customer"
                                required />
                            <label class="form-check-label" for="agree_customer">
                                I agree with the <a href="#">Terms Of Service.</a>
                            </label>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" class="theme-btn">
                                <i class="far fa-paper-plane"></i> Register as Customer
                            </button>
                        </div>
                    </form>
                </div>






                <!-- store owner form -->
                <div id="store_owner_form" style="display: none;">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <input type="hidden" class="@error('user_type') is-invalid @enderror" name="user_type" value="vendor">
                        <input type="hidden" class="@error('user') is-invalid @enderror" name="user" value="vendorinput">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Owner Name</label>
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control @error('owner_name') is-invalid @enderror"
                                        placeholder="Your Name"
                                        value="{{ old('name') }}" />
                                    @error('owner_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input
                                        name="last_name"
                                        type="text"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        placeholder="Your Last Name"
                                        value="{{ old('last_name') }}" />
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Store Name</label>
                            <input
                                name="store_name"
                                type="text"
                                class="form-control @error('store_name') is-invalid @enderror"
                                placeholder="Your Store Name"
                                value="{{ old('store_name') }}" />
                            @error('store_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Store Description</label>
                            <textarea
                                name="store_description"
                                class="form-control @error('store_description') is-invalid @enderror"
                                placeholder="Describe your store"
                                rows="3">{{ old('store_description') }}</textarea>
                            @error('store_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input
                                name="phone"
                                type="tel"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Your Phone Number"
                                value="{{ old('phone') }}" />
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label>Email Address</label>
                            <input
                                name="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Your Email"
                                value="{{ old('email') }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input
                                name="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Your Password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input
                                name="password_confirmation"
                                type="password"
                                class="form-control"
                                placeholder="Confirm Your Password" />
                        </div>
                        <div class="form-check form-group">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value=""
                                id="agree_store_owner"
                                required />
                            <label class="form-check-label" for="agree_store_owner">
                                I agree with the <a href="#">Terms Of Service for Store Owners.</a>
                            </label>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" class="theme-btn">
                                <i class="far fa-store"></i> Register as Store Owner
                            </button>
                        </div>
                    </form>
                </div>

                <div class="login-footer">
                    <p>
                        Already have an account? <a href="{{ route('login') }}">Login.</a>
                    </p>
                    <div class="social-login">
                        <span class="social-divider">or</span>
                        <p>Continue with social media</p>
                        <div class="social-login-list">
                            <a href="#" class="fb-auth"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="#" class="gl-auth"><i class="fab fa-google"></i> Google</a>
                            <a href="#" class="tw-auth"><i class="fab fa-x-twitter"></i> Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const userTypeToggle = document.getElementById('userTypeToggle');
    const customerForm = document.getElementById('customer_form');
    const storeOwnerForm = document.getElementById('store_owner_form');

    // Get the old user type from server
    let oldUserType = "{{ old('user_type') }}";
    let isStoreOwner = oldUserType === 'vendor' || oldUserType === 'store_owner';

    // Set initial state
    if (isStoreOwner) {
        userTypeToggle.checked = true;
        customerForm.style.display = 'none';
        storeOwnerForm.style.display = 'block';
    } else {
        userTypeToggle.checked = false;
        customerForm.style.display = 'block';
        storeOwnerForm.style.display = 'none';
    }

    // Handle toggle changes
    userTypeToggle.addEventListener('change', function() {
        if (this.checked) {
            customerForm.style.display = 'none';
            storeOwnerForm.style.display = 'block';
        } else {
            customerForm.style.display = 'block';
            storeOwnerForm.style.display = 'none';
        }
    });
</script>

@endsection