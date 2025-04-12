@extends('website::layouts.master')

@section('content')
<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Checkout</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- checkout -->
    <div class="shop-checkout py-90">
        <div class="container">
            <div class="shop-checkout-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <form action="{{ route('order.store') }}" method="POST">
                            @csrf
                            <div class="accordion" id="shopCheckout">
                                <!-- Billing Info -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#checkoutStep1" aria-expanded="true">
                                            Your Billing Info
                                        </button>
                                    </h2>
                                    <div id="checkoutStep1" class="accordion-collapse collapse show" data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="first_name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" name="phone">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" name="address" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Info -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#checkoutStep3">
                                            Your Payment Info
                                        </button>
                                    </h2>
                                    <div id="checkoutStep3" class="accordion-collapse collapse" data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="form-check mb-20">
                                                <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked>
                                                <label class="form-check-label" for="cod">Cash On Delivery</label>
                                            </div>
                                            <!-- Add other payment options if needed -->
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="theme-btn mt-4">Place Order <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4">
                        <div class="shop-cart-summary mt-0">
                            <h5>Cart Summary</h5>
                            @php
                                $cart = session('cart', []);
                                $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
                            @endphp
                            <ul>
                                <li><strong>Sub Total:</strong> <span>${{ number_format($subtotal, 2) }}</span></li>
                                <li><strong>Shipping:</strong> <span>Free</span></li>
                                <li class="shop-cart-total"><strong>Total:</strong> <span>${{ number_format($subtotal, 2) }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout end -->
</main>
@endsection
