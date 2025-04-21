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
                <!-- <div class="col-lg-3">
                        <div class="product-banner wow fadeInRight" data-wow-delay=".25s" style="margin-top: 5rem;">
                                <img src="assets/img/banner/product-banner.jpg" alt="">
                        </div>
                    </div> -->
                <div class="col-lg-12">
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
                    <div class="tab-content wow fadeInUp" data-wow-delay=".25s" id="item-tabContent">
                        @foreach($categories->take(6) as $category)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="pill-item-tab{{ $loop->iteration }}"
                            role="tabpanel"
                            aria-labelledby="item-tab{{ $loop->iteration }}"
                            tabindex="0">
                            <div class="row g-3 item-3">
                                <div class="site-heading-inline justify-content-end mt-4 mb-0">
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
                                                        <a data-href="{{route('product.modal', ['product'=> $product->id])}}" data-container="#website-table-modal" class="btn-modal"><i class="far fa-eye"></i></a>
                                                        <a href="#" class="add-to-wishlist" data-bs-placement="top" data-tooltip="tooltip" title="Add To Wishlist" data-product-id="{{ $product->id }}">
                                                            <i class="
                                                                    @auth
                                                                    {{ Auth::check() && Auth::user()->wishlist()->where('product_id', $product->id)->exists() ? 'fas' : 'far' }} 
                                                                    @else
                                                                    far
                                                                    @endauth
                                                                     fa-heart"></i></a>
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
                                                <button type="button" class="product-cart-btn add-to-cart" data-product-id="{{ $product->id }}" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
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
                                    <a data-href="{{route('product.modal', ['product'=> $product->id])}}" data-container="#website-table-modal" class="btn-modal"><i class="far fa-eye"></i></a>

                                    <a href="#" class="add-to-wishlist" data-bs-placement="top" data-tooltip="tooltip" title="Add To Wishlist" data-product-id="{{ $product->id }}">
                                        <i class="
                                                                    @auth
                                                                    {{ Auth::check() && Auth::user()->wishlist()->where('product_id', $product->id)->exists() ? 'fas' : 'far' }} 
                                                                    @else
                                                                    far
                                                                    @endauth
                                                                    fa-heart"></i></a>
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
                                <button type="button" class="product-cart-btn add-to-cart" data-product-id="{{ $product->id }}" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                    <i class="far fa-shopping-bag"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="product-wrap item-3 wow fadeInUp mt-30" data-wow-delay=".25s">
                <div class="product-slider owl-carousel owl-theme">
                    @foreach ($top_products2 as $product )
                    <div class="product-item">
                        <div class="product-img">
                            <span class="type new" style="background-color: #ff6347;">trending</span>
                            <a href="shop-single.html"><img src="{{$product->image}}" alt="{{$product->name}}"></a>
                            <div class="product-action-wrap">
                                <div class="product-action">
                                    <a data-href="{{route('product.modal', ['product'=> $product->id])}}" data-container="#website-table-modal" class="btn-modal"><i class="far fa-eye"></i></a>

                                    <a href="#" class="add-to-wishlist" data-bs-placement="top" data-tooltip="tooltip" title="Add To Wishlist" data-product-id="{{ $product->id }}">
                                        <i class="
                                                                    @auth
                                                                    {{ Auth::check() && Auth::user()->wishlist()->where('product_id', $product->id)->exists() ? 'fas' : 'far' }} 
                                                                    @else
                                                                    far
                                                                    @endauth
                                                                     fa-heart"></i></a>
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
                                <button type="button" class="product-cart-btn add-to-cart" data-product-id="{{ $product->id }}" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
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







    <!-- deal area -->
    <div class="deal-area pt-50 pb-50 ">
        <div class="deal-text-shape">Deal</div>
        <div class="container">
            <div class="deal-wrap wow fadeInUp" data-wow-delay=".25s">
                <div class="deal-slider owl-carousel owl-theme">
                    @foreach ($on_sale_products as $product)
                    <div class="deal-item">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="deal-content">
                                    <div class="deal-info">
                                        <span>Limmited Deal</span>
                                        <h1>Best Deal For This Week</h1>
                                        <p>{{$product->ddescription}}</p>
                                    </div>
                                    <div class="deal-countdown">
                                        <div class="countdown" data-countdown="2025/12/30"></div>
                                    </div>
                                    <a href="{{ route('product.show', $product->slug) }}" class="theme-btn theme-btn2">Shop Now <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="deal-img">
                                    <img src="{{$product->image}}" alt="">
                                    <div class="deal-discount">
                                        <span style="font-size: 30px;">{{round($product->discount, 1)}}%</span>
                                        <span>off</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- deal area end -->


    <!-- product list -->
    <div class="product-list py-50 mt-100">
        <div class="container wow fadeInUp" data-wow-delay=".25s">
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="product-list-box border">
                        <h2 class="product-list-title">On sale</h2>
                        @foreach ($on_sale_products->take(3) as $product)
                        <div class="product-list-item">
                            <div class="product-list-img">
                                <a href="{{route('product.show', $product->slug)}}"><img src="{{ $product->image }}" alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
                                <span class="type discount" style="background-color: #ff6347; color: white; border-radius: 5px; padding: 3px;">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
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
                            <a href="#" class="product-list-btn add-to-cart" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart" data-product-id="{{ $product->id }}"><i class="far fa-shopping-bag"></i></a>
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
                                <a href="{{ route('product.show', $product->slug) }}"><img src="{{ $product->image }}" alt="#"></a>
                            </div>
                            <div class="product-list-content ">
                                <h4><a href="{{ route('product.show', $product->slug) }}">{{ ucfirst($product->name) }}</a></h4>
                                @if($product->discount)
                                <span class="type discount" style="background-color: #ff6347; color: white; border-radius: 5px; padding: 3px;">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                                @endif
                                @if ( $product->stock <= 10)
                                    <span class="type limmited" style="background-color: #6c5ce7;  color: white; border-radius: 5px;padding: 3px;">Less than 10</span>
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
                            <a href="#" class="product-list-btn add-to-cart" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart" data-product-id="{{ $product->id }}"><i class="far fa-shopping-bag"></i></a>
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
                                <a href="{{ route('product.show', $product->slug) }}"><img src="{{ $product->image }}" alt="#"></a>
                            </div>
                            <div class="product-list-content">
                                <h4><a href="{{ route('product.show', $product->slug) }}">{{ ucfirst($product->name) }}</a></h4>
                                @if($product->discount)
                                <span class="type discount" style="background-color: #ff6347; color: white; border-radius: 5px; padding: 3px;">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                                @endif
                                @if ( $product->stock <= 10)
                                    <span class="type limmited" style="background-color: #6c5ce7;  color: white; border-radius: 5px ;padding: 3px;">Less than 10</span>
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
                            <a href="#" class="product-list-btn add-to-cart" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart" data-product-id="{{ $product->id }}"><i class="far fa-shopping-bag"></i></a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product list end -->




    <!-- brand area -->
    <div class="brand-area pt-80" style="margin-bottom: 8rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading-inline">
                        <h2 class="site-title">Popular Stores</h2>
                        <a href="{{ route('stores') }}">All Stores <i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="brand-slider owl-carousel owl-theme">
                @foreach ($stores as $store)
                <div class="brand-item">
                    <img src="assets/img/brand/01.png" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- brand area end -->







</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check if the popup has already been shown in this session
        if (!sessionStorage.getItem('popupShown')) {
    setTimeout(function () {
        var popupModal = document.getElementById('popup-banner');
        if (popupModal) {
            var modal = new bootstrap.Modal(popupModal);
            modal.show();
            sessionStorage.setItem('popupShown', 'true');
        }
    }, 1500);
}
    });
</script>

@endsection