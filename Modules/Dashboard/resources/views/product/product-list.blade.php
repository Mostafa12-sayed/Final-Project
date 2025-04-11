@extends('dashboard::layouts.master')
@section('title', 'Product List')
@section('content')
<div class="page-content">

     <!-- Start Container Fluid -->
     <div class="container-fluid">

          <div class="row">
               <div class="col-xl-12">
                    <div class="card">
                         <div class="card-header d-flex justify-content-between align-items-center gap-1">
                              <h4 class="card-title flex-grow-1">All Product List</h4>

                              <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-primary">
                                   Add Product
                              </a>


                         </div>
                         <div>
                              <div class="table-responsive">
                                   <table class="table align-middle mb-0 table-hover table-centered">
                                        <thead class="bg-light-subtle">
                                             <tr>
                                                  <th>Product Name & Size</th>
                                                  <th>Price</th>
                                                  <th>Stock</th>
                                                  <th>Category</th>
                                                  <th>Rating</th>
                                                  <th>Action</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             @if($products->count()>0)
                                             @foreach ($products as $product )

                                             <tr>
                                                  <td>
                                                       <div class="d-flex align-items-center gap-2">
                                                            <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                 @if($product->image)
                                                                 <img src="{{ asset('storage/'.$product->image) }}" alt="" class="avatar-md">
                                                                 @endif
                                                            </div>
                                                            <div>
                                                                 <a href="#!" class="text-dark fw-medium fs-15">{{$product->name}}</a>
                                                                 <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>S , M , L , Xl </p>
                                                            </div>
                                                       </div>

                                                  </td>
                                                  <td>${{$product->price}}</td>
                                                  <td>
                                                       <p class="mb-1 text-muted"><span class="text-dark fw-medium">{{ $product->quantity - $product->stock }} Item</span> Left</p>
                                                       <p class="mb-0 text-muted">{{ $product->stock }} Sold</p>
                                                  </td>
                                                  <td> {{ optional($product->category)->name}}</td>
                                                  <td> <span class="badge p-1 bg-light text-dark fs-12 me-1"><i class="bx bxs-star align-text-top fs-14 text-warning me-1"></i> 4.5</span> 55 Review</td>
                                                  <td>
                                                       <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.products.show' , ['product'=>$product->id]) }}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                            <a href="{{ route('admin.products.edit' , ['product'=>$product->id]) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                            <form id="delete-form-product-{{ $product->id }}" action="{{ route('admin.products.destroy' , ['product'=>$product->id]) }}" method="POST">
                                                                 @csrf
                                                                 @method('delete')
                                                            </form>
                                                           <a type="submit" class="btn btn-soft-danger btn-sm delete-item" data-form="delete-form-product-{{ $product->id }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a>

                                                       </div>
                                                  </td>
                                             </tr>
                                             @endforeach
                                             @else
                                             <tr>
                                                  <td colspan="7" class="text-center">No Products Found</td>
                                             </tr>
                                             @endif

                                        </tbody>
                                   </table>
                              </div>
                              <!-- end table-responsive -->
                         </div>
                         <x-dashboard::paginate :items="$products" />
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
                     <script>document.write(new Date().getFullYear())</script> &copy; Larkon. Crafted by <iconify-icon icon="iconamoon:heart-duotone" class="fs-18 align-middle text-danger"></iconify-icon> <a
                         href="https://1.envato.market/techzaa" class="fw-bold footer-text" target="_blank">Techzaa</a>
                 </div>
             </div>
         </div>
     </footer>
     <!-- ========== Footer End ========== -->

</div>
@endsection
