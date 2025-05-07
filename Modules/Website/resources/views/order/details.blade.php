@extends('website::layouts.userDashboard')

@section('main-content')
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="row">
                        <div class="user-wrapper">
                        <div class="user-card user-order-detail">
                            <div class="user-card-header">
                                <h4 class="user-card-title">Order Details</h4>
                                <div class="order-status-badge">
                                    Status: <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>

                            <div class="order-item">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="product-info">
                                                        <img src="{{ $item->product->image ?? asset('images/placeholder.png') }}" width="60">
                                                        <div>
                                                            <h6>{{ $item->product->name }}</h6>
                                                            <small>SKU: {{ $item->product->sku }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($item->price, 2) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="order-summary">
                                            <h5>Order Summary</h5>
                                            <table class="table">
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <td>${{ number_format($order->subtotal, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping</td>
                                                    <td>${{ number_format($order->shipping, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tax</td>
                                                    <td>${{ number_format($order->tax, 2) }}</td>
                                                </tr>
                                                <tr class="total">
                                                    <td>Total</td>
                                                    <td>${{ number_format($order->total, 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection