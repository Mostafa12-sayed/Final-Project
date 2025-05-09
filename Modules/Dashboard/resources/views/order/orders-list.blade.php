@extends('dashboard::layouts.master')
@section('title', 'Orders List')
@section('content')
          <div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-xxl">

                    @if(!auth('admin')->user()->hasRole('Seller'))
                    <div class="row">
                         <div class="col-md-6 col-xl-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                  <h4 class="card-title mb-2">Order Cancel</h4>
                                                  <p class="text-muted fw-medium fs-22 mb-0">{{\Modules\Website\app\Models\Order::where('buyer_status', 'cancelled')->count()}}</p>
                                             </div>
                                             <div>
                                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                       <iconify-icon icon="solar:cart-cross-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-md-6 col-xl-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                  <h4 class="card-title mb-2">Order Shipped</h4>
                                                  <p class="text-muted fw-medium fs-22 mb-0">{{\Modules\Website\app\Models\Order::where('status', 'shipping')->count()}}</p>
                                             </div>
                                             <div>
                                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                       <iconify-icon icon="solar:box-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-md-6 col-xl-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                  <h4 class="card-title mb-2">Order Delivering</h4>
                                                  <p class="text-muted fw-medium fs-22 mb-0">{{\Modules\Website\app\Models\Order::where('status', 'delivering')->count()}}</p>
                                             </div>
                                             <div>
                                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                       <iconify-icon icon="solar:tram-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="col-md-6 col-xl-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                  <h4 class="card-title mb-2">Pending Review</h4>
                                                  <p class="text-muted fw-medium fs-22 mb-0">{{\Modules\Website\app\Models\Order::where('status', 'pending')->count()}}</p>
                                             </div>
                                             <div>
                                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                       <iconify-icon icon="solar:clipboard-remove-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-6 col-xl-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                  <h4 class="card-title mb-2">Pending Payment</h4>
                                                  <p class="text-muted fw-medium fs-22 mb-0">{{\Modules\Website\app\Models\Order::where('payment_status', 'pending')->count()}}</p>
                                             </div>
                                             <div>
                                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                       <iconify-icon icon="solar:clock-circle-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-6 col-xl-3">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                             <div>
                                                  <h4 class="card-title mb-2">Delivered</h4>
                                                  <p class="text-muted fw-medium fs-22 mb-0">{{\Modules\Website\app\Models\Order::where('status', 'completed')->count()}}</p>
                                             </div>
                                             <div>
                                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                       <iconify-icon icon="solar:clipboard-check-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>

                    </div>
                    @endif
                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="d-flex card-header justify-content-between align-items-center">
                                        <div>
                                             <h4 class="card-title">All Order List</h4>
                                        </div>
                                   </div>
                                   <div class="card-body p-0">
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                            <th>Order ID</th>
                                                            <th>Created at</th>
                                                            <th>Customer</th>
                                                            <th>Total</th>
                                                            <th>Payment Status</th>
                                                            <th>Items</th>
                                                            <th>Delivery Number</th>
                                                            <th>Order Status</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                        @if(count($orders) > 0)
                                                            @foreach($orders as $order)
                                                            <tr>
                                                            <td>
                                                                 #{{$order->id}}
                                                            </td>
                                                            <td>{{$order->created_at->format('d M Y h:i A')}}</td>
                                                            <td>
                                                                 {{optional($order->user)->name}}
                                                            </td>
                                                            <td> ${{$order->total}}</td>
                                                            <td> <span class="badge bg-light text-dark  px-2 py-1 fs-13">{{$order->payment_status}}</span></td>
                                                            <td> {{$order->items->count()}}</td>
                                                            <td> {{$order->number}}</td>
                                                            <td> <span class="badge border border-secondary text-secondary  px-2 py-1 fs-13">{{$order->status}}</span></td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="{{route('admin.order.show', ['order'=>$order->id])}}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                      <a href="{{route('admin.order.delete', ['order'=>$order->id])}}" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                 </div>
                                                            </td>
                                                       </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                            <td colspan="10" class="text-center p-4">No Orders Found</td>
                                                            </tr>
                                                        @endif

                                                  </tbody>
                                             </table>
                                        </div>
                                        <!-- end table-responsive -->
                                   </div>
                                  <x-dashboard::paginate :items="$orders" />
                              </div>
                         </div>

                    </div>

               </div>
               <!-- End Container Fluid -->



          </div>
@endsection
