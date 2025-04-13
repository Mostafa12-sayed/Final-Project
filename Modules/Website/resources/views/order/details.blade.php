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
                        <div class="user-wrapper">
                        <div class="user-card user-order-detail">
                            <div class="user-card-header">
                                <h4 class="user-card-title">Order Details</h4>
                                <div class="order-status-badge">
                                    Status: <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="order-item">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <img src="{{ $item->product->image ?? asset('images/placeholder.png') }}" width="60">
                                                        <div>
                                                            <h6>{{ $item->product->name }}</h6>
                                                            <small>SKU: {{ $item->product->sku }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="order-summary">
                                            <h5>Order Summary</h5>
                                            <table class="table">
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td>${{ number_format($order->subtotal, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping</td>
                                                    <td>${{ number_format($order->shipping, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tax</td>
                                                    <td>${{ number_format($order->tax, 2) }}</td>
                                                </tr>
                                                <tr class="total">
                                                    <td>Total</td>
                                                    <td>${{ number_format($order->total, 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection