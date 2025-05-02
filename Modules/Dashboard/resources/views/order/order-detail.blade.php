@extends('dashboard::layouts.master')
@section('title', 'Order Details')
@section('content')
<div class="page-content">

     <!-- Start Container -->
     <div class="container-xxl">

          <div class="row">
               <div class="col-xl-9 col-lg-8">
                    <div class="row">
                         <div class="col-lg-12">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                             <div>
                                                  <h4 class="fw-medium text-dark d-flex align-items-center gap-2">#{{$order->id}}/{{optional($order->store)->id}} <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">{{$order->payment_status == 'paid'? 'Paid': 'Unpaid'}}</span><span class="border border-warning text-warning fs-13 px-2 py-1 rounded">{{$order->status}}</span></h4>
                                                  <p class="mb-0">Order / Order Details / #{{$order->id}}/{{optional($order->store)->id}} -
                                                      {{$order->created_at->format('d M Y h:i A')}}</p>
                                             </div>
                                             <div>
                                                 @if(auth('admin')->user()->hasPermission('approve_orders_admin'))
                                                     @if($order->admin_status == 'pending')
                                                         <a href="{{route('admin.order.change.status.admin', ['order'=>$order->id , 'status' => 'approved'])}}" class="btn btn-outline-secondary">Approved</a>
                                                         <a href="{{route('admin.order.change.status.admin', ['order'=>$order->id , 'status' => 'rejected'])}}" class="btn btn-outline-secondary">Rejected</a>
                                                     @elseif($order->admin_status == 'approved')
                                                         <a href="{{route('admin.order.change.status.admin', ['order'=>$order->id , 'status' => 'rejected'])}}" class="btn btn-outline-secondary">Rejected</a>
                                                     @elseif($order->admin_status =='rejected')
                                                         <a href="{{route('admin.order.change.status.admin', ['order'=>$order->id , 'status' => 'approved'])}}" class="btn btn-outline-secondary">Approved</a>
                                                     @endif
                                                 @elseif(auth('admin')->user()->hasPermission('approve_orders_seller'))
                                                     @if($order->seller_status == 'pending')
                                                         <a href="{{route('admin.order.change.status.seller', ['order'=>$order->id , 'status' => 'approved'])}}" class="btn btn-outline-secondary">Approved</a>
                                                         <a href="{{route('admin.order.change.status.seller', ['order'=>$order->id , 'status' => 'rejected'])}}" class="btn btn-outline-secondary">Rejected</a>
                                                     @elseif($order->seller_status == 'approved')
                                                         <a href="{{route('admin.order.change.status.seller', ['order'=>$order->id , 'status' => 'rejected'])}}" class="btn btn-outline-secondary">Rejected</a>
                                                     @elseif($order->seller_status =='rejected')
                                                         <a href="{{route('admin.order.change.status.seller', ['order'=>$order->id , 'status' => 'approved'])}}" class="btn btn-outline-secondary">Approved</a>
                                                     @endif
                                                 @endif
                                             </div>

                                        </div>
                                   </div>
                                   <div class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
                                        <p class="border rounded mb-0 px-2 py-1 bg-body"><i class='bx bx-arrow-from-left align-middle fs-16'></i> Estimated shipping date : <span class="text-dark fw-medium">Apr 25 , 2024</span></p>
{{--                                       @if(auth('admin')->user()->hasPermission('make_order_ship'))--}}
{{--                                       <div>--}}
{{--                                           @if($order->admin_status == 'approved' && $order->status == 'pending')--}}
{{--                                             <a href="{{route('admin.order.edit.change.status', ['order'=>$order->id , 'status'=>'shipping'])}}" class="btn btn-primary">Make As Ready To Ship</a>--}}
{{--                                           @endif--}}
{{--                                       </div>--}}
{{--                                       @endif--}}
                                   </div>
                              </div>
                             <div class="card shadow-sm p-3 mb-4">
                                 <div class="card-header d-flex justify-content-between align-items-center">
                                     <div class="d-flex align-items-center gap-2">    <h5 class="mb-0">Order Actions</h5>
                                         <span class="badge bg-info">Order #{{ $order->id }}</span>
                                     </div>
                                     <div class="d-flex align-items-center gap-2">
                                     {{-- Print Invoice --}}
                                     <a href="{{ route('admin.order.invoice', $order->id) }}" class="btn btn-secondary" target="_blank">
                                         <i class="bi bi-printer"></i> Print Invoice
                                     </a>
                                         {{-- Mark as Shipped --}}
                                         @if(in_array($order->status, ['shipping', 'confirming']) && auth('admin')->user()->hasPermission('make_order_ship'))
                                             <a href="{{route('admin.order.edit.change.status', ['order'=>$order->id , 'status'=>'shipping'])}}" class="btn btn-primary">Make As Ready To Ship</a>
                                         @endif
                                     </div>
                                     </div>
                                 <div class="card-body">
                                     <div >
                                         <h4 class="fw-medium text-dark">Progress</h4>
                                     </div>
                                     <div class="row mb-2">
                                         <div class="row">
                                             <strong class="fw-bold text-dark">Order Admin Confirming : {{ $order->admin_status}}</strong>
                                         </div>
                                         <div class="row">
                                             <strong class="fw-bold text-dark">Order Seller Confirming : {{ $order->seller_status}}</strong>
                                         </div>
                                         <div class="row">
                                             <strong class="fw-bold text-dark">Order Status : {{ $order->status  }}</strong>
                                         </div>
                                     </div>
                                     <div class="d-flex flex-wrap gap-2">

                                         {{-- Confirm Order --}}
                                         @if($order->status === 'pending')
                                             <a href="{{route('admin.order.edit.change.status', ['order'=>$order->id , 'status'=>'confirming'])}}" class="btn btn-primary">Confirm Order</a>

                                         @endif

                                         {{-- Cancel Order --}}
                                         @if(in_array($order->status, ['pending', 'confirming']))
                                                 <a href="{{route('admin.order.edit.change.status', ['order'=>$order->id , 'status'=>'cancelling'])}}" class="btn btn-primary">Cancel Order</a>
                                         @endif
                                         @if(in_array($order->status, ['shipping', 'confirming']))
                                             <a href="{{route('admin.order.edit.change.status', ['order'=>$order->id , 'status'=>'completed'])}}" class="btn btn-primary">Complated Order</a>
                                         @endif





                                         {{-- Delete Order --}}
{{--                                         <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">--}}
{{--                                             @csrf--}}
{{--                                             @method('DELETE')--}}
{{--                                             <button type="submit" class="btn btn-outline-danger">--}}
{{--                                                 <i class="bi bi-trash"></i> Delete--}}
{{--                                             </button>--}}
{{--                                         </form>--}}
                                     </div>
                                 </div>
                                 <div class="row">
                                 <div class="col-md-6">
                                     @if( auth('admin')->user()->hasPermission('make_order_payment'))
                                         <label for="payment_status" class="mb-2">Payment Status</label>
                                         <form action="{{route('admin.order.update-payment-status', ['order'=>$order->id])}}" method="POST">
                                             @csrf
                                             <select name="payment_status" id="payment_status" class="form-select">
                                                 <option value="paid" {{ $order->payment_status == 'paid' ?'selected' : '' }}>Paid</option>
                                                 <option value="pending" {{ $order->payment_status == 'pending' ?'selected' : '' }}>Pending</option>
                                             </select>
                                             <button type="submit" class="btn btn-primary mt-2">Seve</button>
                                         </form>
                                     @endif
                                 </div>
                                 <div class="col-md-6">
                                     @if( auth('admin')->user()->hasPermission('make_order_payment'))
                                         <label for="payment_status" class="mb-2">Shipping Value</label>
                                         <form action="{{route('admin.order.update-update-shipping-value', ['order'=>$order->id])}}" method="POST">
                                             @csrf
                                             <input type="text" name="shipping_value" id="shipping_value" class="form-control" value="{{ $order->shipping }}">

                                             <button type="submit" class="btn btn-primary mt-2">Seve</button>
                                         </form>
                                     @endif
                                 </div>
                                 </div>
                             </div>

                             <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Product</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle border-bottom">
                                                       <tr>
                                                            <th>Product Name & Size</th>
                                                            <th>Status</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Total</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                        @foreach($order->items as $item)
                                                       <tr>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="{{asset(optional($item->product)->image)}}" alt="" class="avatar-md">
                                                                      </div>
                                                                      <div>
                                                                           <a href="{{route('product.show', ['slug' => $item->product->slug])}}" class="text-dark fw-medium fs-15" target="_blank">{{$item->product->name}}</a>
                                                                      </div>
                                                                 </div>

                                                            </td>
                                                            <td>
                                                                 <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">{{$item->product->status}}</span>
                                                            </td>
                                                            <td>${{$item->quantity}}</td>
                                                            <td>${{$item->price}}</td>
                                                            <td>
                                                                 ${{($item->product->price * $item->quantity) }}
                                                            </td>

                                                       </tr>
                                                        @endforeach

                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>

                         </div>
                    </div>
               </div>
               <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Payment Details</h4>
                        </div>
                         <div class="card-body">
                              <div class="table-responsive">
                                   <table class="table mb-0">
                                        <tbody>
                                             <tr>
                                                  <td class="px-0">
                                                       <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:clipboard-text-broken"></iconify-icon> Sub Total : </p>
                                                  </td>
                                                  <td class="text-end text-dark fw-medium px-0">${{$order->total - ($order->discount + $order->shipping + $order->tax)}}</td>
                                             </tr>
                                             <tr>
                                                  <td class="px-0">
                                                       <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:ticket-broken" class="align-middle"></iconify-icon> Discount : </p>
                                                  </td>
                                                  <td class="text-end text-dark fw-medium px-0">-${{$order->discount}}</td>
                                             </tr>
                                             <tr>
                                                  <td class="px-0">
                                                       <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:kick-scooter-broken" class="align-middle"></iconify-icon> Delivery Charge : </p>
                                                  </td>
                                                  <td class="text-end text-dark fw-medium px-0">${{$order->shipping}}</td>
                                             </tr>
                                             <tr>
                                                  <td class="px-0">
                                                       <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon icon="solar:calculator-minimalistic-broken" class="align-middle"></iconify-icon> Estimated Tax : </p>
                                                  </td>
                                                  <td class="text-end text-dark fw-medium px-0">${{$order->tax}}</td>
                                             </tr>

                                        </tbody>
                                   </table>
                              </div>
                         </div>
                         <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                              <div>
                                   <p class="fw-medium text-dark mb-0">Total Amount</p>
                              </div>
                              <div>
                                   <p class="fw-medium text-dark mb-0">${{$order->total + $order->shipping}}</p>
                              </div>

                         </div>
                    </div>
                    <div class="card">
                         <div class="card-header">
                              <h4 class="card-title">Customer Details</h4>
                         </div>
                         <div class="card-body">
                              <div class="d-flex align-items-center gap-2">
                                   <img src="{{is_null($order->user->profile_image) ? asset('assets/img/account/user.png') : asset('assets/img/account/'.$order->user->profile_image)}}" alt="" class="avatar rounded-3 border border-light border-3">
                                   <div>
                                        <p class="mb-1">{{$order->user->name}}</p>
                                        <a href="#!" class="link-primary fw-medium">{{$order->user->email}}</a>
                                   </div>
                              </div>
                              <div class="d-flex justify-content-between mt-3">
                                   <h5 class="">Contact Number</h5>

                              </div>
                              <p class="mb-1">{{$order->user->phone}}</p>

                              <div class="d-flex justify-content-between mt-3">
                                   <h5 class="">Shipping Address</h5>
                              </div>

                              <div>
                                   <p class="mb-1">{{optional($order->address)->street_addresses}}</p>
                                   <p class="mb-1">{{optional($order->address)->country}}, {{optional($order->address)->city}} ,{{optional($order->address)->state}} </p>
                                   <p class="">{{optional($order->address)->phone_number}}</p>
                              </div>

                              <div class="d-flex justify-content-between mt-3">
                                   <h5 class="">Billing Address</h5>

                              </div>

                              <p class="mb-1">Same as shipping address</p>
                         </div>
                    </div>

               </div>
          </div>
     </div>

</div>

@endsection
