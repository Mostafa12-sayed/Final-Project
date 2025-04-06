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
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <!-- Sidebar content can be made dynamic if needed -->
                        <div class="shop-widget">
                            <div class="shop-search-form">
                                <h4 class="shop-widget-title">Search</h4>
                                <form action="{{ route('products') }}" method="GET">
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                        <button type="submit"><i class="far fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Add more sidebar widgets (e.g., categories, brands) as needed -->
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
                                <div class="shop-sort-show">Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} Results</div>
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
                                    <div class="product-item">
                                        <div class="product-img">
                                            @if($product->is_new)
                                                <span class="type new">New</span>
                                            @elseif($product->discount)
                                                <span class="type discount">{{ round(($product->discount / $product->price) * 100) }}% Off</span>
                                            @elseif($product->stock == 0)
                                                <span class="type oos">Out Of Stock</span>
                                            @endif
                                            <a href="{{ route('product.show', $product->slug) }}">
                                                <img src="{{ asset($product->gallery[0] ?? 'assets/img/product/01.png') }}" alt="{{ $product->name }}">
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
                                            <h3 class="product-title"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>
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
                    <!-- pagination -->
                    <div class="pagination-area mt-50">
                        {{ $products->links() }}
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </div>
    <!-- shop-area end -->
@endsection

