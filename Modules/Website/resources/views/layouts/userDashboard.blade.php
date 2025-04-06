@extends('website::layouts.master')
@section('content')

<div class="user-area bg pt-100 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="sidebar-top">
                        <div class="sidebar-profile-img">
                            <img src="{{ Auth::user()->profile_photo ?? 'assets/img/account/03.jpg' }}" alt="" id="profileImage">
                            <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                            <input type="file" name="profile_image" class="profile-img-file" id="profilePhotoInput" accept="image/*" onchange="uploadPhoto(this)">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                        <script>
                            function uploadPhoto(input) {
                                if (input.files && input.files[0]) {
                                    var formData = new FormData();
                                    formData.append('profile_image', input.files[0]);
                                    formData.append('_token', '{{ csrf_token() }}');
                                    console.log(formData.get('profile_image')); // Use formData.get to inspect
                                    // $token=input.files[1];
                                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                    $.ajax({
                                        url: "{{ route('profile.update_image', Auth::user()->id) }}", // Correct URL generation
                                        type: 'PUT', // Or 'PUT', depending on your route definition
                                        data: {'profile_image':input.files[0],
                                            '_token': csrftoken}, // Send the FormData object
                                        processData: false,
                                        contentType: false,
                                        dataType: 'json',
                                        success: function(response) {
                                            $('#profileImage').attr('src', response.photo_url);
                                            console.log('Photo uploaded successfully:', response.photo_url); // Log the response for debugging
                                        },
                                        error: function(xhr) {
                                            alert('Error uploading photo');
                                            console.error(xhr); // Log the error for debugging
                                        }
                                    });
                                }
                            }

                            $(document).ready(function() {
                                $('.profile-img-btn').on('click', function() {
                                    $('#profilePhotoInput').click(); // Trigger file input click
                                });
                            });
                        </script>
                        <h5><a href="{{ route('profile.index')}}">{{ ucfirst(Auth::user()->name) }} {{ ucfirst(Auth::user()->last_name) }}</a></h5>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <ul class="sidebar-list">
                        <li><a href="user-dashboard.html"><i class="far fa-gauge-high"></i> Dashboard</a></li>
                        <li><a class="active" href="{{ route('profile.index') }}"><i class="far fa-user"></i> My Profile</a></li>
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