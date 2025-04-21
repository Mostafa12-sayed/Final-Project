@extends('dashboard::layouts.master')
@section('title', 'Customers List')
@section('content')

          <div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-xxl">
                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                        <h4 class="card-title flex-grow-1">All Customers List</h4>
                                        <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-primary">
                                             Add Customer
                                        </a>
                                   </div>
                                   <div>
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Number of Orders</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                       @if($customers->count()>0)
                                                       @foreach ($customers as $customer )
                                                       <tr>

                                                           <td>{{$customer->id}}</td>
                                                           <td>{{$customer->name}}</td>
                                                           <td>{{$customer->email}}</td>
                                                           <td>{{optional($customer->orders)->count() ?? 0 }}</td>
                                                           <td>{{$customer->created_at->diffForHumans()}}</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="{{ route('admin.customers.edit' , ['customer'=>$customer->id]) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                      <form id="delete-form-category-{{ $customer->id }}" action="{{ route('admin.customers.destroy' ,['customer'=>$customer->id]) }}" method="POST" class="d-inline">
                                                                           @csrf
                                                                           @method('DELETE')
                                                                      </form>
                                                                     <button type="submit" class="btn btn-soft-danger btn-sm delete-item" data-form="delete-form-category-{{ $customer->id }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>


                                                                 </div>
                                                            </td>
                                                       </tr>
                                                       @endforeach
                                                       @else
                                                       <tr>
                                                            <td colspan="7" class="text-center">No Customers Found</td>
                                                       </tr>
                                                       @endif
                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- end table-responsive -->
                                   </div>
                                   <x-dashboard::paginate :items="$customers" />

                              </div>
                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->



          </div>
@endsection
