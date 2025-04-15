@extends('website::layouts.master')
@section('content')




<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div>
    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Contact Us</h4>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Contact Us</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<main class="main">



    <!-- contact area -->
    <div class="contact-area pt-100 pb-80">
        <div class="container">
            <div class="contact-wrapper">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-info">
                                        <div class="contact-info-icon">
                                            <i class="fal fa-map-location-dot"></i>
                                        </div>
                                        <div class="contact-info-content">
                                            <h5>Office Address</h5>
                                            <p>{{ \App\Helpers\Site_Info::site_info()->address }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-info">
                                        <div class="contact-info-icon">
                                            <i class="fal fa-headset"></i>
                                        </div>
                                        <div class="contact-info-content">
                                            <h5>Call Us</h5>
                                            <p><a href="tel:+21234565788">{{ \App\Helpers\Site_Info::site_info()->phone1 }}</a></p>
                                            <p><a href="tel:+21234565789">{{ \App\Helpers\Site_Info::site_info()->phone2 }}</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-info">
                                        <div class="contact-info-icon">
                                            <i class="fal fa-envelopes"></i>
                                        </div>
                                        <div class="contact-info-content">
                                            <h5>Email Us</h5>
                                            <p><a href="mailto:medion.customer@service.com">{{ \App\Helpers\Site_Info::site_info()->email }} </a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-info">
                                        <div class="contact-info-icon">
                                            <i class="fal fa-alarm-clock"></i>
                                        </div>
                                        <div class="contact-info-content">
                                            <h5>Open Time</h5>
                                            <p>{{ \App\Helpers\Site_Info::site_info()->opening_time }}</p>
                                            <p>{{ \App\Helpers\Site_Info::site_info()->closing_time }} <span class="text-danger">Closed</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact-form">
                            <div class="contact-form-header">
                                <h2>Get In Touch</h2>
                                <p>Write your problem here and we will respond to it as soon as possible </p>
                            </div>
                            <form method="post" action="{{route('contact.store')}}" id="contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Your Name">
                                            @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Your Email">
                                            @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Your Subject">
                                    @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <textarea name="message" cols="30" rows="4" class="form-control" placeholder="Write Your Message">{{ old('message') }}</textarea>
                                    @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="theme-btn">Send
                                    Message <i class="far fa-paper-plane"></i></button>
                                <div class="col-md-12 my-3">
                                    <div class="form-messege text-success"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end contact area -->




    <!-- map -->
    <div class="contact-map" style="margin-bottom: 2rem;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55657.62861611223!2d30.783552824634057!3d29.323354465146668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1459790063055567%3A0xbc3f927149ad20e8!2z2YXYudmH2K8g2KrZg9mG2YjZhNmI2KzZitinINin2YTZhdi52YTZiNmF2KfYqiBJVEkgLUZheW91bSBCcmFuY2g!5e0!3m2!1sen!2seg!4v1744541556240!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- end map -->

</main>


@endsection