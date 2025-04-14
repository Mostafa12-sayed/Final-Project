@extends('website::layouts.master')
@section('content')

<!-- breadcrumb -->
<div class="site-breadcrumb">
    <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div>
    <div class="container">
        <div class="site-breadcrumb-wrap">
            <h4 class="breadcrumb-title">Stores</h4>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                <li class="active">Stores</li>
            </ul>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- brand area -->
<div class="brand-area2 py-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="site-heading text-center">
                    <span class="site-title-tagline">Stores</span>
                    <h2 class="site-title">Our Popular <span>Stores</span></h2>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @foreach ($stores as $store)
            <div class="col-md-6 col-lg-2">
                <div class="brand-item">
                    <img src="assets/img/brand/01.png" alt="">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- brand area end -->

</main>

@endsection