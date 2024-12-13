@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>SubCategories List</h4>
                    <a href="{{ route('subcategories.create') }}" class="btn btn-primary float-end">Add New SubCategory</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($subCategories->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subCategories as $subCategory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subCategory->title }}</td>
                                        <td>{{ $subCategory->category->title }}</td>
                                        
                                        <td>
                                            <a href="{{ route('subcategories.edit', $subCategory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('subcategories.destroy', $subCategory->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No subcategories available. <a href="{{ route('subcategories.create') }}">Create a new subcategory</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
