@extends('website::layouts.userDashboard')

@section('main-content')

                
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="user-card user-track-order">
                            <h4 class="user-card-title">Track Your Order</h4>
                            
                            <form action="{{ route('order.track') }}" method="GET" class="mb-4">
                                <div class="input-group">
                                    <input type="text" name="order_number" class="form-control" 
                                           placeholder="Enter your order number (e.g. ORD-ABC123)" 
                                           value="{{ $order->number ?? old('order_number') }}">
                                    <button class="btn btn-primary" type="submit">Track</button>
                                </div>
                            </form>

                            @if(isset($order))
                            <div class="track-order-content">
                                <div class="order-info mb-4">
                                    <h5>Order #{{ $order->number }}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Status:</strong> 
                                                <span class="badge bg-{{ [
                                                    'pending' => 'secondary',
                                                    'processing' => 'info',
                                                    'delivering' => 'primary',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger'
                                                ][$order->status] }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </p>
                                            <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                                            @if($order->tracking_number)
                                            <p><strong>Tracking:</strong> 
                                                <a href="{{ $order->tracking_url }}" target="_blank">
                                                    {{ $order->tracking_number }}
                                                </a>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="user-card user-track-order">
                                    <h4 class="user-card-title">Track My Order</h4>
                                    <div class="track-order-content">
                                        <h5>Tracking Order Number: <span>#{{ $order->number }}</span></h5>
                                        <div class="track-order-info">
                                            <a href="#"><span>Shipped Via:</span> {{ $order->shipping_method ?? 'Standard Shipping' }}</a>
                                            <a href="#"><span>Status:</span> {{ ucfirst($order->status) }}</a>
                                            @if($order->expected_delivery_date)
                                            <a href="#"><span>Expected Date:</span> {{ $order->expected_delivery_date->format('F d, Y') }}</a>
                                            @endif
                                        </div>
                                        
                                        <div class="track-order-step">
                                            @php
                                                $steps = [
                                                    'pending' => [
                                                        'icon' => 'fa-shopping-cart',
                                                        'title' => 'Order Confirmed',
                                                        'status' => $order->created_at ? 'completed' : ''
                                                    ],
                                                    'processing' => [
                                                        'icon' => 'fa-cog',
                                                        'title' => 'Processing Order',
                                                        'status' => in_array($order->status, ['processing', 'delivering', 'completed']) ? 'completed' : ''
                                                    ],
                                                    'quality_check' => [
                                                        'icon' => 'fa-check-circle',
                                                        'title' => 'Quality Check',
                                                        'status' => in_array($order->status, ['delivering', 'completed']) ? 'completed' : ''
                                                    ],
                                                    'delivering' => [
                                                        'icon' => 'fa-truck-fast',
                                                        'title' => 'Product Dispatched',
                                                        'status' => $order->status === 'completed' ? 'completed' : ($order->status === 'delivering' ? 'active' : '')
                                                    ],
                                                    'completed' => [
                                                        'icon' => 'fa-home',
                                                        'title' => 'Product Delivered',
                                                        'status' => $order->status === 'completed' ? 'completed' : ''
                                                    ]
                                                ];
                                            @endphp
                                            
                                            @foreach($steps as $step)
                                            <div class="step-item {{ $step['status'] }}">
                                                <div class="step-icon">
                                                    <i class="fal {{ $step['icon'] }}"></i>
                                                </div>
                                                <h6>{{ $step['title'] }}</h6>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="track-order-actions mt-4">
                                    <a href="{{ route('order.details', $order->id) }}" class="btn btn-primary">
                                        View Order Details
                                    </a>
                                    @if($order->status === 'delivering' && $order->tracking_number)
                                    <a href="{{ $order->tracking_url }}" target="_blank" class="btn btn-outline-primary">
                                        Track Shipment
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @elseif(request()->has('order_number'))
                            <div class="alert alert-danger">
                                No order found with number: {{ request('order_number') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .track-order-steps .steps {
        position: relative;
        padding-left: 50px;
    }
    .track-order-steps .step {
        position: relative;
        padding-bottom: 30px;
    }
    .track-order-steps .step:last-child {
        padding-bottom: 0;
    }
    .track-order-steps .step-icon {
        position: absolute;
        left: -50px;
        top: 0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }
    .track-order-steps .step.completed .step-icon {
        background: #28a745;
        color: white;
    }
    .track-order-steps .step.active .step-icon {
        background: #007bff;
        color: white;
    }
    .track-order-steps .step:not(:last-child):after {
        content: '';
        position: absolute;
        left: -32px;
        top: 36px;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }
    .track-order-steps .step.completed:after {
        background: #28a745;
    }
</style>
@endpush