@extends('website::layouts.master')
@section('content')

<div class="user-area bg pt-100 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="sidebar-top">
                        <div class="sidebar-profile-img" style="  width: 120px;
                            height: 120px;
                            border-radius: 50%; ">
                            @if(Auth::user())
                            <img src="{{ Auth::user()->image_url }}" alt="" id="profileImage" style="  width: 100%; height: 100%; object-fit: cover;  object-position: center;">
                            @else
                            <img src="{{ asset('assets/img/account').'/04.jpg' }}" alt="" id="profileImage" style="  width: 100%; height: 100%; object-fit: cover; object-position: center;">
                            @endif
                                <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                                <input type="file" name="profile_image" class="profile-img-file" id="profilePhotoInput" accept="image/*" onchange="uploadProfilePhoto(this)">
                        </div>
                        <script>
                            function uploadProfilePhoto(input) {
                                console.log("done 1");
                                console.log(document.querySelectorAll('#profilePhotoInput').length);
                                if (input.files && input.files[0]) {
                                    var formData = new FormData();
                                    formData.append('profile_image', input.files[0]);
                                    formData.append('_token', '{{ csrf_token() }}');
                                    formData.append('_method', 'PUT');

                                    $.ajax({
                                        url: "{{ route('profile.update_image', Auth::user()->id) }}",
                                        type: 'POST', // Important: Use POST with _method for file uploads
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                $('#profileImage').attr('src', response.photo_url);
                                                console.log('Photo uploaded successfully:', response);
                                                console.log('src:', response.photo_url);
                                            } else {
                                                alert('Error: ' + (response.message || 'Unknown error'));
                                            }
                                        },
                                        error: function(xhr) {
                                            var errorMessage = 'Error uploading photo';
                                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                                errorMessage = xhr.responseJSON.message;
                                            } else if (xhr.responseText) {
                                                try {
                                                    var htmlResponse = $(xhr.responseText);
                                                    var text = htmlResponse.filter('div.alert, div.message').text() ||
                                                        htmlResponse.find('div.alert, div.message').text();
                                                    if (text) errorMessage = text.trim();
                                                } catch (e) {
                                                    errorMessage = xhr.statusText;
                                                }
                                            }
                                            alert(errorMessage);
                                            console.error('Error details:', xhr);
                                        }
                                    });
                                }
                            }

                            $(document).ready(function() {
                                $('.profile-img-btn').on('click', function(e) {
                                    e.preventDefault();  // Add this
                                    e.stopPropagation();  // Prevent event bubbling
                                    $('#profilePhotoInput').click();
                                    console.log("done 2");

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
                        <li>
                            <a href="{{ auth()->check() ? route('wishlist.index') : route('login') }}">
                                <i class="far fa-heart"></i> My Wishlist
                                @auth
                                    <span class="badge badge-danger">{{ Auth::user()->wishlist()->count() }}</span>
                                @else
                                    <span class="badge badge-danger">0</span>
                                @endauth
                            </a>
                        </li>
                        <li><a href="address-list.html"><i class="far fa-location-dot"></i> Address List</a></li>
                        <li><a href="support-ticket.html"><i class="far fa-headset"></i> Support Tickets <span class="badge badge-danger">02</span></a></li>
                        <li><a href="track-order.html"><i class="far fa-map-location-dot"></i> Track My Order</a></li>
                        <li><a href="payment-method.html"><i class="far fa-wallet"></i> Payment Methods</a></li>
                        <li><a href="user-notification.html"><i class="far fa-bell"></i> Notification <span class="badge badge-danger">02</span></a></li>
                        <li><a href="user-message.html"><i class="far fa-envelope"></i> Messages <span class="badge badge-danger">02</span></a></li>
                        <li><a href="user-setting.html"><i class="far fa-gear"></i> Settings</a></li>
                        <li><a href="{{ route('logout') }}"><i class="far fa-sign-out"></i> Logout</a></li>
                    </ul>
                </div>
            </div>

            @yield('main-content')

        </div>
    </div>
</div>
<!-- user dashboard end -->

@endsection