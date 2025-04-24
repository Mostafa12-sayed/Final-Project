@extends('website::layouts.master')

@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Orders List</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Orders List</li>
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
                                <li><a class="active" href="order-list.html"><i class="far fa-shopping-bag"></i> My Order List <span class="badge badge-danger"></span></a></li>
                                <li><a href="wishlist.html"><i class="far fa-heart"></i> My Wishlist <span class="badge badge-danger">02</span></a></li>
                                <li><a href="address-list.html"><i class="far fa-location-dot"></i> Address List</a></li>
                                <li><a href="support-ticket.html"><i class="far fa-headset"></i> Support Tickets <span class="badge badge-danger">02</span></a></li>
                                <li><a href="{{ route('order.track') }}"><i class="far fa-map-location-dot"></i> Track My Order</a></li>
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
                                <div class="user-card">
                                    <div class="user-card-header">
                                        <h4 class="user-card-title">My Orders List</h4>
                                        <div class="user-card-header-right">
                                            <div class="user-card-filter">
                                                <select class="select">
                                                    <option value="">Default</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Processing</option>
                                                    <option value="3">Cancelled</option>
                                                    <option value="4">Completed</option>
                                                </select>
                                            </div>
                                            <div class="user-card-search">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Search...">
                                                    <i class="far fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#Order No</th>
                                                    <th>Purchased Date</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td><span class="table-list-code">{{ $order->number }}</span></td>
                                                        <td>{{ $order->created_at->format('F d, Y') }}</td>
                                                        <td>${{ number_format($order->total_price, 2) }}</td>
                                                        <td>
                                                            <span class="badge 
                                                                @if($order->status == 'pending') badge-info
                                                                @elseif($order->status == 'processing') badge-primary
                                                                @elseif($order->status == 'completed') badge-success
                                                                @else badge-danger @endif">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                               
                                                                <a href="{{ route('order.details', $order->id) }}" 
                                                                class="btn btn-outline-secondary btn-sm rounded-2" 
                                                                data-tooltip="tooltip" 
                                                                title="Details">
                                                                <i class="far fa-eye"></i>
                                                                </a>
                                                            </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- pagination -->
                                    <div class="pagination-area mt-4 mb-3">
                                        <div aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $orders->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- pagination end -->
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