@extends('website::layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Shop Grid One</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Shop Grid One</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- shop-area -->
    <div class="shop-area bg py-90">
        <div class="container">
            <!-- Unified Filters Form -->
            <form id="filters-form" action="{{ route('products') }}" method="GET">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="shop-sidebar">
                            <!-- Search Widget -->
                            <div class="shop-widget">
                                <div class="shop-search-form">
                                    <h4 class="shop-widget-title">Search</h4>
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                        <button type="submit"><i class="far fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Widget -->
                            <div class="shop-widget">
                                <h4 class="shop-widget-title">Category</h4>
                                <ul class="shop-category-list">
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('products') }}?category={{ $category->slug }}">
                                                {{ $category->name }}<span>({{ $category->products->count() }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Price Range Widget -->
                            <!-- <div class="shop-widget">
                                <h4 class="shop-widget-title">Price Range</h4>
                                <div class="price-range-box">
                                    <div class="price-range-input">
                                        <input type="text" id="price-amount" readonly value="${{ request('price_min', 0) }} - ${{ request('price_max', 1000) }}">
                                    </div>
                                    <div class="price-range"></div>
                                </div>
                                <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min', 0) }}">
                                <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max', 1000) }}">
                            </div> -->

                            <!-- Sales Widget -->
                            <div class="shop-widget">
                                <h4 class="shop-widget-title">Sales</h4>
                                <ul class="shop-checkbox-list">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sale1" name="on_sale" value="1"
                                                {{ request('on_sale') ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="sale1">On Sale</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sale2" name="in_stock" value="1"
                                                {{ request('in_stock') ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="sale2">In Stock</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sale3" name="out_of_stock" value="1"
                                                {{ request('out_of_stock') ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="sale3">Out Of Stock</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sale4" name="discount" value="1"
                                                {{ request('discount') ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="sale4">Discount</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Ratings Widget -->
                            <div class="shop-widget">
                                <h4 class="shop-widget-title">Ratings</h4>
                                <ul class="shop-checkbox-list rating">
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rate1" name="rating[]" value="5"
                                                {{ in_array(5, request('rating', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="rate1">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rate2" name="rating[]" value="4"
                                                {{ in_array(4, request('rating', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="rate2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rate3" name="rating[]" value="3"
                                                {{ in_array(3, request('rating', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="rate3">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rate4" name="rating[]" value="2"
                                                {{ in_array(2, request('rating', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="rate4">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rate5" name="rating[]" value="1"
                                                {{ in_array(1, request('rating', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="form-check-label" for="rate5">
                                                <i class="fas fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                                <i class="fal fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="col-md-12">
                            <div class="shop-sort">
                                <div class="shop-sort-box">
                                    <div class="shop-sorty-label">Sort By:</div>
                                    <select class="select" onchange="location = this.value;">
                                        <option value="{{ route('products') }}">Default Sorting</option>
                                        <option value="{{ route('products', ['sort' => 'latest']) }}">Latest Items</option>
                                        <option value="{{ route('products', ['sort' => 'price_low']) }}">Price - Low To High</option>
                                        <option value="{{ route('products', ['sort' => 'price_high']) }}">Price - High To Low</option>
                                    </select>
                                    <div class="shop-sort-show">
                                        Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} Results
                                    </div>
                                </div>
                                <div class="shop-sort-gl">
                                    <a href="{{ route('products') }}" class="shop-sort-grid active"><i class="far fa-grid-round-2"></i></a>
                                    <a href="#" class="shop-sort-list"><i class="far fa-list-ul"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="shop-item-wrap item-4">
                            <div class="row g-4">
                                @forelse($products as $product)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="product-item" data-product-id="{{ $product->id }}">
                                            <div class="product-img">
                                                @if($product->is_new)
                                                    <span class="type new">New</span>
                                                @elseif($product->discount)
                                                    <span class="type discount">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                                                @elseif($product->stock == 0)
                                                    <span class="type oos">Out Of Stock</span>
                                                @endif
                                                <a href="{{ route('product.show', $product->slug) }}">
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                                </a>
                                                <div class="product-action-wrap">
                                                    <div class="product-action">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-tooltip="tooltip" title="Quick View" class="quick-view-btn"><i class="far fa-eye"></i></a>
                                                        <a href="#" data-tooltip="tooltip" title="Add To Wishlist"><i class="far fa-heart"></i></a>
                                                        <!-- <a href="#" data-tooltip="tooltip" title="Add To Compare"><i class="far fa-arrows-repeat"></i></a> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3 class="product-title">
                                                    <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                                </h3>
                                                <div class="product-rate">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= floor($product->rating))
                                                            <i class="fas fa-star"></i>
                                                        @elseif($i - 0.5 <= $product->rating)
                                                            <i class="fas fa-star-half-alt"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="product-bottom">
                                                    <div class="product-price">
                                                        @if($product->discount)
                                                            <del>${{ number_format($product->price, 2) }}</del>
                                                            <span>${{ number_format($product->price - $product->discount, 2) }}</span>
                                                        @else
                                                            <span>${{ number_format($product->price, 2) }}</span>
                                                        @endif
                                                    </div>
                                                    <button type="button" class="product-cart-btn" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                                        <i class="far fa-shopping-bag"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No products found.</p>
                                @endforelse
                            </div>
                        </div>
                        <!-- Pagination -->
                        <div class="pagination-area mt-50">
                            <div class="pagination">
                                @if ($products->onFirstPage())
                                    <span class="disabled">Previous</span>
                                @else
                                    <a href="{{ $products->previousPageUrl() }}">Previous</a>
                                @endif
                                <span class="page-indicator">
                                    {{ $products->currentPage() }} : {{ $products->lastPage() }} : {{ $products->total() }}
                                </span>
                                @if ($products->hasMorePages())
                                    <a href="{{ $products->nextPageUrl() }}">Next</a>
                                @else
                                    <span class="disabled">Next</span>
                                @endif
                            </div>
                            <div class="entries-count">
                                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- shop-area end -->
@endsection

@section('scripts')
    <!-- <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/quickview.js') }}"></script> -->

@endsection
