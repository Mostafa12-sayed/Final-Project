@extends('website::layouts.userDashboard')

@section('main-content')
                <div class="col-lg-9">
                    <div class="user-wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="user-card">
                                    <div class="user-card-header">
                                        <h4 class="user-card-title">My Orders List</h4>
                                        <div class="user-card-header-right">
                                            <div class="user-card-filter">
                                                <select class="select">
                                                    <option value="">Default</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Processing</option>
                                                    <option value="3">Cancelled</option>
                                                    <option value="4">Completed</option>
                                                </select>
                                            </div>
                                            <div class="user-card-search">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Search...">
                                                    <i class="far fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-borderless text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#Order No</th>
                                                    <th>Purchased Date</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td><span class="table-list-code">{{ $order->number }}</span></td>
                                                        <td>{{ $order->created_at->format('F d, Y') }}</td>
                                                        <td>${{ number_format($order->total_price, 2) }}</td>
                                                        <td>
                                                            <span class="badge 
                                                                @if($order->status == 'pending') badge-info
                                                                @elseif($order->status == 'processing') badge-primary
                                                                @elseif($order->status == 'completed') badge-success
                                                                @else badge-danger @endif">
                                                                {{ ucfirst($order->status) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                               
                                                                <a href="{{ route('order.details', $order->id) }}" 
                                                                class="btn btn-outline-secondary btn-sm rounded-2" 
                                                                data-tooltip="tooltip" 
                                                                title="Details">
                                                                <i class="far fa-eye"></i>
                                                                </a>
                                                            </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- pagination -->
                                    <div class="pagination-area mt-4 mb-3">
                                        <div aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $orders->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- pagination end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <!-- user dashboard end -->

</main>
@endsection