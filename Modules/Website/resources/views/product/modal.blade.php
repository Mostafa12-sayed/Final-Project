<div id="website-table-modal" class="modal fade quickview" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="far fa-xmark"></i>
            </button>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-lg-6 col-md-12">
                        <div class="quickview-img">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid">
                            @if ($product->discount)
                                <div class="product-badge">
                                    <span class="badge bg-danger">{{ round(($product->discount / $product->price) * 100) }}% OFF</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="quickview-content ps-lg-4">
                            <h3 class="quickview-title mb-2">{{ $product->name }}</h3>
                            <div class="quickview-rating mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $product->rating ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                                <span class="rating-count ms-2">({{ $product->reviews_count ?? 0 }} Reviews)</span>
                            </div>
                            <div class="quickview-price mb-4">
                                @if ($product->discount)
                                    <h4 class="d-flex align-items-center">
                                        <del class="text-muted me-2">${{ number_format($product->price, 2) }}</del>
                                        <span class="text-danger">${{ number_format($product->discountedprice, 2) }}</span>
                                    </h4>
                                @else
                                    <h4>${{ number_format($product->price, 2) }}</h4>
                                @endif
                            </div>

                            @if ($product->description)
                                <div class="product-description mb-4">
                                    <p>{{ \Illuminate\Support\Str::limit($product->description, 150) }}</p>
                                </div>
                            @endif

                            <div class="product-meta mb-4">
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex mb-2">
                                        <strong class="me-2">Brand:</strong>
                                        <span>{{ $product->store->name ?? 'N/A' }}</span>
                                    </li>
                                    <li class="d-flex mb-2">
                                        <strong class="me-2">Category:</strong>
                                        <span>{{ $product->category->name ?? 'N/A' }}</span>
                                    </li>
                                    <li class="d-flex">
                                        <strong class="me-2">Availability:</strong>
                                        <span class="stock {{ $product->stock > 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-actions">
                                <div class="d-flex align-items-center">
                                    <div class="quantity-selector me-3">
                                        <div class="shop-cart-qty">
                                            <button type="button" class="minus-btn"><i class="fal fa-minus"></i></button>
                                            <input class="quantity" type="text" value="1" readonly>
                                            <button type="button" class="plus-btn"><i class="fal fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <button type="button" class="theme-btn add-to-cart" data-product-id="{{ $product->id }}">
                                        <i class="far fa-shopping-bag me-2"></i> Add To Cart
                                    </button>
                                </div>
                            </div>

                            <div class="product-share mt-4">
                                <div class="d-flex align-items-center">
                                    <span class="me-3">Share:</span>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle quantity buttons
        $('.minus-btn').on('click', function() {
            var $input = $(this).closest('.shop-cart-qty').find('.quantity');
            var currentValue = parseInt($input.val());
            if (currentValue > 1) {
                $input.val(currentValue - 1);
            }
        });

        $('.plus-btn').on('click', function() {
            var $input = $(this).closest('.shop-cart-qty').find('.quantity');
            var currentValue = parseInt($input.val());
            $input.val(currentValue + 1);
        });

        // Handle Add to Cart button click
        $('.add-to-cart').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var productId = button.data('product-id');
            var quantity = parseInt($('.quantity').val());

            // Disable button and show loading state
            button.prop('disabled', true);
            button.html('<i class="fas fa-spinner fa-spin me-2"></i> Adding...');

            $.ajax({
                url: '{{ route("cart.add_ajax", ["product" => ":productId"]) }}'.replace(':productId', productId),
                method: 'POST',
                data: {
                    quantity: quantity
                },
                success: function(response) {
                    // Reset button state
                    button.prop('disabled', false);
                    button.html('<i class="far fa-shopping-bag me-2"></i> Add To Cart');

                    // Show success message
                    if (response.success) {
                        // Update cart count in header
                        if (response.cart_count !== undefined) {
                            $('.cart_count')
                                .attr('data-count', response.cart_count)
                                .find('span')
                                .text(response.cart_count);
                        } else {
                            // Fallback: increment client-side
                            var cartCountElement = $('.cart_count');
                            var currentCount = parseInt(cartCountElement.data('count')) || 0;
                            cartCountElement
                                .attr('data-count', currentCount + 1)
                                .find('span')
                                .text(currentCount + 1);
                        }

                        // Show toast notification if available
                        var toastEl = document.getElementById('add_to_cart_toast');
                        if (toastEl) {
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }

                        // Close modal after short delay
                        setTimeout(function() {
                            $('#website-table-modal').modal('hide');
                        }, 1500);
                    }
                },
                error: function(xhr) {
                    // Reset button state
                    button.prop('disabled', false);
                    button.html('<i class="far fa-shopping-bag me-2"></i> Add To Cart');

                    // Show error message
                    var errorMsg = 'An error occurred while adding to cart.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }

                    alert(errorMsg);
                }
            });
        });
    });
</script>
