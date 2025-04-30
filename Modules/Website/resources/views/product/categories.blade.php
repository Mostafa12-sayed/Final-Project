@extends('website::layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Category One</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Category One</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- category area -->
    <div class="category-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <h2 class="site-title">Our <span>Categories</span></h2>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                @foreach($categories as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="category-item">
                            <a href="{{ route('products', ['category' => $category->slug]) }}">
                                <div class="category-info">
                                    <div class="icon">
                                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                                    </div>
                                    <div class="content">
                                        <h4>{{ $category->name }}</h4>
                                        <p>{{ $category->products_count }} Items</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- category area end -->
@endsection
