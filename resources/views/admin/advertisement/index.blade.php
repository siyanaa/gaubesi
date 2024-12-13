@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Advertisements List</h4>
                    <a href="{{ route('admin.advertisements.create') }}" class="btn btn-primary float-end">Add New Advertisement</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($advertisements->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($advertisements as $advertisement)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        
                                        <td>{{ $advertisement->description }}</td>
                                        <td>
                                           {{$advertisement->link}} 
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.advertisements.edit', $advertisement->id) }}" 
                                               class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.advertisements.destroy', $advertisement->id) }}" 
                                                  method="POST" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this advertisement?');">
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
                            No advertisements available. 
                            <a href="{{ route('admin.advertisements.create') }}">Create a new advertisement</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection