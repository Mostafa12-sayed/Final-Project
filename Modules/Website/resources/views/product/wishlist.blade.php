@extends('website::layouts.userDashboard')

@section('main-content')
    <div class="user-wrapper col-9">
        <div class="row">
            <div class="col-lg-12">
                <div class="user-card">
                    <h4 class="user-card-title">My Wishlist</h4>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if ($wishlistItems->isEmpty())
                        <p class="mt-20">Your wishlist is empty.</p>
                    @else
                        <div class="row g-4 mt-20 item-2">
                            @foreach ($wishlistItems as $item)
                                <div class="col-md-6 col-lg-4">
                                    <div class="product-item">
                                        <div class="product-img">
                                            @if ($item->product->is_new)
                                                <span class="type new">New</span>
                                            @elseif ($item->product->discount)
                                                <span class="type discount">{{ round(($item->product->discount / $item->product->price) * 100) }}% Off</span>
                                            @elseif ($item->product->stock == 0)
                                                <span class="type oos">Out Of Stock</span>
                                            @endif
                                            <a href="{{ route('product.show', $item->product->slug) }}">
                                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}">
                                            </a>
                                            <div class="product-action-wrap">
                                                <div class="product-action">
                                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#quickview" data-bs-placement="top" data-tooltip="tooltip" title="Quick View"><i class="far fa-eye"></i></a> -->
                                                    <!-- <a href="#" data-bs-placement="top" data-tooltip="tooltip" title="Add To Compare"><i class="far fa-arrows-repeat"></i></a> -->
                                                    <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link p-0" data-bs-placement="top" data-tooltip="tooltip" title="Remove From Wishlist">
                                                            <i class="far fa-xmark"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="product-title">
                                                <a href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                            </h3>
                                            <div class="product-rate">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($item->product->rating))
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($i - 0.5 <= $item->product->rating)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="product-bottom">
                                                <div class="product-price">
                                                    @if ($item->product->discount)
                                                        <del>${{ number_format($item->product->price, 2) }}</del>
                                                        <span>${{ number_format($item->product->price - $item->product->discount, 2) }}</span>
                                                    @else
                                                        <span>${{ number_format($item->product->price, 2) }}</span>
                                                    @endif
                                                </div>
                                                <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="d-inline">
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
