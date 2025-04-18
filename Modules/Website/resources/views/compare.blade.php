@extends('website::layouts.master')

@section('content')

        <!-- breadcrumb -->
        <div class="site-breadcrumb">
            <div class="site-breadcrumb-bg" style="background: url(assets/img/breadcrumb/01.jpg)"></div>
            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">Shop Compare</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{ route('home') }}"><i class="far fa-home"></i> Home</a></li>
                        <li class="active">Shop Compare</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- breadcrumb end -->

@if(empty($products) || count($products) == 0)
    <div class="container mt-5 mb-5">
        <div class="alert alert-info text-center">
            <h4>No products to compare</h4>
            <p>Please go back and select products to compare.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
            <a href="{{ route('products') }}" class="btn btn-outline-primary">Browse Products</a>
        </div>
    </div>
@else
<div class="table-responsive container mt-4 mb-4">
    <table class="table table-bordered comparison-table">
        <thead>
            <tr>
                <th>Product</th>
                @foreach($products as $product)
                <th class="product-column">
                    <div class="product-header">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid product-thumbnail">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <button class="btn btn-sm btn-danger remove-compare" data-product-id="{{ $product->id }}">
                            <i class="fas fa-times"></i> Remove
                        </button>
                    </div>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- Name -->
            <tr>
                <td class="attribute-name">Name</td>
                @foreach($products as $product)
                <td>{{ $product->name }}</td>
                @endforeach
            </tr>
            
            <!-- Description -->
            <tr>
                <td class="attribute-name">Description</td>
                @foreach($products as $product)
                <td class="small-text">{{ Str::limit($product->description, 150) }}</td>
                @endforeach
            </tr>
            
            <!-- Brand -->
            <tr>
                <td class="attribute-name">Brand</td>
                @foreach($products as $product)
                <td>{{ $product->brand ?? 'N/A' }}</td>
                @endforeach
            </tr>
            
            <!-- Weight -->
            <tr>
                <td class="attribute-name">Weight</td>
                @foreach($products as $product)
                <td>{{ $product->weight ? $product->weight . ' kg' : 'N/A' }}</td>
                @endforeach
            </tr>
            
            <!-- Price -->
            <tr>
                <td class="attribute-name">Price</td>
                @foreach($products as $product)
                <td>
                    @if($product->discount)
                        <span class="text-danger"><del>${{ number_format($product->price, 2) }}</del></span>
                        <br>
                        <span class="text-success">${{ number_format($product->price - $product->discount, 2) }}</span>
                    @else
                        ${{ number_format($product->price, 2) }}
                    @endif
                </td>
                @endforeach
            </tr>
            
            <!-- Discount -->
            <tr>
                <td class="attribute-name">Discount</td>
                @foreach($products as $product)
                <td>
                    @if($product->discount)
                        ${{ number_format($product->discount, 2) }} ({{ round(($product->discount/$product->price)*100) }}%)
                    @else
                        No discount
                    @endif
                </td>
                @endforeach
            </tr>
            
            <!-- Gallery -->
            <tr>
    <td class="attribute-name">Gallery</td>
    @foreach($products as $product)
    <td>
        @php
            // Handle both array and JSON string cases
            $galleryImages = [];
            if (is_array($product->gallery)) {
                $galleryImages = $product->gallery;
            } elseif (is_string($product->gallery)) {
                $galleryImages = json_decode($product->gallery, true) ?: [];
            }
        @endphp
        
        @if(!empty($galleryImages))
            <div class="product-gallery">
                @foreach(array_slice($galleryImages, 0, 3) as $image)
                    <img src="{{ asset($image) }}" class="img-thumbnail gallery-thumb" alt="Gallery image">
                @endforeach
            </div>
        @else
            No gallery images
        @endif
    </td>
    @endforeach
</tr>
            
            <!-- Is New -->
            <tr>
                <td class="attribute-name">New Arrival</td>
                @foreach($products as $product)
                <td>
                    @if($product->is_new)
                        <span class="badge bg-success">Yes</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </td>
                @endforeach
            </tr>
            
            <!-- Image -->
            <tr>
                <td class="attribute-name">Main Image</td>
                @foreach($products as $product)
                <td>
                    <img src="{{ asset($product->image) }}" class="img-thumbnail main-image" alt="Main product image">
                </td>
                @endforeach
            </tr>
            
            <!-- Rating -->
            <tr>
                <td class="attribute-name">Rating</td>
                @foreach($products as $product)
                <td>
                    <div class="product-rating">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= $product->rating ? 'fas' : 'far' }} fa-star"></i>
                        @endfor
                        <span class="rating-value">({{ $product->rating }}/5)</span>
                    </div>
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@endif

@endsection

@section('scripts')
@if(!empty($products) && count($products) > 0)
<script>
    // Remove from compare
    $('.remove-compare').on('click', function() {
        var productId = $(this).data('product-id');
        
        $.ajax({
            url: '/compare/remove/' + productId,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    location.reload(); // Refresh page to update comparison
                }
            }
        });
    });
</script>
@endif
@endsection

<style>
    .comparison-table {
        font-size: 14px;
    }
    .attribute-name {
        font-weight: 600;
        background-color: #f8f9fa;
        width: 200px;
    }
    .product-thumbnail {
        max-height: 120px;
        margin-bottom: 10px;
    }
    .product-title {
        font-size: 16px;
        margin-bottom: 10px;
    }
    .product-column {
        min-width: 250px;
        vertical-align: top;
    }
    .product-gallery {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }
    .gallery-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
    }
    .main-image {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }
    .small-text {
        font-size: 13px;
    }
    .product-rating {
        color: #ffc107;
    }
    .rating-value {
        color: #6c757d;
        font-size: 12px;
    }
</style>
