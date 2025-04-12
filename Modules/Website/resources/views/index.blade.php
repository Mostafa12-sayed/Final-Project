@extends('website::layouts.master')
@section('content')

    <main class="main">

        <!-- hero slider -->
        <div class="hero-section hs-2">
            <div class="hero-slider owl-carousel owl-theme">
                <div class="hero-single">
                    <div class="hero-single-bg" style="background-image: url(assets/img/hero/slider-1.jpg)"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="hero-content">
                                    <h6 class="hero-sub-title" data-animation="fadeInUp" data-delay=".25s">Easy Health Care</h6>
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        Medicine & <span>Health Care</span> For Your Family in city
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        There are many variations of passages orem psum available but the majority
                                        have suffered alteration in some form by injected humour.
                                    </p>
                                    <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                        <a href="shop-grid.html" class="theme-btn">Shop Now<i
                                                class="fas fa-arrow-right"></i></a>
                                        <a href="about.html" class="theme-btn theme-btn2">Learn More<i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single">
                    <div class="hero-single-bg" style="background-image: url(assets/img/hero/slider-2.jpg)"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="hero-content">
                                    <h6 class="hero-sub-title" data-animation="fadeInUp" data-delay=".25s">Easy Health Care</h6>
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        Medicine & <span>Health Care</span> For Your Family in city
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        There are many variations of passages orem psum available but the majority
                                        have suffered alteration in some form by injected humour.
                                    </p>
                                    <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                        <a href="shop-grid.html" class="theme-btn">Shop Now<i
                                                class="fas fa-arrow-right"></i></a>
                                        <a href="about.html" class="theme-btn theme-btn2">Learn More<i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single">
                    <div class="hero-single-bg" style="background-image: url(assets/img/hero/slider-3.jpg)"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="hero-content">
                                    <h6 class="hero-sub-title" data-animation="fadeInUp" data-delay=".25s">Easy Health Care</h6>
                                    <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">
                                        Medicine & <span>Health Care</span> For Your Family in city
                                    </h1>
                                    <p data-animation="fadeInLeft" data-delay=".75s">
                                        There are many variations of passages orem psum available but the majority
                                        have suffered alteration in some form by injected humour.
                                    </p>
                                    <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                        <a href="shop-grid.html" class="theme-btn">Shop Now<i
                                                class="fas fa-arrow-right"></i></a>
                                        <a href="about.html" class="theme-btn theme-btn2">Learn More<i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- hero slider end -->


        <!-- category area -->
        <div class="category-area2 pt-80 pb-100">
            <div class="container">
                <div class="category-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
                    @foreach ($categories as $category)
                    <div class="category-item">
                        <a href="{{ route('products') }}?category={{ $category->slug }}">
                            <div class="category-info">
                                <div class="icon">
                                    <img src="{{ $category->image }}" alt="">
                                </div>
                                <div class="content">
                                    <h4>{{ $category->name }}</h4>
                                    <p>{{ $category->products->count() }} Items</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- category area end-->


        <!-- small banner -->
        <div class="small-banner pb-100">
            <div class="container wow fadeInUp" data-wow-delay=".25s">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="banner-item">
                            <img src="assets/img/banner/mini-banner-1.jpg" alt="">
                            <div class="banner-content">
                                <p>Sanitizer</p>
                                <h3>Hand Sanitizer <br> Collectons</h3>
                                <a href="#">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="banner-item">
                            <img src="assets/img/banner/mini-banner-2.jpg" alt="">
                            <div class="banner-content">
                                <p>Hot Sale</p>
                                <h3>Face Wash Sale <br> Collections</h3>
                                <a href="#">Discover Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="banner-item">
                            <img src="assets/img/banner/mini-banner-3.jpg" alt="">
                            <div class="banner-content">
                                <p>Facial Mask</p>
                                <h3>Facial Mask Sale <br> Up To <span>50%</span> Off</h3>
                                <a href="#">Discover Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- small banner end -->


        <!-- feature area -->
        <div class="feature-area pb-100">
            <div class="container wow fadeInUp" data-wow-delay=".25s">
                <div class="feature-wrap">
                    <div class="row g-0">
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fal fa-truck"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Free Delivery</h4>
                                    <p>Orders Over $120</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fal fa-sync"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Get Refund</h4>
                                    <p>Within 30 Days Returns</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fal fa-wallet"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>Safe Payment</h4>
                                    <p>100% Secure Payment</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fal fa-headset"></i>
                                </div>
                                <div class="feature-content">
                                    <h4>24/7 Support</h4>
                                    <p>Feel Free To Call Us</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- feature area end -->


        <!-- popular item -->
        <div class="product-area pb-100">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="product-banner wow fadeInRight" data-wow-delay=".25s" style="margin-top: 5rem;">
                                <img src="assets/img/banner/product-banner.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-9">
                    <div class="row">
                        <div class="col-12 wow fadeInDown" data-wow-delay=".25s">
                            <div class="site-heading-inline">
                                <h2 class="site-title">Popular Items</h2>
                                <a href="{{ route('products') }}">All Products <i class="fas fa-angle-double-right"></i></a>
                            </div>
                            <div class="item-tab">
                                <ul class="nav nav-pills mt-40 mb-50" id="item-tab" role="tablist" style="gap: 10px; justify-content: unset; margin-bottom: 10px;">
                                    @foreach($categories->take(6) as $category)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" 
                                                    id="item-tab{{ $loop->iteration }}" 
                                                    data-bs-toggle="pill"
                                                    data-bs-target="#pill-item-tab{{ $loop->iteration }}" 
                                                    type="button" 
                                                    role="tab"
                                                    aria-controls="pill-item-tab{{ $loop->iteration }}" 
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                {{ $category->name }}
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        </div>
                        <div class="tab-content wow fadeInUp" data-wow-delay=".25s" id="item-tabContent" >
                            @foreach($categories->take(6) as $category)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                            id="pill-item-tab{{ $loop->iteration }}" 
                            role="tabpanel" 
                            aria-labelledby="item-tab{{ $loop->iteration }}"
                            tabindex="0">
                            <div class="row g-3 item-3">
                                        <div class="site-heading-inline justify-content-end mt-4 mb-0" >
                                            <a href="{{ route('products') }}?category={{ $category->slug }}">See More Products <i class="fas fa-angle-double-right"></i></a>
                                        </div>
                                        @foreach($category->products()->where('status', 'active')->take(8)->get() as $product)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-item">
                                                    <div class="product-img">
                                                        @if ($product->is_new)
                                                            <span class="type new" style="background-color: #27ae60;">New</span>
                                                        @endif
                                                        @if($product->discount)
                                                            <span class="type discount">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                                                        @endif
                                                        @if ( $product->stock <= 10)
                                                            <span class="type limmited" style="background-color: #6c5ce7;">Less than 10</span>
                                                        @elseif ($product->stock == 0)
                                                            <span class="type oos">Out Of Stock</span>
                                                        @endif
                                                        <a href="{{ route('product.show', $product->slug) }}">
                                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                                        </a>
                                                        <div class="product-action-wrap">
                                                            <div class="product-action">
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview-{{ $product->id }}"
                                                                data-bs-placement="top" data-tooltip="tooltip" title="Quick View">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                                <a href="#" data-bs-placement="top" data-tooltip="tooltip" title="Add To Wishlist">
                                                                    <i class="far fa-heart"></i>
                                                                </a>
                                                                <a href="#" data-bs-placement="top" data-tooltip="tooltip" title="Add To Compare">
                                                                    <i class="far fa-arrows-repeat"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3 class="product-title">
                                                            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                                        </h3>
                                                        <div class="product-rate">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="{{ $i <= $product->rating ? 'fas' : 'far' }} fa-star"></i>
                                                            @endfor
                                                        </div>
                                                        <div class="product-bottom">
                                                            <div class="product-price">
                                                                @if($product->discount)
                                                                    <del>${{ number_format($product->price, 2) }}</del>
                                                                    <span>${{ number_format($product->discountedprice, 2) }}</span>
                                                                @else
                                                                    <span>${{ number_format($product->price, 2 ) }}</span>
                                                                @endif
                                                            </div>
                                                            <button type="button" class="product-cart-btn" data-bs-placement="left"
                                                                    data-tooltip="tooltip" title="Add To Cart">
                                                                <i class="far fa-shopping-bag"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- popular item end -->


        <!-- trending item -->
        <div class="product-area pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInDown" data-wow-delay=".25s">
                        <div class="site-heading-inline">
                            <h2 class="site-title">Trending Items</h2>
                            <a href="{{ route('products') }}">View More <i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="product-wrap item-3 wow fadeInUp" data-wow-delay=".25s">
                    <div class="product-slider owl-carousel owl-theme">
                        @foreach ($top_products as $product )
                        <div class="product-item">
                            <div class="product-img">
                                <span class="type new" style="background-color: #ff6347;">trending</span>
                                <a href="shop-single.html"><img src="{{$product->image}}" alt="{{$product->name}}"></a>
                                <div class="product-action-wrap">
                                    <div class="product-action">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quickview"
                                            data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a>
                                        <a href="#" data-tooltip="tooltip" title="Add To Wishlist"><i
                                                class="far fa-heart"></i></a>
                                        <a href="#" data-tooltip="tooltip" title="Add To Compare"><i
                                                class="far fa-arrows-repeat"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3 class="product-title"><a href="shop-single.html">{{ucfirst($product->name)}}</a></h3>
                                <div class="product-rate">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $product->rating ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                                </div>
                                <div class="product-bottom">
                                    <div class="product-price">
                                    @if($product->discount)
                                        <del>${{ number_format($product->price, 2) }}</del>
                                        <span>${{ number_format($product->discountedprice, 2) }}</span>
                                    @else
                                        <span>${{ number_format($product->price, 2 ) }}</span>
                                    @endif
                                    </div>
                                    <button type="button" class="product-cart-btn" data-bs-placement="left"
                                        data-tooltip="tooltip" title="Add To Cart">
                                        <i class="far fa-shopping-bag"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- trending item end -->


        <!-- big banner -->
        <div class="big-banner">
            <div class="container wow fadeInUp" data-wow-delay=".25s">
                <div class="banner-wrap" style="background-image: url(assets/img/banner/big-banner.jpg);">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <div class="banner-content">
                                <div class="banner-info">
                                    <h6>Mega Collections</h6>
                                    <h2>Huge Sale Up To <span>40%</span> Off</h2>
                                    <p>at our outlet stores</p>
                                </div>
                                <a href="#" class="theme-btn">Shop Now<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- big banner end -->


        <!-- brand area -->
        <div class="brand-area pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="site-heading-inline">
                            <h2 class="site-title">Popular Brands</h2>
                            <a href="#">All Brands <i class="fas fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="brand-slider owl-carousel owl-theme">
                    <div class="brand-item">
                        <a href="#">
                            <img src="assets/img/brand/01.png" alt="">
                        </a>
                    </div>
                    <div class="brand-item">
                        <a href="#">
                            <img src="assets/img/brand/02.png" alt="">
                        </a>
                    </div>
                    <div class="brand-item">
                        <a href="#">
                            <img src="assets/img/brand/03.png" alt="">
                        </a>
                    </div>
                    <div class="brand-item">
                        <a href="#">
                            <img src="assets/img/brand/04.png" alt="">
                        </a>
                    </div>
                    <div class="brand-item">
                        <a href="#">
                            <img src="assets/img/brand/05.png" alt="">
                        </a>
                    </div>
                    <div class="brand-item">
                        <a href="#">
                            <img src="assets/img/brand/06.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand area end -->


        <!-- product list -->
        <div class="product-list py-100">
            <div class="container wow fadeInUp" data-wow-delay=".25s">
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="product-list-box border">
                            <h2 class="product-list-title">On sale</h2>
                            @foreach ($on_sale_products->take(3) as $product)
                            <div class="product-list-item">
                                <div class="product-list-img">
                                    <a href="{{route('products', $product->slug)}}"><img src="{{ $product->image }}" alt="#"></a>
                                </div>
                                <div class="product-list-content product-item">
                                    <h4><a href="{{ route('products', $product->slug) }}">{{ $product->name }}</a></h4>
                                        <span class="type discount">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                                    <div class="product-list-rate">
                                        @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $product->rating ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                        </div>
                                        <div class="product-list-price">
                                        @if($product->discount)
                                            <del>${{ number_format($product->price, 2) }}</del>
                                            <span>${{ number_format($product->discountedprice, 2) }}</span>
                                        @else
                                            <span>${{ number_format($product->price, 2 ) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <a href="#" class="product-list-btn" data-bs-placement="left" data-tooltip="tooltip"
                                    title="Add To Cart"><i class="far fa-shopping-bag"></i></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="product-list-box border">
                            <h2 class="product-list-title">Best Seller</h2>
                            @foreach ($top_products->take(3) as $product)
                            <div class="product-list-item">
                                <div class="product-list-img">
                                    <a href="{{ route('products', $product->slug) }}"><img src="{{ $product->image }}" alt="#"></a>
                                </div>
                                <div class="product-list-content product-item">
                                    <h4><a href="shop-single.html">{{ ucfirst($product->name) }}</a></h4>
                                    @if($product->discount)
                                        <span class="type discount">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                                    @endif
                                    @if ( $product->stock <= 10)
                                        <span class="type limmited" style="background-color: #6c5ce7;">Less than 10</span>
                                    @endif
                                    <div class="product-list-rate">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $product->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                    </div>
                                    <div class="product-list-price">
                                    @if($product->discount)
                                            <del>${{ number_format($product->price, 2) }}</del>
                                            <span>${{ number_format($product->discountedprice, 2) }}</span>
                                        @else
                                            <span>${{ number_format($product->price, 2 ) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <a href="#" class="product-list-btn" data-bs-placement="left" data-tooltip="tooltip"
                                    title="Add To Cart"><i class="far fa-shopping-bag"></i></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="product-list-box border">
                            <h2 class="product-list-title">Top Rated</h2>
                            @foreach ($top_rated as $product)
                            <div class="product-list-item">
                                <div class="product-list-img">
                                    <a href="{{ route('products', $product->slug) }}"><img src="{{ $product->image }}" alt="#"></a>
                                </div>
                                <div class="product-list-content product-item">
                                    <h4><a href="shop-single.html">{{ ucfirst($product->name) }}</a></h4>
                                    @if($product->discount)
                                        <span class="type discount">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                                    @endif
                                    @if ( $product->stock <= 10)
                                        <span class="type limmited" style="background-color: #6c5ce7;">Less than 10</span>
                                    @endif
                                    <div class="product-list-rate">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $product->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                    </div>
                                    <div class="product-list-price">
                                    @if($product->discount)
                                            <del>${{ number_format($product->price, 2) }}</del>
                                            <span>${{ number_format($product->discountedprice, 2) }}</span>
                                        @else
                                            <span>${{ number_format($product->price, 2 ) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <a href="#" class="product-list-btn" data-bs-placement="left" data-tooltip="tooltip"
                                    title="Add To Cart"><i class="far fa-shopping-bag"></i></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- product list end -->


        <!-- deal area -->
        <div class="deal-area pt-50 pb-50">
            <div class="deal-text-shape">Deal</div>
            <div class="container">
                <div class="deal-wrap wow fadeInUp" data-wow-delay=".25s">
                    <div class="deal-slider owl-carousel owl-theme">
                        <div class="deal-item">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="deal-content">
                                        <div class="deal-info">
                                            <span>Weekly Deal</span>
                                            <h1>Best Deal For This Week</h1>
                                            <p>There are many variations of passages available but the majority have
                                                suffered alteration in some form
                                                by injected humour, or randomised words which don't look even slightly
                                                believable.</p>
                                        </div>
                                        <div class="deal-countdown">
                                            <div class="countdown" data-countdown="2025/12/30"></div>
                                        </div>
                                        <a href="#" class="theme-btn theme-btn2">Shop Now <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="deal-img">
                                        <img src="assets/img/deal/01.png" alt="">
                                        <div class="deal-discount">
                                            <span>35%</span>
                                            <span>off</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="deal-item">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="deal-content">
                                        <div class="deal-info">
                                            <span>Weekly Deal</span>
                                            <h1>Best Deal For This Week</h1>
                                            <p>There are many variations of passages available but the majority have
                                                suffered alteration in some form
                                                by injected humour, or randomised words which don't look even slightly
                                                believable.</p>
                                        </div>
                                        <div class="deal-countdown">
                                            <div class="countdown" data-countdown="2025/12/30"></div>
                                        </div>
                                        <a href="#" class="theme-btn theme-btn2">Shop Now <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="deal-img">
                                        <img src="assets/img/deal/02.png" alt="">
                                        <div class="deal-discount">
                                            <span>35%</span>
                                            <span>off</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="deal-item">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="deal-content">
                                        <div class="deal-info">
                                            <span>Weekly Deal</span>
                                            <h1>Best Deal For This Week</h1>
                                            <p>There are many variations of passages available but the majority have
                                                suffered alteration in some form
                                                by injected humour, or randomised words which don't look even slightly
                                                believable.</p>
                                        </div>
                                        <div class="deal-countdown">
                                            <div class="countdown" data-countdown="2025/12/30"></div>
                                        </div>
                                        <a href="#" class="theme-btn theme-btn2">Shop Now <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="deal-img">
                                        <img src="assets/img/deal/03.png" alt="">
                                        <div class="deal-discount">
                                            <span>35%</span>
                                            <span>off</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- deal area end -->


        <!-- gallery-area -->
        <div class="gallery-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Our Gallery</span>
                            <h2 class="site-title">Let's Check Our Photo <span>Gallery</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4 popup-gallery">
                    <div class="col-md-12 col-lg-6">
                        <div class="gallery-item gallery-btn-active wow fadeInUp" data-wow-delay=".25s">
                            <div class="gallery-img">
                                <img src="assets/img/gallery/01.jpg" alt="">
                                <a class="popup-img gallery-link" href="assets/img/gallery/01.jpg"><i
                                    class="fal fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="gallery-item wow fadeInDown" data-wow-delay=".25s">
                            <div class="gallery-img">
                                <img src="assets/img/gallery/02.jpg" alt="">
                                <a class="popup-img gallery-link" href="assets/img/gallery/02.jpg"><i
                                        class="fal fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="gallery-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="gallery-img">
                                <img src="assets/img/gallery/03.jpg" alt="">
                                <a class="popup-img gallery-link" href="assets/img/gallery/03.jpg"><i
                                        class="fal fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="gallery-item wow fadeInDown" data-wow-delay=".25s">
                            <div class="gallery-img">
                                <img src="assets/img/gallery/04.jpg" alt="">
                                <a class="popup-img gallery-link" href="assets/img/gallery/04.jpg"><i
                                        class="fal fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <div class="gallery-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="gallery-img">
                                <img src="assets/img/gallery/05.jpg" alt="">
                                <a class="popup-img gallery-link" href="assets/img/gallery/05.jpg"><i
                                        class="fal fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-6">
                        <div class="gallery-item wow fadeInDown" data-wow-delay=".25s">
                            <div class="gallery-img">
                                <img src="assets/img/gallery/06.jpg" alt="">
                                <a class="popup-img gallery-link" href="assets/img/gallery/06.jpg"><i
                                        class="fal fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- gallery-area end -->


        <!-- testimonial area -->
        <div class="testimonial-area ts-bg py-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-delay=".25s">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Testimonials</span>
                            <h2 class="site-title text-white">What Our Client Say's <span>About Us</span></h2>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
                    <div class="testimonial-item">
                        <div class="testimonial-author">
                            <div class="testimonial-author-img">
                                <img src="assets/img/testimonial/01.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Sylvia H Green</h4>
                                <p>Customer</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of long passages available but the content majority have
                                suffered to the editor page when looking at its layout alteration in some injected.
                            </p>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote-icon"><img src="assets/img/icon/quote.svg" alt=""></div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-author">
                            <div class="testimonial-author-img">
                                <img src="assets/img/testimonial/02.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Gordo Novak</h4>
                                <p>Customer</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of long passages available but the content majority have
                                suffered to the editor page when looking at its layout alteration in some injected.
                            </p>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote-icon"><img src="assets/img/icon/quote.svg" alt=""></div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-author">
                            <div class="testimonial-author-img">
                                <img src="assets/img/testimonial/03.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Reid E Butt</h4>
                                <p>Customer</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of long passages available but the content majority have
                                suffered to the editor page when looking at its layout alteration in some injected.
                            </p>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote-icon"><img src="assets/img/icon/quote.svg" alt=""></div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-author">
                            <div class="testimonial-author-img">
                                <img src="assets/img/testimonial/04.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Parker Jimenez</h4>
                                <p>Customer</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of long passages available but the content majority have
                                suffered to the editor page when looking at its layout alteration in some injected.
                            </p>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote-icon"><img src="assets/img/icon/quote.svg" alt=""></div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-author">
                            <div class="testimonial-author-img">
                                <img src="assets/img/testimonial/05.jpg" alt="">
                            </div>
                            <div class="testimonial-author-info">
                                <h4>Heruli Nez</h4>
                                <p>Customer</p>
                            </div>
                        </div>
                        <div class="testimonial-quote">
                            <p>
                                There are many variations of long passages available but the content majority have
                                suffered to the editor page when looking at its layout alteration in some injected.
                            </p>
                        </div>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="testimonial-quote-icon"><img src="assets/img/icon/quote.svg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonial area end -->


        <!-- blog area -->
        <div class="blog-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Our Blog</span>
                            <h2 class="site-title">Our Latest News & <span>Blog</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="blog-item-img">
                                <img src="assets/img/blog/01.jpg" alt="Thumb">
                                <span class="blog-date"><i class="far fa-calendar-alt"></i> Aug 12, 2024</span>
                            </div>
                            <div class="blog-item-info">
                                <div class="blog-item-meta">
                                    <ul>
                                        <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
                                        <li><a href="#"><i class="far fa-comments"></i> 2.5k Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="blog-title">
                                    <a href="#">There are many variations of passage available majority suffered.</a>
                                </h4>
                                <p>There are many variations available the majority have suffered alteration randomised
                                    words.</p>
                                <a class="theme-btn" href="#">Read More<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-item wow fadeInDown" data-wow-delay=".25s">
                            <div class="blog-item-img">
                                <img src="assets/img/blog/02.jpg" alt="Thumb">
                                <span class="blog-date"><i class="far fa-calendar-alt"></i> Aug 15, 2024</span>
                            </div>
                            <div class="blog-item-info">
                                <div class="blog-item-meta">
                                    <ul>
                                        <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
                                        <li><a href="#"><i class="far fa-comments"></i> 3.1k Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="blog-title">
                                    <a href="#">Contrary to popular belief making simply random text latin.</a>
                                </h4>
                                <p>There are many variations available the majority have suffered alteration randomised
                                    words.</p>
                                <a class="theme-btn" href="#">Read More<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                            <div class="blog-item-img">
                                <img src="assets/img/blog/03.jpg" alt="Thumb">
                                <span class="blog-date"><i class="far fa-calendar-alt"></i> Aug 18, 2024</span>
                            </div>
                            <div class="blog-item-info">
                                <div class="blog-item-meta">
                                    <ul>
                                        <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
                                        <li><a href="#"><i class="far fa-comments"></i> 1.6k Comments</a></li>
                                    </ul>
                                </div>
                                <h4 class="blog-title">
                                    <a href="#"> If you are going use passage you need sure there middle
                                        text.</a>
                                </h4>
                                <p>There are many variations available the majority have suffered alteration randomised
                                    words.</p>
                                <a class="theme-btn" href="#">Read More<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog area end -->

    </main>
@endsection
