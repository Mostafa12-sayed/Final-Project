@php
    $title = 'Product Details - ' . $product->name;
@endphp
<style>
    .modal-content{
        overflow-y: auto;
        max-height: 600px; /* or any desired height */
        overflow-x: hidden;
        }
</style>

<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $title }}
            </h5>
        </div>
        <div class="modal-body p-0">
            <div class="row p-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name: <strong>{{ $product->name }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category: <strong>{{ $product->category->name ?? 'N/A' }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price: <strong>${{ number_format($product->price, 2) }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tex: <strong>{{ $product->tax }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stock: <strong>{{ $product->stock }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount: <strong>{{ $product->discount }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discount: <strong>Main Image</strong></label>
                        <div class="d-flex flex-wrap gap-2">
                        <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail" style="width: 80px; height: 80px;">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Store Name: <strong>{{ optional($product->store)->name }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Created At: <strong>{{ $product->created_at->format('d-m-Y') }}</strong></label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <div class="form-control" style="height: 100px; overflow: auto;">{{ $product->description }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Images:</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($product->gallery as $image)
                                <img src="{{ asset($image) }}" alt="Product Image" class="img-thumbnail" style="width: 80px; height: 80px;">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <h2 >Reviews</h2>
                <div class="col-md-12">
                    <div class="mb-3">
                        @if($product->reviews->count()> 0)
                        @foreach ($product->reviews as $review)
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $review->user->name }}</h5>
                                    <p class="card-text">{{ $review->comment }}</p>
                                    <p class="card-text">Rating: {{ $review->rating }}</p>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <p class="text-center">No reviews yet.</p>
                        @endif
                    </div>
            </div>
            <div class="pt-4 d-flex justify-content-end gap-2 px-3 mb-3">
                <button type="button" class="btn btn-primary w-25" data-bs-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>

