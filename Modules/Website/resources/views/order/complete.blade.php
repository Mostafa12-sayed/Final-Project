@extends('website::layouts.master')

@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Checkout Complete</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Checkout Complete</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- shop checkout complete -->
    <div class="shop-checkout-complete py-100">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="checkout-complete-content text-center">
                        <div class="checkout-complete-icon"><i class="far fa-check"></i></div>
                        <h3>Thank you for your order!</h3>
                        <p>Your order has been placed and will be processed as soon as possible.<br>
                            Your order number is: <b>{{ $order->number }}</b>.<br>
                            You will receive an email shortly with confirmation of your order.</p>

                        <a href="{{ route('products') }}" class="theme-btn mt-3">Go Back Shopping <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop checkout complete end -->

</main>
@endsection
