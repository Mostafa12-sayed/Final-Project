@extends('website::layouts.master')
@section('content')

        <!-- verify area -->
        <div class="login-area py-90">
            <div class="container">
                <div class="col-md-7 col-lg-5 mx-auto">
                    <div class="login-form">
                        <div class="login-header">
                            <img src="assets/img/logo/logo.png" alt="">
                            <p>Verify Your Email</p>
                            </div>
                                <div class="form-group">
                                @if (session('resent'))
                            <div class=" alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                            @endif
                            </div>
                            <div class="form-group">
                                <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="theme-btn"><i class="far fa-sign-in"></i> {{ __('click here to request another') }}</button>
                                </form>
                            </div>
                        <div class="login-footer">
                            <p>Have a Problem? <a href="">Contact Us.</a></p>
                            <div class="social-login">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- verify area end -->



@endsection