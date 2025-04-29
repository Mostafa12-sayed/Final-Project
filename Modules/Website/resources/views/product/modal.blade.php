<div id="website-table-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
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
                <li>Brand: <span>{{ $product->brand ?? 'N/A' }}</span></li>
                <li>Category: <span>{{ $product->category->name ?? 'N/A' }}</span></li>
                <li>Stock: <span class="stock">{{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}</span></li>
                <li>Code: <span>{{ $product->sku ?? 'N/A' }}</span></li>
              </ul>
              <div class="quickview-cart">
                <a href="{{ route('cart.add', $product->id) }}" class="theme-btn">Add to cart</a>
              </div>
              <!-- Optional social links -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
