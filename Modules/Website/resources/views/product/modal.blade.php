<div id="website-table-modal" class="modal fade" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="far fa-xmark"></i>
            </button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="quickview-img">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="quickview-content">
                            <h4 class="quickview-title">{{ $product->name }}</h4>
                            <div class="quickview-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $product->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                    <span class="rating-count"> ({{ $product->reviews_count ?? 0 }} Reviews)</span>
                            </div>
                            <div class="quickview-price">
                                <h5>
                                    @if ($product->discount)
                                    <del>${{ number_format($product->price, 2) }}</del>
                                    <span>${{ number_format($product->discountedprice, 2) }}</span>
                                    @else
                                    <span>${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </h5>
                            </div>
                            <ul class="quickview-list">
                                <li>Brand: <span>{{ $product->store->name ?? 'N/A'  }}</span></li>
                                <li>Category: <span>{{ $product->category->name ?? 'N/A' }}</span></li>
                                <li>Stock: <span class="stock">{{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}</span></li>
                            </ul>
                            <div class="quickview-cart">
                                <button type="button" class="product-cart-btn add-to-cart" data-product-id="{{ $product->id }}" data-bs-placement="left" data-tooltip="tooltip" title="Add To Cart">
                                    <i class="far fa-shopping-bag"></i>
                                </button>
                                <span> Add To Cart </span>
                            </div>
                            <!-- Optional social links -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Handle Add to Cart button click
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var productId = button.data('product-id');

        // Disable button to prevent multiple clicks
        button.prop('disabled', true);

        $.ajax({
            url: '{{ route("cart.add_ajax", ["product" => ":productId"]) }}'.replace(':productId', productId), // Dynamically replace the placeholder
            method: 'POST',
            data: {
                quantity: 1 // You can still send quantity in the body if needed
            },
            success: function(response) {

                // Re-enable button
                button.prop('disabled', false);

                // Show success message
                if (response.success) {
                    // alert('Product added to cart successfully!');
                }
                //  else {
                //     alert('Failed to add product to cart: ' + (response.message || 'Unknown error'));
                // }
                var toastEl = document.getElementById('add_to_cart_toast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
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
            },
            error: function(xhr) {
                // Re-enable button
                button.prop('disabled', false);

                // Show error message
                var errorMsg = 'An error occurred while adding to cart.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
            }
        });
    });
</script>
