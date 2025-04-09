@extends('dashboard::layouts.master')
@section('title', 'Category List')
@section('content')

          <div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-xxl">

                 

                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                        <h4 class="card-title flex-grow-1">All Categories List</h4>
                                        <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-primary">
                                             Add Category
                                        </a>
                                   </div>
                                   <div>
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                            
                                                            <th>Categories</th>
                                                            <th>Create by</th>
                                                            <th>Parent</th>
                                                            <th>ID</th>
                                                            <th>Product Stock</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @if($categories->count()>0)
                                                       @foreach ($categories as $category )
                                                       <tr>
                                                                 
                                                 
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           @if($category->image)
                                                                           <img src="{{ asset('storage/'. $category->image) }}" alt="" class="avatar-md">
                                                                           @endif
                                                                      </div>
                                                                      <p class="text-dark fw-medium fs-15 mb-0">{{ $category->name }}</p>
                                                                 </div>

                                                            </td>
                                                            <td>{{$category->created_by}}</td>
                                                            <td>{{optional($category->parent)->name}}</td>
                                                            <td>{{ $category->code }}</td>
                                                            <td>{{ $category->products->count() }}</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="{{ route('admin.category.edit' , ['category'=>$category->id]) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                      <form action="{{ route('admin.category.destroy' ,['category'=>$category->id]) }}" method="POST" class="d-inline">
                                                                           @csrf
                                                                           @method('DELETE')
                                                                           <button type="submit" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                                      </form>
                                                                     
                                                                 </div>
                                                            </td>
                                                       </tr>
                                                       @endforeach
                                                       @else
                                                       <tr>
                                                            <td colspan="7" class="text-center">No Category Found</td>
                                                       </tr>
                                                       @endif
                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- end table-responsive -->
                                   </div>
                                   <x-dashboard::paginate :items="$categories" />

                              </div>
                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->

              

          </div>
@endsection