@extends('website::layouts.master')
@section('content')

<div class="user-area bg pt-100 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="sidebar-top">
                        <div class="sidebar-profile-img">
                            <img src="assets/img/account/03.jpg" alt="">
                            <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                            <input type="file" class="profile-img-file">
                        </div>
                        <h5>Antoni Jonson</h5>
                        <p><a href="https://live.themewild.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1f7e716b7071765f7a677e726f737a317c7072">[email&#160;protected]</a></p>
                    </div>
                    <ul class="sidebar-list">
                        <li><a href="user-dashboard.html"><i class="far fa-gauge-high"></i> Dashboard</a></li>
                        <li><a class="active" href="user-profile.html"><i class="far fa-user"></i> My Profile</a></li>
                        <li><a href="order-list.html"><i class="far fa-shopping-bag"></i> My Order List <span class="badge badge-danger">02</span></a></li>
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
            
                    @yield('main-content')
                
        </div>
    </div>
</div>
<!-- user dashboard end -->

@endsection