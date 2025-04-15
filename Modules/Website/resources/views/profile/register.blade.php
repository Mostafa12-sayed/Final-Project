@extends('website::layouts.master')
@section('content')



<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div>

    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Register</h4>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Register</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->


<div class="login-area py-100">
    <div class="container">
        <div class="col-md-7 mx-auto">
            <div class="login-form">
                <div class="login-header">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" />
                    <p>Create your free account</p>
                </div>


                <!-- customer form -->
                <div id="customer_form">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <input type="hidden" class="@error('user_type') is-invalid @enderror" name="user_type" value="customer">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Your First Name"
                                        value="{{ old('name') }}" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input
                                        name="last_name"
                                        type="text"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        placeholder="Your Last Name"
                                        value="{{ old('last_name') }}" />
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input
                                name="phone"
                                type="tel"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Your Phone Number"
                                value="{{ old('phone') }}" />
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input
                                name="email"
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Your Email"
                                value="{{ old('email') }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input
                                name="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Your Password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input
                                name="password_confirmation"
                                type="password"
                                class="form-control"
                                placeholder="Confirm Your Password" />
                        </div>
                        <div class="form-check form-group">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value=""
                                id="agree_customer" />
                            <label class="form-check-label" for="agree_customer">
                                I agree with the <a href="#">Terms Of Service.</a>
                            </label>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" class="theme-btn">
                                <i class="far fa-paper-plane"></i> Register
                            </button>
                        </div>
                    </form>
                </div>



                <div class="login-footer">
                    <p>
                        Already have an account? <a href="{{ route('login') }}">Login.</a>
                    </p>
                    <p>
                        Want to create a store? <a href="{{ route('admin.login') }}">register.</a>
                    </p>
                    <div class="social-login">
                        <span class="social-divider">or</span>
                        <p>Continue with social media</p>
                        <div class="social-login-list">
                            <a href="#" class="fb-auth"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="" class="gl-auth"><i class="fab fa-google"></i> Google</a>
                            <a href="#" class="tw-auth"><i class="fab fa-x-twitter"></i> Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection