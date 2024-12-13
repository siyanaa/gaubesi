@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User's Favorite Properties</h4>
                   
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($favorites->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>ProductTitle</th>
                                    
                                    <th>Date Added</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($favorites as $favorite)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ e($favorite->name) }}</td>  
                                        <td>{{ e($favorite->email) }}</td> 
                                        <td>{{ e($favorite->product->title ?? 'N/A') }}</td> 
                                        <td>{{ $favorite->created_at->format('d M Y') }}</td> 
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No favorite products available.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
