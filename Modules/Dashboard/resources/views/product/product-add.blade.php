@extends('dashboard::layouts.master')
@section('title', 'Product Add')
@section('content')
     <div class="page-content">
          <div class="container-xxl">
               <div class="row">

                    <div class="col-xl-12 col-lg-12 ">
                         <form action="{{ $product->id ?  route('admin.products.update' , ['product' =>$product->id]): route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @if($product->id)
                                   @method('PUT')
                              @endif
                              <div class="row ">
                                   <div class="card col-md-6">
                                        <div class="card-header">
                                        <h4 class="card-title"> Main photo</h4>
                                        </div>

                                        <div class="card-body">
                                        <div class="image-upload-area text-center border p-4" style="cursor: pointer;" onclick="document.getElementById('main-image').click();">
                                             <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                             <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to browse</span></h3>
                                             <span class="text-muted fs-13">
                                                  1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                             </span>
                                             <input type="file" name="image" id="main-image" accept="image/png, image/jpeg, image/gif" style="display: none;" >
                                        </div>

                                        <div id="imagePreviewContainermain" class="row mt-3">
                                             @if(isset($product) && $product->image)
                                                  <div class="col-md-3 position-relative mb-3" id="oldImagePreview">
                                                       <img src="{{ asset( $product->image) }}" class="img-fluid rounded" style="max-height: 200px;">
{{--                                                       <button data-produc-id="{{ $product->id }}" data-image-path="{{ $product->image }}" type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" onclick="removeOldImage()">×</button>--}}
                                                  </div>
                                             @endif
                                        </div>
                                        </div>
                                        @if($errors->has('image'))
                                             <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                   </div>

                                   <div class="card col-md-6">
                                        <div class="card-header">
                                        <h4 class="card-title">Add Thumbnail Photo</h4>
                                        </div>

                                        <div class="card-body">
                                        <div class="image-upload-area text-center border p-4" style="cursor: pointer;" onclick="document.getElementById('gallary').click();">
                                             <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                             <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to browse</span></h3>
                                             <span class="text-muted fs-13">
                                                  1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                             </span>
                                             <input type="file" name="images[]" id="gallary" accept="image/png, image/jpeg, image/gif" style="display: none;" multiple>
                                        </div>

                                            <div id="imagePreviewContainerimages" class="row mt-3">
                                                @if(isset($product) && $product->gallery)
{{--                                                    @php--}}
{{--                                                        $images = json_decode($product->gallery, true); // فك تشفير JSON إلى مصفوفة--}}
{{--                                                    @endphp--}}
                                                    @foreach($product->gallery as $image)
                                                        <div class="col-md-3 position-relative mb-3" id="{{$image}}">
                                                            <img src="{{ asset( $image) }}" class="img-fluid rounded" style="max-height: 200px;">
                                                            <button data-product-id="{{ $product->id }}" data-image-path="{{ $image }}" type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 delete-image" >×</button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        @if($errors->has('images'))
                                             <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                   </div>
                              </div>
                         <div class="card">
                              <div class="card-header">
                                   <h4 class="card-title">Product Information</h4>
                              </div>
                              <div class="card-body">
                                   <div class="row">
                                        <div class="col-lg-6">

                                                  <div class="mb-3">
                                                       <label for="product-name" class="form-label">Product Name</label>
                                                       <input type="text" id="product-name" name="name" class="form-control" placeholder="Items Name" value="{{ old('name' , $product->name) }}">
                                                       @if($errors->has('name'))
                                                       <span class="text-danger">{{ $errors->first('name') }}</span>
                                                       @endif

                                                  </div>

                                        </div>
                                        <div class="col-lg-6">
                                                  <label for="product-categories" class="form-label">Product Categories</label>
                                                  <select class="form-control mb-0" name="category_id" id="product-categories" data-choices data-choices-groups data-placeholder="Select Categories">
                                                       <option value="" selected>Choose a categories</option>
                                                       @foreach ($categories as $category )
                                                       <option value="{{ $category->id }}"
                                                            @if($product->id)
                                                            {{ $product->category_id == $category->id  ? 'selected' : '' }}
                                                            @endif
                                                            >{{ $category->name }}</option>
                                                       @endforeach

                                                  </select>
                                                  @if($errors->has('category_id'))
                                                  <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                                  @endif

                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="product-brand" class="form-label">Brand</label>
                                                       <input type="text" name="brand" id="product-brand" class="form-control" placeholder="Brand Name" value="{{ old('brand',$product->brand) }}">
                                                  </div>
                                                  @if($errors->has('brand'))
                                                  <span class="text-danger">{{ $errors->first('brand') }}</span>
                                                  @endif
                                        </div>
                                        <div class="col-lg-6">

                                             <div class="mb-3">
                                                  <label for="product-weight" class="form-label">Weight</label>
                                                  <input type="text" name="weight" id="product-weight" class="form-control" placeholder="In gm & kg" value="{{ old('weight',$product->weight) }}">
                                                  @if($errors->has('weight'))
                                                  <span class="text-danger">{{ $errors->first('weight') }}</span>
                                                  @endif
                                             </div>

                                        </div>

                                   </div>

                                   <div class="row">
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="description" class="form-label">Description</label>
                                                  <textarea name="description" class="form-control bg-light-subtle" id="description" rows="7" placeholder="Short description about the product" > {{ old('description',$product->description) }}</textarea>
                                                  @if($errors->has('description'))
                                                  <span class="text-danger">{{ $errors->first('description') }}</span>
                                                  @endif
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-lg-6">

                                                  <div class="mb-3">
                                                       <label for="product-code" class="form-label">Code </label>
                                                       <input type="text" name="code" id="product-code" class="form-control" placeholder="Code" value="{{ old('code',$product->code) }}">
                                                       @if($errors->has('code'))
                                                       <span class="text-danger">{{ $errors->first('code') }}</span>
                                                       @endif
                                                  </div>


                                        </div>
                                        <div class="col-lg-6">

                                                  <div class="mb-3">
                                                       <label for="product-stock" class="form-label">Quantity</label>
                                                       <input type="number" name="quantity" id="product-stock" class="form-control" placeholder="Quantity" value="{{ old('stock',$product->stock) }}">
                                                       @if($errors->has('quantity'))
                                                       <span class="text-danger">{{ $errors->first('stock') }}</span>
                                                       @endif
                                                  </div>


                                        </div>

                                   </div>
                              </div>
                         </div>
                         <div class="card">
                              <div class="card-header">
                                   <h4 class="card-title">Pricing Details</h4>
                              </div>
                              <div class="card-body">
                                   <div class="row">
                                        <div class="col-lg-6">
                                                  <label for="product-price" class="form-label">Price</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                                       <input type="text" name="price" id="product-price" class="form-control" placeholder="000"  value="{{ old('price',$product->price) }}">
                                                  </div>
                                                  @if($errors->has('price'))
                                                  <span class="text-danger">{{ $errors->first('price') }}</span>
                                                  @endif

                                        </div>
                                       <div class="col-lg-6">

                                           <label for="product-tex" class="form-label">Tex</label>
                                           <div class="input-group mb-3">
                                               <span class="input-group-text fs-20"><i class='bx bxs-file-txt'></i></span>
                                               <input type="text" name="tax" id="product-tex" class="form-control" placeholder="000" value="{{ old('tax',$product->tax) }}">
                                           </div>
                                           @if($errors->has('tax'))
                                               <span class="text-danger">{{ $errors->first('tax') }}</span>
                                           @endif

                                       </div>
                                        <div class="col-lg-6">
                                                  <label for="product-discount" class="form-label">Discount</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                                       <input type="text" name="discount" value="{{ old('discount',$product->discount) }}" id="product-discount" class="form-control" placeholder="000">
                                                  </div>
                                                  @if($errors->has('discount'))
                                                  <span class="text-danger">{{ $errors->first('discount') }}</span>
                                                  @endif

                                        </div>
                                       <div class="col-lg-6">
                                           <label for="expiry_date" class="form-label">Expiry Date Discount</label>
                                           <div class="input-group mb-3">
                                               <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                               <input type="date" name="expiry_date" value="{{ old('expiry_date',$product->expiry_date) }}" id="expiry_date" class="form-control" placeholder="000">
                                           </div>
                                           @if($errors->has('expiry_date'))
                                               <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                                           @endif

                                       </div>

                                   </div>
                              </div>
                         </div>
                         <div class="p-3 bg-light mb-3 rounded">
                              <div class="row justify-content-end g-2">
                                   <div class="col-lg-2">
                                        <button type="submit" class="btn btn-outline-secondary w-100">
                                            {{ $product->id ? 'Update Product' : 'Add Product' }}</button>
                                   </div>

                                   <div class="col-lg-2">
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-primary w-100">Cancel</a>
                                   </div>
                              </div>
                         </div>


               </form>
               </div>
          </div>
          <!-- End Container Fluid -->


     </div>


@endsection

@section('script')

<script>
     document.addEventListener('DOMContentLoaded', function () {
         const mainImageInput = document.getElementById('main-image');
         const previewMain = document.getElementById('imagePreviewContainermain');
         const extraImageInput = document.getElementById('gallary');
         const previewExtra = document.getElementById('imagePreviewContainerimages');

         if (mainImageInput && previewMain) {
             setupImageUpload('main-image', 'imagePreviewContainermain');
         }

         if (extraImageInput && previewExtra) {
          // extraImageInput.addEventListener('change', function (event) {
             setupImageUpload('gallary', 'imagePreviewContainerimages');
         }
     });
 </script>
<script>
    $(document).on('click', '.delete-image', function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');  // ID المنتج
        var imagePath = $(this).data('image-path');  // المسار أو اسم الصورة

        $.ajax({
            url: '/admin/products/delete-image',  // route للحذف
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: productId,
                image_path: imagePath
            },
            success: function(response) {
                if(response.success) {
                    // حذف الصورة من الـ DOM
                    document.getElementById(imagePath).remove();
                    alert('Image deleted successfully!');
                } else {
                    alert('Failed to delete image!');
                }
            },
            error: function() {
                alert('Error occurred while deleting the image.');
            }
        });
    });

</script>
@endsection
