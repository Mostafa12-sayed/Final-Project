 @extends('layouts.master')
@section('title', 'Payment')
@section('content')
@dd($iframeUrl)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
{{--            <div class="card">--}}
{{--                <div class="card-header">Checkout</div>--}}

{{--                <div class="card-body">--}}
                    <a href="{{ route('cart.index', $order->id) }}" class="btn btn-primary">Back to Cart</a>
                    <h2>Order #{{ $order->id }}</h2>
                    <p>Total: {{ number_format($order->total, 2) }} EGP</p>

                    <div class="iframe-container" style="position: relative; min-height: 700px;">
                        <iframe src="{{ $iframeUrl }}" width="100%" height="700" frameborder="0" allowfullscreen></iframe>
                    </div>
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection

