@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Customer Orders</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($groupedOrders->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Bill No.</th>
                                    <th>Customer Name</th>
                                    <th>Contact</th>
                                    <th>Products</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedOrders as $key => $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ e($order->first()->bill_no) }}</td>
                                        <td>{{ e($order->first()->user->name ?? 'N/A') }}</td>
                                        <td>{{ e($order->first()->contact) }}</td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($order as $item)
                                                    <li>
                                                        {{ e($item->product->title ?? 'N/A') }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ e($order->first()->location) }}</td>
                                        <td>{{ e($order->first()->date) }}</td>
                                        <td>{{ ucfirst(e($order->first()->status)) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewOrderModal{{ $order->first()->id }}">
                                                View Details
                                            </button>

                                            <!-- Form for updating status to "Paid" -->
                                            <form action="{{ route('orders.update', $order->first()->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="paid">
                                                <button type="submit" class="btn btn-outline-success btn-sm">Paid</button>
                                            </form>

                                            <!-- Form for updating status to "Cancelled" -->
                                            <form action="{{ route('orders.update', $order->first()->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Cancelled</button>
                                            </form>

                                            <!-- Order Details Modal -->
                                            <div class="modal fade" id="viewOrderModal{{ $order->first()->id }}" tabindex="-1" aria-labelledby="viewOrderModalLabel{{ $order->first()->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewOrderModalLabel{{ $order->first()->id }}">
                                                                Order Details - {{ $order->first()->bill_no }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <h6>Customer Information</h6>
                                                                    <p><strong>Name:</strong> {{ $order->first()->user->name ?? 'N/A' }}</p>
                                                                    <p><strong>Email:</strong> {{ $order->first()->user->email ?? 'N/A' }}</p>
                                                                    <p><strong>Contact:</strong> {{ $order->first()->contact }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6>Order Information</h6>
                                                                    <p><strong>Bill No:</strong> {{ $order->first()->bill_no }}</p>
                                                                    <p><strong>Order Date:</strong> {{ $order->first()->date }}</p>
                                                                    <p><strong>Delivery Location:</strong> {{ $order->first()->location }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h6>Product Details</h6>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Product</th>
                                                                                <th>Quantity</th>
                                                                                <th>Price</th>
                                                                                <th>Subtotal</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($order as $item)
                                                                                <tr>
                                                                                    <td>{{ $item->product->title ?? 'N/A' }}</td>
                                                                                    <td>{{ $item->product_quantity ?? 1 }}</td>
                                                                                    <td>{{ $item->product->selling_price ?? 'N/A' }}</td>
                                                                                    <td>
                                                                                        {{ 
                                                                                            number_format(
                                                                                                ($item->product->selling_price ?? 0) * ($item->product_quantity ?? 1),
                                                                                                2
                                                                                            )
                                                                                        }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                                                                <td>
                                                                                    {{ 
                                                                                        number_format(
                                                                                            $order->sum(function($item) {
                                                                                                return ($item->product->selling_price ?? 0) * ($item->product_quantity ?? 1);
                                                                                            }),
                                                                                            2
                                                                                        )
                                                                                    }}
                                                                                </td>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No Orders available.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
