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
                <div class="sidebar">
                            <div class="sidebar-top">
                                <div class="sidebar-profile-img">
                                <img src="{{ Auth::user()->profile_image 
                                    ? asset('storage/users/' . Auth::user()->profile_image) 
                                    : asset('assets/img/account/user.png') }}" alt="">
                                    <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                                    <input type="file" class="profile-img-file">
                                </div>
                                <h5>{{ Auth::user()->name }}</h5>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                            <ul class="sidebar-list">
                                <li><a href="user-dashboard.html"><i class="far fa-gauge-high"></i> Dashboard</a></li>
                                <li><a href="user-profile.html"><i class="far fa-user"></i> My Profile</a></li>
                                <li><a class="active" href="order-list.html"><i class="far fa-shopping-bag"></i> My Order List <span class="badge badge-danger">02</span></a></li>
                                <li><a href="wishlist.html"><i class="far fa-heart"></i> My Wishlist <span class="badge badge-danger">02</span></a></li>
                                <li><a href="address-list.html"><i class="far fa-location-dot"></i> Address List</a></li>
                                <li><a href="support-ticket.html"><i class="far fa-headset"></i> Support Tickets <span class="badge badge-danger">02</span></a></li>
                                <li><a href="track-order.html"><i class="far fa-map-location-dot"></i> Track My Order</a></li>
                                <li><a href="payment-method.html"><i class="far fa-wallet"></i> Payment Methods</a></li>
                                <li><a href="user-notification.html"><i class="far fa-bell"></i> Notification <span class="badge badge-danger">02</span></a></li>
                                <li><a href="user-message.html"><i class="far fa-envelope"></i> Messages <span class="badge badge-danger">02</span></a></li>
                                <li><a href="user-setting.html"><i class="far fa-gear"></i> Settings</a></li>
                                <li><a href="#"><i class="far fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                </div>

                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-card user-order-detail">
                                    <div class="user-card-header">
                                      <h4 class="user-card-title">Order Details </h4>
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
                                                    @foreach($order->orderItems as $item)
                                                        <tr>
                                                            <td>
                                                                <div class="table-list-info">
                                                                    <a href="#">
                                                                        <div class="table-list-img">
                                                                            <img src="{{ asset($item->product->image ?? 'assets/img/placeholder.png') }}" alt="">
                                                                        </div>
                                                                        <div class="table-list-content">
                                                                            <h6>{{ $item->product->name ?? 'Product Deleted' }}</h6>
                                                                            <span>Item ID: #{{ $item->product->id ?? 'N/A' }}</span>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>{{ $item->product->brand ?? 'N/A' }}</td>
                                                            <td>{{ $item->quantity }} {{ $item->unit ?? 'pcs' }}</td>
                                                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Shipping Address and Order Summary -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="order-detail-content">
                                                    <h5>Shipping Address</h5>
                                                    <p><i class="far fa-location-dot"></i> {{ $order->shipping_address }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="order-detail-content">
                                                    <h5>Order Summary</h5>
                                                    <ul>
                                                        <li>Subtotal<span>${{ number_format($order->total_price, 2) }}</span></li>
                                                        <li>Shipping<span>Free</span></li>
                                                        <li>Discount<span>$0.00</span></li>
                                                        <li>Tax<span>$0.00</span></li>
                                                        <li>Total<span>${{ number_format($order->total_price, 2) }}</span></li>
                                                    </ul>
                                                    <p class="mt-4">Paid by {{ $order->payment_method ?? 'N/A' }}</p>
                                                </div>
                                            </div>
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
    <!-- user dashboard end -->
</main>
@endsection
