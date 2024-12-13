@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Team Members List</h4>
                    <a href="{{ route('admin.team.create') }}" class="btn btn-primary float-end">Add New Team Member</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($teams->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teams as $team)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->position }}</td>
                                        <td>
                                            <img src="{{ asset($team->image) }}" alt="{{ $team->name }}" width="50" height="50">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.team.edit', $team->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.team.destroy', $team->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this team member?');">
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
                            No team members available. <a href="{{ route('admin.team.create') }}">Create a new team member</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection