@extends('website::layouts.master')
@section('content')

<!-- verify area -->
<div class="login-area py-90">
    <div class="container">
        <div class="col-md-7 col-lg-5 mx-auto">
            <div class="login-form">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="login-header">
                        <img src="assets/img/logo/logo.png" alt="">
                        <p>Reset Password</p>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input placeholder="Your Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Your New Password" />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
                            class="form-control"
                            placeholder="Confirm Your Password" />
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="submit" class="theme-btn"><i class="far "></i> Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- verify area end -->



@endsection