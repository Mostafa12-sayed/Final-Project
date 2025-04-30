
@extends('dashboard::layouts.master')
@section('title', 'Home')

@section('content')
<div class="page-content">

     <!-- Start Container Fluid -->
     <div class="container-fluid">

          <!-- Start here.... -->
          <div class="row">
               <div class="col-xxl-12">
                    <div class="row">


                         <div class="col-md-6">
                              <div class="card overflow-hidden">
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-6">
                                                  <div class="avatar-md bg-soft-primary rounded">
                                                       <iconify-icon icon="solar:cart-5-bold-duotone" class="avatar-title fs-32 text-primary"></iconify-icon>
                                                  </div>
                                             </div> <!-- end col -->
                                             <div class="col-6 text-end">
                                                  <p class="text-muted mb-0 text-truncate">Total Orders</p>
                                                  <h3 class="text-dark mt-1 mb-0">{{\Modules\Website\App\Models\Order::count()}}</h3>
                                             </div> <!-- end col -->
                                        </div> <!-- end row-->
                                   </div> <!-- end card body -->

                              </div> <!-- end card -->
                         </div> <!-- end col -->
                        <div class="col-md-6">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-md bg-soft-primary rounded">
                                                <i class="bx bxs-backpack avatar-title fs-24 text-primary"></i>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-6 text-end">
                                            <p class="text-muted mb-0 text-truncate">Total Earnings</p>
                                            <h3 class="text-dark mt-1 mb-0">        {{ number_format(\Modules\Website\App\Models\Order::sum('total'), 2) }}

                                            </h3>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div> <!-- end card body -->

                            </div> <!-- end card -->
                        </div> <!-- end col -->
                         <div class="col-md-6">
                              <div class="card overflow-hidden">
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-6">
                                                  <div class="avatar-md bg-soft-primary rounded">
                                                       <i class="bx bx-award avatar-title fs-24 text-primary"></i>
                                                  </div>
                                             </div> <!-- end col -->
                                             <div class="col-6 text-end">
                                                  <p class="text-muted mb-0 text-truncate">Total Customers</p>
                                                  <h3 class="text-dark mt-1 mb-0">{{App\Models\User::count()}}</h3>
                                             </div> <!-- end col -->
                                        </div> <!-- end row-->
                                   </div> <!-- end card body -->

                              </div> <!-- end card -->
                         </div> <!-- end col -->

                         <div class="col-md-6">
                              <div class="card overflow-hidden">
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-6">
                                                  <div class="avatar-md bg-soft-primary rounded">
                                                       <i class="bx bx-dollar-circle avatar-title text-primary fs-24"></i>
                                                  </div>
                                             </div> <!-- end col -->
                                             <div class="col-6 text-end">
                                                  <p class="text-muted mb-0 text-truncate">Total Products</p>
                                                  <h3 class="text-dark mt-1 mb-0">{{\Modules\Website\App\Models\Product::count()}}</h3>
                                             </div> <!-- end col -->
                                        </div> <!-- end row-->
                                   </div> <!-- end card body -->

                              </div> <!-- end card -->
                         </div> <!-- end col -->
                    </div> <!-- end row -->
               </div> <!-- end col -->

          </div> <!-- end row -->


          <div class="row">
               <div class="col">
                    <div class="card">
                         <div class="card-body">
                              <div class="d-flex align-items-center justify-content-between">
                                   <h4 class="card-title">
                                        Recent Orders
                                   </h4>

                                   <a href="{{route('admin.orders.index')}}" class="btn btn-sm btn-soft-primary">
                                        <i class="bx bx-eye me-1"></i>View All Orders
                                   </a>
                              </div>
                         </div>
                         <!-- end card body -->
                         <div class="table-responsive table-centered">
                              <table class="table mb-0">
                                   <thead class="bg-light bg-opacity-50">
                                        <tr>
                                             <th class="ps-3">
                                                  Order ID.
                                             </th>
                                             <th>
                                                  Date
                                             </th>
                                             <th>
                                                  Product
                                             </th>
                                             <th>
                                                  Customer Name
                                             </th>
                                             <th>
                                                  Email ID
                                             </th>
                                             <th>
                                                  Phone No.
                                             </th>
                                             <th>
                                                  Address
                                             </th>
                                             <th>
                                                  Payment Type
                                             </th>
                                             <th>
                                                  Status
                                             </th>
                                        </tr>
                                   </thead>
                                   <!-- end thead-->
                                   <tbody>
                                   @foreach($orders as $order)
                                        <tr>
                                             <td class="ps-3">
                                                  <a href="order-detail.html">#{{$order->id}}</a>
                                             </td>
                                             <td>{{$order->created_at->format('d M Y h:i A')}}</td>
                                             <td>
                                                 {{$order->items->count()}}
                                             </td>
                                             <td>
                                                  <a href="#!">{{$order->user->name}}</a>
                                             </td>
                                             <td>{{$order->user->email}}</td>
                                             <td>{{$order->user->phone}}</td>
                                             <td>{{$order->address->street_addresses ?? ''}}</td>
                                             <td>{{$order->payment_method}}</td>
                                             <td>
                                                 {{$order->status}}
                                             </td>
                                        </tr>
                                  @endforeach
                                   </tbody>
                                   <!-- end tbody -->
                              </table>
                              <!-- end table -->
                         </div>
                         <!-- table responsive -->

                         <div class="card-footer border-top">
                              <div class="row g-3">
                                  <x-dashboard::paginate :items="$orders" />

                              </div>
                         </div>
                    </div>
                    <!-- end card -->
               </div>
               <!-- end col -->
          </div> <!-- end row -->

     </div>
     <!-- End Container Fluid -->



</div>
@endsection
