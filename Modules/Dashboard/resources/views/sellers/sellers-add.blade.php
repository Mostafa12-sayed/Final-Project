@extends('dashboard::layouts.master')
@section('title', 'Roles List')
@section('content')
<div class="page-content">


        <!-- Start Container Fluid -->
        <div class="container-xxl">

             <div class="row">
                  <div class="col-xl-12 col-lg-12 ">
                       <div class="card">
                            <div class="card-header">
                                 <h4 class="card-title">Add Brand Logo</h4>
                            </div>
                            <div class="card-body">
                                 <!-- File Upload -->
                                 <form action="https://techzaa.in/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                      <div class="fallback">
                                           <input name="file" type="file" multiple />
                                      </div>
                                      <div class="dz-message needsclick">
                                           <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                           <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to browse</span></h3>
                                           <span class="text-muted fs-13">
                                                1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                           </span>
                                      </div>
                                 </form>
                            </div>
                       </div>
                       <div class="card">
                            <div class="card-header">
                                 <h4 class="card-title">Seller Information</h4>
                            </div>
                            <div class="card-body">
                                 <div class="row">

                                        <div class="col-lg-6">
                                                <div class="mb-3">
                                                     <label for="seller-title" class="form-label">Seller name</label>
                                                     <input type="text" id="seller-title" name="name" class="form-control" placeholder="Enter Ssller name" value="{{ old('name', $resource->name) }}">
                                                </div>
                                                @if($errors->has('name'))
                                                <span class="danger">{{$errors->first('name')}}</span>
                                                
                                                @endif
                                      </div>
                                      <div class="col-lg-6">
                                                <div class="mb-3">
                                                     <label for="brand-title" class="form-label">Brand Title</label>
                                                     <input type="text"  id="brand-title" class="form-control" placeholder="Enter Title">
                                                </div>
                                      </div>

                               
                        
                                      <div class="col-lg-6">
                                        
                                                <label for="seller-location" class="form-label">Location</label>
                                                <div class="input-group mb-3">
                                                     <span class="input-group-text fs-20"><iconify-icon icon="solar:point-on-map-bold-duotone" class="fs-18"></iconify-icon></span>
                                                     <input type="text" id="seller-location" class="form-control" name="address" placeholder="Add Address">
                                                </div>
                                           </form>
                                      </div>
                                      <div class="col-lg-6">
                                           <form>
                                                <label for="seller-email" class="form-label">Email</label>
                                                <div class="input-group mb-3">
                                                     <span class="input-group-text fs-20"><iconify-icon icon="solar:letter-bold-duotone" class="fs-18"></iconify-icon></span>
                                                     <input type="email" id="seller-email" class="form-control" placeholder="Add Email">
                                                </div>
                                           </form>
                                      </div>
                                      <div class="col-lg-6">
                                           <form>
                                                <label for="seller-number" class="form-label">Phone Number</label>
                                                <div class="input-group mb-3">
                                                     <span class="input-group-text fs-20"><iconify-icon icon="solar:outgoing-call-rounded-bold-duotone" class="fs-20"></iconify-icon></span>
                                                     <input type="number" id="seller-number" class="form-control" placeholder="Phone number">
                                                </div>
                                           </form>
                                      </div>
                                      <div class="col-lg-12">
                                           <label for="customRange1" class="form-label">Yearly Revenue</label>
                                           <div id="product-price-range" [data-slider-size="md" ] class=""></div>
                                           <div class="formCost row mt-2">
                                                <div class="col-lg-6">
                                                     <input class="form-control form-control-sm text-center" type="text" id="minCost" value="0">
                                                </div>

                                                <div class="col-lg-6">
                                                     <input class="form-control form-control-sm text-center" type="text" id="maxCost" value="1000">
                                                </div>
                                           </div>
                                      </div>
                                 </div>
                            </div>
                       </div>
                       <div class="card">
                            <div class="card-header">
                                 <h4 class="card-title">Seller Product Information</h4>
                            </div>
                            <div class="card-body">
                                 <div class="row">
                                      <div class="col-lg-4">
                                           <form>
                                                <div class="mb-3">
                                                     <label for="items-stock" class="form-label">Items Stock</label>
                                                     <input type="number" id="items-stock" class="form-control" placeholder="000">
                                                </div>
                                           </form>
                                      </div>
                                      <div class="col-lg-4">
                                           <form>
                                                <div class="mb-3">
                                                     <label for="items-sells" class="form-label">Product Sells</label>
                                                     <input type="number" id="items-sells" class="form-control" placeholder="000">
                                                </div>
                                           </form>
                                      </div>
                                      <div class="col-lg-4">
                                           <form>
                                                <div class="mb-3">
                                                     <label for="happy-client" class="form-label">Happy Client</label>
                                                     <input type="number" id="happy-client" class="form-control" placeholder="000">
                                                </div>
                                           </form>
                                      </div>
                                 </div>
                            </div>
                       </div>
                       <div class="p-3 bg-light mb-3 rounded">
                            <div class="row justify-content-end g-2">
                                 <div class="col-lg-2">
                                      <a href="#!" class="btn btn-outline-secondary w-100">Save Change</a>
                                 </div>
                                 <div class="col-lg-2">
                                      <a href="#!" class="btn btn-primary w-100">Cancel</a>
                                 </div>
                            </div>
                       </div>
                  </div>
             </div>


        </div>
        <!-- End Container Fluid -->

</div>
@endsection