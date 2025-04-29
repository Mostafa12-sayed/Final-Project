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
                <!-- Sidebar with Filters Form -->
                <div class="col-lg-3">
                    <form id="filters-form" action="{{ route('products') }}" method="GET">
                        <div class="shop-sidebar">
                            <!-- Search Widget -->
                            <div class="shop-widget row">
                                <div class="shop-search-form col-12">
                                    <h4 class="shop-widget-title">Search</h4>
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                        <button type="submit"><i class="far fa-search"></i></button>
                                    </div>
                                </div>

                                <div class="col-12 m-2">
                                    <button class="btn" style="width: 90%; background-color: #03a297; color: aliceblue;"> <a href="{{ route('products') }}" style="width: 100%; color: aliceblue;">Reset</a></button>
                                </div>
                            </div>

                            <!-- Category Widget (outside form since it’s links) -->
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
                                    <!-- Other rating options remain the same -->
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
                    </form>
                </div>

                <!-- Product List (outside the filters form) -->
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
                            <!-- <div class="shop-sort-gl">
                                <a href="{{ route('products') }}" class="shop-sort-grid active"><i class="far fa-grid-round-2"></i></a>
                            </div> -->
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
                                                <img src="{{asset( $product->image) }}" alt="{{ $product->name }}">
                                            </a>
                                            <div class="product-action-wrap">
                                                <!-- Replace this in the product action section -->
                                                <div class="product-action">
{{--                                                     <button data-href="{{route('product.modal', ['product'=> $product->id])}}" data-container="#website-table-modal" data-bs-toggle="modal"   class=" btn-modal"><i class="far fa-eye"></i></button>--}}
                                                    <a data-href="{{route('product.modal', ['product'=> $product->id])}}" data-container="#website-table-modal" class="btn-modal"><i class="far fa-eye"></i></a>

                                                    @auth
                                                        @if (Auth::user()->wishlist()->where('product_id', $product->id)->exists())
                                                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link p-0" data-tooltip="tooltip" title="Remove From Wishlist">
                                                                    <i class="fas fa-heart"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-link p-0" data-tooltip="tooltip" title="Add To Wishlist">
                                                                    <i class="far fa-heart"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('login') }}" data-tooltip="tooltip" title="Login to Add to Wishlist"><i class="far fa-heart"></i></a>
                                                    @endauth
                                                    <a href="{{ route('compare.index') }}" class="add-to-compare"
                                                            data-product-id="{{ $product->id }}"
                                                            data-bs-placement="top"
                                                            data-tooltip="tooltip"
                                                            title="Add To Compare">
                                                            <i class="fas fa-exchange-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="product-title">
                                                <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                            </h3>
                                            <div class="product-rate">
                                                <!-- @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= floor($product->rating))
                                                        <i class="fas fa-star"></i>
                                                    @elseif($i - 0.5 <= $product->rating)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor -->
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="{{ $product->average_rating >= $i ? 'fas fa-star' : ($product->average_rating >= $i - 0.5 ? 'fas fa-star-half-alt' : 'far fa-star') }}"></i>
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
                            @empty
                                <p>No products found.</p>
                            @endforelse
                        </div>
                    </div>
                    <!-- pagination -->
                    <div class="pagination-area mt-50">
                        <div aria-label="Page navigation example">
                            {{ $products->links('website::layouts.custom-pagination') }}
                        </div>
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </div>


    <!-- shop-area end -->
@endsection

