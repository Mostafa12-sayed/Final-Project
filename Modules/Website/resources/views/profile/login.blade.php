@extends('website::layouts.master')
@section('content')



<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div>

    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Log In</h4>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Log In</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->


<!-- login area -->
<div class="login-area py-90">
    <div class="container">
        <div class="col-md-7 col-lg-5 mx-auto">
            <div class="login-form">
                <div class="login-header">
                    <img src="assets/img/logo/logo.png" alt="">
                    <p>Login with your medica account</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Your Email">
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Your Password">
                        @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                        <a class="btn btn-link forgot-pass" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                        @endif
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> Login</button>
                    </div>
                </form>
                <div class="login-footer">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register.</a></p>
                    <div class="social-login">
                        <span class="social-divider">or</span>
                        <p>Continue with social media</p>
                        <div class="social-login-list">
                            <a href="{{ route('google.redirect') }}" class="gl-auth"><i class="fab fa-google"></i> Google</a>
                            <a href="{{ route('twitter.redirect') }}" class="tw-auth"><i class="fab fa-x-twitter"></i> Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login area end -->

@endsection