@extends('website::layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url("{{ asset('assets/img/breadcrumb/01.jpg') }}")></div>
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
                    <div class="simple-slider">
                        <div class="slider-container">
                            @if (is_array($product->gallery) && !empty($product->gallery))
                                @foreach ($product->gallery as $image)
                                    <div class="slide">
                                        <img src="{{ asset($image) }}" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="slide">
                                    <img src="{{ asset($product->image ?? 'assets/img/product/01.png') }}" alt="{{ $product->name }}">
                                </div>
                            @endif
                        </div>
                        <button class="slider-prev">❮</button>
                        <button class="slider-next">❯</button>
                    </div>
                </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xxl-6">
                    <div class="shop-single-info">
                        <h4 class="shop-single-title">{{ $product->name }}</h4>
                        <div class="shop-single-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="{{ $product->average_rating >= $i ? 'fas fa-star' : ($product->average_rating >= $i - 0.5 ? 'fas fa-star-half-alt' : 'far fa-star') }}"></i>
                            @endfor
                            <span class="rating-count"> ({{ $product->reviews->count() }} Reviews)</span>
                        </div>
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
                                            <button type="button" class="minus-btn"><i class="fal fa-minus"></i></button>
                                            <input class="quantity" type="text" value="1" readonly>
                                            <button type="button" class="plus-btn"><i class="fal fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 col-lg-4 col-xl-3">
                                    <div class="shop-single-size">
                                        <h6>Size</h6>
                                        <select class="select">
                                            <option value="">Choose Size</option>
                                            @foreach ($product->options['sizes'] ?? [] as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
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
                                    <!-- Replace this in the shop-single-action section -->
                                    <div class="shop-single-btn d-flex">
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" class="hidden-quantity" value="1">
                                            <button type="submit" class="theme-btn"><span class="far fa-shopping-bag"></span> Add To Cart</button>
                                        </form>
                                        @auth
                                            @if (Auth::user()->wishlist()->where('product_id', $product->id)->exists())
                                                <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="theme-btn theme-btn2" data-tooltip="tooltip" title="Remove From Wishlist">
                                                        <span class="fas fa-heart"></span>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="theme-btn theme-btn2" data-tooltip="tooltip" title="Add To Wishlist">
                                                        <span class="far fa-heart"></span>
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="theme-btn theme-btn2" data-tooltip="tooltip" title="Login to Add to Wishlist"><span class="far fa-heart"></span></a>
                                        @endauth
                                        <!-- <a href="#" class="theme-btn theme-btn2" data-tooltip="tooltip" title="Add To Compare"><span class="far fa-arrows-repeat"></span></a> -->
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
                        <button class="nav-link" id="nav-tab3" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">Reviews ({{ $product->reviews->count() }})</button>
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
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="nav-tab3">
                        <div class="shop-single-review">
                            <div class="blog-comments">
                                <h5>Reviews ({{ $product->reviews->count() }})</h5>
                                <div class="blog-comments-wrap">
                                    @foreach ($product->reviews as $review)
                                        <div class="blog-comments-item {{ $loop->first ? 'mt-0' : '' }}">
                                            <!-- <img src="{{ asset('assets/img/blog/com-' . ($loop->iteration % 3 + 1) . '.jpg') }}" alt="thumb"> -->
                                            @if(Auth::user())
                                            <img src="{{ Auth::user()->image_url }}" alt="" id="profileImage" >
                                            @else
                                            <img src="{{ asset('assets/img/account').'/04.jpg' }}" alt="" id="profileImage" >
                                            @endif
                                            <div class="blog-comments-content">
                                                <h5>{{ $review->user->name }}</h5>
                                                <span><i class="far fa-clock"></i> {{ $review->created_at->format('F d, Y') }}</span>
                                                <p>{{ $review->comment }}</p>
                                                <div class="review-rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="{{ $review->rating >= $i ? 'fas fa-star' : 'far fa-star' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="blog-comments-form">
                                    <h4 class="mb-4">Leave A Review</h4>
                                    @if (auth()->check())

                                        @php
                                            $existingReview = $product->reviews->where('user_id', auth()->id())->first();
                                        @endphp
                                        @if ($existingReview)
                                            <div class="alert alert-info">
                                                You have already submitted a review for this product. Thank you for your feedback!
                                            </div>
                                        @else
                                            @if (session('success'))
                                                <div class="alert alert-success">{{ session('success') }}</div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger">{{ session('error') }}</div>
                                            @endif
                                             <!-- @if (session('success'))
                                                <div class="alert alert-success">{{ session('success') }}</div>
                                            @endif -->
                                            <form action="{{ route('products.reviews.store', $product->slug) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <select name="rating" class="form-control form-select" required>
                                                                <option value="">Your Rating</option>
                                                                <option value="5">5 Stars</option>
                                                                <option value="4">4 Stars</option>
                                                                <option value="3">3 Stars</option>
                                                                <option value="2">2 Stars</option>
                                                                <option value="1">1 Star</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="comment" class="form-control" rows="5" placeholder="Your Review"></textarea>
                                                        </div>
                                                        <button type="submit" class="theme-btn"><span class="far fa-paper-plane"></span> Submit Review</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    @else
                                        <p>Please <a href="{{ route('login') }}" class="theme-btn ">
                                            log in
                                        </a> to submit a review.</p>
                                    @endif
                                </div>
                            </div>
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
                                                <!-- Replace this in the product action section -->
                                                <div class="product-action">
                                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip" title="Quick View" class="quick-view-btn"><i class="far fa-eye"></i></a> -->
                                                    @auth
                                                        @if (Auth::user()->wishlist()->where('product_id', $related->id)->exists())
                                                            <form action="{{ route('wishlist.remove', $related->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0" data-tooltip="tooltip" title="Remove From Wishlist">
                                                                    <i class="fas fa-heart"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('wishlist.add', $related->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-link p-0" data-tooltip="tooltip" title="Add To Wishlist">
                                                                    <i class="far fa-heart"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('login') }}" data-tooltip="tooltip" title="Login to Add to Wishlist"><i class="far fa-heart"></i></a>
                                                    @endauth
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
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="product-cart-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                                        <i class="far fa-shopping-bag"></i>
                                                    </button>
                                            </form>
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

@section('scripts')
<script>
    // Add this to your JS file (e.g., resources/js/app.js) or in a <script> tag in your layout
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.querySelector('.slider-container');
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.querySelector('.slider-prev');
        const nextBtn = document.querySelector('.slider-next');
        let currentIndex = 0;
        const totalSlides = slides.length;

        if (totalSlides <= 1) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            return;
        }

        function updateSlider() {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        prevBtn.addEventListener('click', function () {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalSlides - 1;
            updateSlider();
        });

        nextBtn.addEventListener('click', function () {
            currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
            updateSlider();
        });
        setInterval(function () {
            currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
            updateSlider();
        }, 3000);

        // Quantity control functionality
    const minusBtn = document.querySelector('.minus-btn');
    const plusBtn = document.querySelector('.plus-btn');
    const quantityInput = document.querySelector('.quantity');
    const hiddenQuantityInput = document.querySelector('.hidden-quantity');

    if (minusBtn && plusBtn && quantityInput && hiddenQuantityInput) {
        // Initialize with default value
        let quantity = 1;
        quantityInput.value = quantity;
        hiddenQuantityInput.value = quantity;

        // Decrease quantity
        minusBtn.addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                updateQuantity();
            }
        });

        // Increase quantity
        plusBtn.addEventListener('click', function() {
            quantity++;
            updateQuantity();
        });

        // Update both visible and hidden inputs
        function updateQuantity() {
            quantityInput.value = quantity;
            hiddenQuantityInput.value = quantity;
        }
    }
    });
</script>
@endsection
