@extends('dashboard::layouts.master')
@section('title', 'Product Add')
@section('content')
     <div class="page-content">

          <!-- Start Container Fluid -->
          <div class="container-xxl">

               <div class="row">
         
                    <div class="col-xl-12 col-lg-12 ">
                         <div class="card">
                              <div class="card-header">
                                   <h4 class="card-title">Add Product Photo</h4>
                              </div>
                              <form action="https://techzaa.in/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                              <div class="card-body">
                                   <!-- File Upload -->
                              
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
                              </div>
                         </div>
                         <div class="card">
                              <div class="card-header">
                                   <h4 class="card-title">Product Information</h4>
                              </div>
                              <div class="card-body">
                                   <div class="row">
                                        <div class="col-lg-6">
                                             <form>
                                                  <div class="mb-3">
                                                       <label for="product-name" class="form-label">Product Name</label>
                                                       <input type="text" id="product-name" class="form-control" placeholder="Items Name">
                                                  </div>
                                             </form>
                                        </div>
                                        <div class="col-lg-6">
                                             <form>
                                                  <label for="product-categories" class="form-label">Product Categories</label>
                                                  <select class="form-control" id="product-categories" data-choices data-choices-groups data-placeholder="Select Categories" name="choices-single-groups">
                                                       <option value="">Choose a categories</option>
                                                       <option value="Fashion">Fashion</option>
                                                       <option value="Electronics">Electronics</option>
                                                       <option value="Footwear">Footwear</option>
                                                       <option value="Sportswear">Sportswear</option>
                                                       <option value="Watches">Watches</option>
                                                       <option value="Furniture">Furniture</option>
                                                       <option value="Appliances">Appliances</option>
                                                       <option value="Headphones">Headphones</option>
                                                       <option value="Other Accessories">Other Accessories</option>
                                                  </select>
                                             </form>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="product-brand" class="form-label">Brand</label>
                                                       <input type="text" id="product-brand" class="form-control" placeholder="Brand Name">
                                                  </div>
                                        </div>
                                        <div class="col-lg-6">
                                             
                                             <div class="mb-3">
                                                  <label for="product-weight" class="form-label">Weight</label>
                                                  <input type="text" id="product-weight" class="form-control" placeholder="In gm & kg">
                                             </div>
                                            
                                        </div>
                                        
                                   </div>
                           
                                   <div class="row">
                                        <div class="col-lg-12">
                                             <div class="mb-3">
                                                  <label for="description" class="form-label">Description</label>
                                                  <textarea class="form-control bg-light-subtle" id="description" rows="7" placeholder="Short description about the product"></textarea>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-lg-4">
                                             <form>
                                                  <div class="mb-3">
                                                       <label for="product-id" class="form-label">Tag Number</label>
                                                       <input type="number" id="product-id" class="form-control" placeholder="#******">
                                                  </div>

                                             </form>
                                        </div>
                                        <div class="col-lg-4">
                                             <form>
                                                  <div class="mb-3">
                                                       <label for="product-stock" class="form-label">Stock</label>
                                                       <input type="number" id="product-stock" class="form-control" placeholder="Quantity">
                                                  </div>

                                             </form>
                                        </div>
                                        <div class="col-lg-4">
                                             <label for="product-stock" class="form-label">Tag</label>
                                             <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="choices-multiple-remove-button" multiple>
                                                  <option value="Fashion" selected>Fashion</option>
                                                  <option value="Electronics">Electronics</option>
                                                  <option value="Watches">Watches</option>
                                                  <option value="Headphones">Headphones</option>
                                             </select>
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
                                        <div class="col-lg-4">
                                             <form>
                                                  <label for="product-price" class="form-label">Price</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                                       <input type="number" id="product-price" class="form-control" placeholder="000">
                                                  </div>
                                             </form>
                                        </div>
                                        <div class="col-lg-4">
                                             <form>
                                                  <label for="product-discount" class="form-label">Discount</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                                       <input type="number" id="product-discount" class="form-control" placeholder="000">
                                                  </div>
                                             </form>
                                        </div>
                                        <div class="col-lg-4">
                                             <form>
                                                  <label for="product-tex" class="form-label">Tex</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class='bx bxs-file-txt'></i></span>
                                                       <input type="number" id="product-tex" class="form-control" placeholder="000">
                                                  </div>
                                             </form>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="p-3 bg-light mb-3 rounded">
                              <div class="row justify-content-end g-2">
                                   <div class="col-lg-2">
                                        <a href="#!" class="btn btn-outline-secondary w-100">Create Product</a>
                                   </div>
                                   <div class="col-lg-2">
                                        <a href="#!" class="btn btn-primary w-100">Cancel</a>
                                   </div>
                              </div>
                         </div>
                    </form>

                    </div>
               </div>
          </div>
          <!-- End Container Fluid -->

          <!-- ========== Footer Start ========== -->
          <footer class="footer">
               <div class="container-fluid">
                    <div class="row">
                         <div class="col-12 text-center">
                              <script>document.write(new Date().getFullYear())</script> &copy; Larkon. Crafted by <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon> <a href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Techzaa</a>
                         </div>
                    </div>
               </div>
          </footer>
          <!-- ========== Footer End ========== -->

     </div>
@endsection