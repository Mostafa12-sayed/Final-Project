@extends('website::layouts.master')

@section('content')
    <!-- breadcrumb -->
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">Shop Cart</h4>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                    <li class="active">Shop Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- shop cart -->
    <div class="shop-cart py-90">
        <div class="container">
            <div class="shop-cart-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        @if($cartItems->isEmpty())
                            <p>Your cart is empty.</p>
                            <div class="text-center mt-40">
                                <a href="{{ route('products') }}" class="theme-btn">Continue Shopping</a>
                            </div>
                        @else
                            <div class="cart-table">
                                <!-- Existing cart table content remains unchanged -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Sub Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $item)
                                                <tr data-product-id="{{ $item['product']->id }}">
                                                    <td>
                                                        <div class="shop-cart-img">
                                                            <a href="{{ route('product.show', $item['product']->slug) }}">
                                                                <img src="{{ asset($item['product']->image ?? 'assets/img/product/01.png') }}" alt="{{ $item['product']->name }}">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="shop-cart-content">
                                                            <h5 class="shop-cart-name">
                                                                <a href="{{ route('product.show', $item['product']->slug) }}">{{ $item['product']->name }}</a>
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="shop-cart-price">
                                                            <span>${{ number_format($item['finalPrice'], 2) }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="shop-cart-qty">
                                                            <button class="minus-btn" data-product-id="{{ $item['product']->id }}"><i class="fal fa-minus"></i></button>
                                                            <input class="quantity" type="text" value="{{ $item['quantity'] }}" disabled>
                                                            <button class="plus-btn" data-product-id="{{ $item['product']->id }}"><i class="fal fa-plus"></i></button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="shop-cart-subtotal">
                                                            <span>${{ number_format($item['itemTotal'], 2) }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="shop-cart-remove" data-product-id="{{ $item['product']->id }}"><i class="far fa-times"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="shop-cart-footer">
                                <div class="row">
                                    <div class="col-md-7 col-lg-6">
                                        <!-- Display applied coupon with remove option -->
                                        @if(session('coupon'))
                                            <p>Applied Coupon: {{ session('coupon') }}
                                                <a href="{{ route('cart.removeCoupon') }}" class="text-danger">Remove</a>
                                            </p>
                                        @endif
                                        <!-- Coupon application form -->
                                        <form action="{{ route('cart.applyCoupon') }}" method="POST">
                                            @csrf
                                            <div class="shop-cart-coupon">
                                                <div class="form-group">
                                                    <input type="text" name="coupon_code" class="form-control" placeholder="Your Coupon Code" required>
                                                    <button class="theme-btn" type="submit">Apply Coupon</button>
                                                </div>
                                                @error('coupon_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-5 col-lg-6">
                                        <div class="shop-cart-btn text-md-end">
                                            <a href="{{ route('products') }}" class="theme-btn"><span class="fas fa-arrow-left"></span> Continue Shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <div class="shop-cart-summary">
                            <h5>Cart Summary</h5>
                            <ul>
                                <li><strong>Sub Total:</strong> <span id="subtotal">${{ number_format($subtotal, 2) }}</span></li>
                                <li><strong>Discount:</strong> <span id="discount">${{ number_format($discount, 2) }}</span></li>
                                <li><strong>Shipping:</strong> <span id="shipping">Free</span></li>
                                <li><strong>Taxes:</strong> <span id="taxes">${{ number_format($taxes, 2) }}</span></li>
                                <li class="shop-cart-total"><strong>Total:</strong> <span id="total">${{ number_format($total, 2) }}</span></li>
                            </ul>
                            <div class="text-end mt-40">
                                <a href="{{ route('order.checkout') }}" class="theme-btn">Checkout Now<i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop cart end -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Minus button
            $('.minus-btn').off('click').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var $row = $(this).closest('tr');
                var $quantityInput = $row.find('.quantity');
                var currentQuantity = parseInt($quantityInput.val());
                if (currentQuantity > 1) {
                    updateQuantity(productId, currentQuantity - 1, $row);
                }
            });

            // Plus button
            $('.plus-btn').off('click').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var $row = $(this).closest('tr');
                var $quantityInput = $row.find('.quantity');
                var currentQuantity = parseInt($quantityInput.val());
                updateQuantity(productId, currentQuantity + 1, $row);
            });

            // Remove button
            $('.shop-cart-remove').off('click').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var $row = $(this).closest('tr');
                removeItem(productId, $row);
            });

            function updateQuantity(productId, quantity, $row) {
                $.ajax({
                    url: '{{ route("cart.update", ":id") }}'.replace(':id', productId),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.success) {
                            var $quantityInput = $row.find('.quantity');
                            var price = parseFloat($row.find('.shop-cart-price span').text().replace('$', ''));
                            $quantityInput.val(quantity);
                            $row.find('.shop-cart-subtotal span').text('$' + (price * quantity).toFixed(2));
                            updateSummary(response.cartData);
                        } else {
                            alert(response.message || 'Error updating quantity');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Error updating quantity: ' + xhr.statusText);
                    }
                });
            }

            function removeItem(productId, $row) {
                $.ajax({
                    url: '{{ route("cart.remove", ":id") }}'.replace(':id', productId),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $row.remove();
                            if ($('tbody tr').length === 0) {
                                $('.cart-table').replaceWith('<p>Your cart is empty.</p>');
                            }
                            updateSummary(response.cartData);
                        } else {
                            alert('Error removing item');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Error removing item: ' + xhr.statusText);
                    }
                });
            }

            function updateSummary(cartData) {
                $('#subtotal').text('$' + cartData.subtotal.toFixed(2));
                $('#discount').text('$' + cartData.discount.toFixed(2));
                $('#taxes').text('$' + cartData.taxes.toFixed(2));
                $('#total').text('$' + cartData.total.toFixed(2));
            }
        });
    </script>
@endsection
