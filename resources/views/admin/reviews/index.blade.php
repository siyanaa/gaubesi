@extends('admin.layouts.master')


@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Reviews and Ratings</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($reviews->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Product Title</th>
                                    <th>Price</th>
                                    <th>Reviews</th>
                                    <th>Ratings</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ e($review->name) }}</td>
                                        <td>{{ e($review->email) }}</td>
                                        <td>{{ e($review->product->title ?? 'N/A') }}</td>
                                        <td>{{ e($review->product->selling_price ?? 'N/A') }}</td>
                                        <td>{{ e(Str::limit($review->reviews, 50)) }}</td>
                                        <td>{{ $review->ratings }}</td>
                                        <td>{{ ucfirst($review->status) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewMessageModal{{ $review->id }}">
                                                View
                                            </button>
                                            <div class="modal fade" id="viewMessageModal{{ $review->id }}" tabindex="-1" aria-labelledby="viewMessageModalLabel{{ $review->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewMessageModalLabel{{ $review->id }}">Reviews from {{ $review->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Email:</strong> {{ $review->email }}</p>
                                                            <p><strong>Review:</strong> {{ $review->reviews }}</p>
                                                            <p><strong>Ratings:</strong> {{ $review->ratings }} Stars</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn btn-outline-success btn-sm">Accept</button>
                                            </form>
                                            <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Reject</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No Reviews available.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



