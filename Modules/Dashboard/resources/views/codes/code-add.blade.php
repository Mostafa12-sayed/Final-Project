@extends('dashboard::layouts.master')
@section('title', 'Category Add')
@section('content')

          <div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    <div class="row">
                         <div class="col-xl-12 col-lg-12 ">
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Add Thumbnail Photo</h4>
                                   </div>
                                   <div class="card-body">
                                        <!-- File Upload -->
                                        <form action="https://techzaa.in/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                        
                                             <div class="fallback" sty>
                                                  <input name="image" type="file"  />
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
                                        <h4 class="card-title">General Information</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-lg-6">
                                                  <form>
                                                       <div class="mb-3">
                                                            <label for="category-title" class="form-label">Category Title</label>
                                                            <input type="text" id="category-title" class="form-control" placeholder="Enter Title">
                                                       </div>
                                                  </form>
                                             </div>

                                             <div class="col-lg-6">
                                                  <form>
                                                       <label for="crater" class="form-label">Follow Category (Optional)</label>
                                                       <select class="form-control" id="crater" data-choices data-choices-groups data-placeholder="Select Crater">
                                                            <option value="">Select Crater</option>
                                                            <option value="Seller">Seller</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="Other">Other</option>
                                                       </select>
                                                  </form>
                                             </div>

                                             <div class="col-lg-12">
                                                  <div class="mb-0">
                                                       <label for="description" class="form-label">Description</label>
                                                       <textarea class="form-control bg-light-subtle" id="description" rows="7" placeholder="Type description"></textarea>
                                                  </div>
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