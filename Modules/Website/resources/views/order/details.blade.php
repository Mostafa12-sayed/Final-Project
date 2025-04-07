@extends('website::layouts.master')

@section('content')
<main class="main">
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">All Order Details</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Order Details</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- user dashboard -->
    <div class="user-area bg pt-100 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Sidebar content here... -->
                </div>

                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-card user-order-detail">
                                    <div class="user-card-header">
                                        <h4 class="user-card-title">All Orders</h4>
                                    </div>


                                    @foreach($orders as $order)
                                    <div class="order-item">
                                        <div class="order-header">
                                            <h4>Order ID: {{ $order->tracking_number }}</h4>
                                            <a href="{{ route('order.show', $order->id) }}" class="theme-btn">View Details</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-borderless text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Brand</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="table-list-info">
                                                                <a href="#">
                                                                    <div class="table-list-img">
                                                                        <img src="{{ asset('assets/img/product/'.$item->product->image) }}" alt="">
                                                                    </div>
                                                                    <div class="table-list-content">
                                                                        <h6>{{ $item->product->name }}</h6>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->product->brand }}</td>
                                                        <td>{{ $item->quantity }} Pcs</td>
                                                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- user dashboard end -->
</main>
@endsection
