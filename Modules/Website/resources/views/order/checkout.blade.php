@extends('website::layouts.master')

@section('content')
<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Shop Checkout</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Shop Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- shop checkout -->
    <div class="shop-checkout py-90">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="shop-checkout-wrap">
                <div class="row">              
                    <div class="col-lg-8">
                        <div class="shop-checkout-step">
                            <form action="{{ route('order.store') }}" method="POST" id="checkoutForm">
                                @csrf
                                <div class="accordion" id="shopCheckout">
                                    <!-- Billing Address Section -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkoutStep1" aria-expanded="true" aria-controls="checkoutStep1">
                                                Your Billing Address
                                            </button>
                                        </h2>
                                        <div id="checkoutStep1" class="accordion-collapse collapse show" data-bs-parent="#shopCheckout">
                                            <div class="accordion-body">
                                                <div class="shop-checkout-form">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Address Line 1</label>
                                                                <input type="text" name="street_address" class="form-control" value="{{ old('street_address') }}" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <select name="country" class="select form-control" required>
                                                                    <option value="">Choose Country</option>
                                                                    <option value="EG" {{ old('country') == 'EG' ? 'selected' : '' }}>Egypt</option>
                                                                    <!-- Add other countries -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Post Code</label>
                                                                <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" name="state" class="form-control" value="{{ old('state') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Payment Info Section -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#checkoutStep3" aria-expanded="false" aria-controls="checkoutStep3">
                                                Payment Method
                                            </button>
                                        </h2>
                                        <div id="checkoutStep3" class="accordion-collapse collapse" data-bs-parent="#shopCheckout">
                                            <div class="accordion-body">
                                                <div class="shop-checkout-payment">
                                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" data-payment-method="credit_card" type="button">
                                                                <div class="checkout-card-img">
                                                                    <img src="{{ asset('assets/img/payment/mastercard.svg') }}" alt="">
                                                                    <img src="{{ asset('assets/img/payment/visa.svg') }}" alt="">
                                                                </div>
                                                                <span>Credit Card</span>
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" data-payment-method="paypal" type="button">
                                                                <div class="checkout-payment-img">
                                                                    <img src="{{ asset('assets/img/payment/paypal-2.svg') }}" alt="">
                                                                </div>
                                                                <span>PayPal</span>
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" data-payment-method="cod" type="button">
                                                                <div class="checkout-payment-img cod">
                                                                    <img src="{{ asset('assets/img/payment/cod-3.svg') }}" alt="">
                                                                </div>
                                                                <span>Cash On Delivery</span>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                    
                                                    <input type="hidden" name="payment_method" value="cod" id="paymentMethodInput">
                                                    
                                                    <div class="row mt-4">
                                                        <div class="col-lg-12">
                                                            <button type="button" class="theme-btn theme-btn2" id="backToCartBtn">
                                                                <span class="fas fa-arrow-left"></span> Back To Cart
                                                            </button>
                                                            <button type="submit" class="theme-btn" id="submitOrderBtn">
                                                                Place Order <i class="fas fa-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="shop-cart-summary mt-0">
                            <h5>Cart Summary</h5>
                            <ul>
                                <li><strong>Sub Total:</strong> <span>${{ number_format($cartData['subtotal'], 2) }}</span></li>
                                <li><strong>Discount:</strong> <span>${{ number_format($cartData['discount'], 2) }}</span></li>
                                <li><strong>Shipping:</strong> <span>Free</span></li>
                                <li><strong>Taxes:</strong> <span>${{ number_format($cartData['taxes'], 2) }}</span></li>
                                <li class="shop-cart-total">
                                    <strong>Total:</strong> <span>${{ number_format($cartData['total'], 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Payment method selection
    const paymentMethodInput = document.getElementById('paymentMethodInput');
    const paymentButtons = document.querySelectorAll('[data-payment-method]');
    
    paymentButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            paymentButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            // Update hidden input value
            paymentMethodInput.value = this.getAttribute('data-payment-method');
        });
    });

    // Form submission handling
    const checkoutForm = document.getElementById('checkoutForm');
    const submitBtn = document.getElementById('submitOrderBtn');
    
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            // Validate required fields
            let isValid = true;
            const requiredFields = this.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                    
                    if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'This field is required';
                        field.parentNode.insertBefore(errorDiv, field.nextSibling);
                    }
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                return;
            }
            
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...';
        });
    }
    
    // Back to cart button
    const backToCartBtn = document.getElementById('backToCartBtn');
    if (backToCartBtn) {
        backToCartBtn.addEventListener('click', function() {
            window.location.href = "{{ route('cart.index') }}";
        });
    }
});
</script>
@endsection

@section('styles')
<style>
.is-invalid {
    border-color: #dc3545 !important;
}
.invalid-feedback {
    color: #dc3545;
    font-size: 0.875em;
    display: none;
}
.is-invalid + .invalid-feedback {
    display: block;
}
.nav-pills .nav-link.active {
    background-color: #0d6efd;
    color: white;
}
</style>
@endsection