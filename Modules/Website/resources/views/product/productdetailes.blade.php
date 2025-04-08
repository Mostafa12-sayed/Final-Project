@extends('website::layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url('{{ asset('assets/img/breadcrumb/01.jpg') }}')"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">{{ $product->name }}</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">{{ $product->name }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- shop single -->
    <div class="shop-single py-90">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-6 col-xxl-5">
                    <div class="shop-single-gallery">
                        @if ($product->video_url ?? false)
                            <a class="shop-single-video popup-youtube" href="{{ $product->video_url }}" data-tooltip="tooltip" title="Watch Video">
                                <i class="far fa-play"></i>
                            </a>
                        @endif
                        <div class="flexslider-thumbnails">
                            <ul class="slides">
                                @if (is_array($product->gallery) && !empty($product->gallery))
                                    @foreach ($product->gallery as $image)
                                        <li data-thumb="{{ asset($image) }}">
                                            <img src="{{ asset($image) }}" alt="{{ $product->name }}">
                                        </li>
                                    @endforeach
                                @else
                                    <li data-thumb="{{ asset($product->image ?? 'assets/img/product/01.png') }}">
                                        <img src="{{ asset($product->image ?? 'assets/img/product/01.png') }}" alt="{{ $product->name }}">
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xxl-6">
                    <div class="shop-single-info">
                        <h4 class="shop-single-title">{{ $product->name }}</h4>
                        <div class="shop-single-price">
                            @if ($product->discount)
                                <del>${{ number_format($product->price, 2) }}</del>
                                <span class="amount">${{ number_format($product->price - $product->discount, 2) }}</span>
                                <span class="discount-percentage">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                            @else
                                <span class="amount">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        <p class="mb-3">{{ $product->description }}</p>
                        <div class="shop-single-cs">
                            <div class="row">
                                <div class="col-md-3 col-lg-4 col-xl-3">
                                    <div class="shop-single-size">
                                        <h6>Quantity</h6>
                                        <div class="shop-cart-qty">
                                            <button class="minus-btn"><i class="fal fa-minus"></i></button>
                                            <input class="quantity" type="text" value="1" disabled="">
                                            <button class="plus-btn"><i class="fal fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-4 col-xl-3">
                                    <div class="shop-single-size">
                                        <h6>Size</h6>
                                        <select class="select">
                                            <option value="">Choose Size</option>
                                            @foreach ($product->options['sizes'] ?? [] as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="shop-single-sortinfo">
                            <ul>
                                <li>Stock: <span>{{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}</span></li>
                                <li>SKU: <span>{{ $product->code }}</span></li>
                                <li>Category: <span>{{ $product->category->name }}</span></li>
                                <li>Brand: <a href="#">{{ $product->brand }}</a></li>

                            </ul>
                        </div>
                        <div class="shop-single-action">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="shop-single-btn">
                                        <a href="#" class="theme-btn"><span class="far fa-shopping-bag"></span>Add To Cart</a>
                                        <a href="#" class="theme-btn theme-btn2" data-tooltip="tooltip" title="Add To Wishlist"><span class="far fa-heart"></span></a>
                                        <a href="#" class="theme-btn theme-btn2" data-tooltip="tooltip" title="Add To Compare"><span class="far fa-arrows-repeat"></span></a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="shop-single-share">
                                        <span>Share:</span>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-x-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- shop single details -->
            <div class="shop-single-details">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">Description</button>
                        <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Additional Info</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-tab1">
                        <div class="shop-single-desc">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-tab2">
                        <div class="shop-single-additional">
                            <p>Additional information about the product can be added here.</p>
                            <!-- Add dynamic additional info if available in the model -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- shop single details end -->

            <!-- related item -->
            <div class="product-area related-item pt-40">
                <div class="container px-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="site-heading-inline">
                                <h2 class="site-title">Related Items</h2>
                                <a href="{{ route('products') }}">View More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 item-2">
                        @foreach ($relatedProducts as $related)
                            <div class="col-md-6 col-lg-3">
                                <div class="product-item">
                                    <div class="product-img">
                                        @if ($related->is_new)
                                            <span class="type new">New</span>
                                        @elseif ($related->discount)
                                            <span class="type discount">{{ round(($related->discount / $related->price) * 100) }}% Off</span>
                                        @elseif ($related->stock == 0)
                                            <span class="type oos">Out Of Stock</span>
                                        @endif
                                        <a href="{{ route('product.show', $related->slug) }}">
                                            <img src="{{ asset($related->image ?? 'assets/img/product/01.png') }}" alt="{{ $related->name }}">
                                        </a>
                                        <div class="product-action-wrap">
                                            <div class="product-action">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a>
                                                <a href="#" data-tooltip="tooltip" title="Add To Wishlist"><i class="far fa-heart"></i></a>
                                                <a href="#" data-tooltip="tooltip" title="Add To Compare"><i class="far fa-arrows-repeat"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="product-title"><a href="{{ route('product.show', $related->slug) }}">{{ $related->name }}</a></h3>
                                        <div class="product-bottom">
                                            <div class="product-price">
                                                @if ($related->discount)
                                                    <del>${{ number_format($related->price, 2) }}</del>
                                                    <span>${{ number_format($related->price - $related->discount, 2) }}</span>
                                                @else
                                                    <span>${{ number_format($related->price, 2) }}</span>
                                                @endif
                                            </div>
                                            <button type="button" class="product-cart-btn" data-tooltip="tooltip" title="Add To Cart">
                                                <i class="far fa-shopping-bag"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- related item end -->
        </div>
    </div>
    <!-- shop single end -->
@endsection
