@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Policies List</h4>
                    <a href="{{ route('termsandconditions.create') }}" class="btn btn-primary float-end">Add New Policy</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($termsandconditions->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Policy Type</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($termsandconditions as $policy)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $policy->policy_type }}</td>
                                        <td>
                                            <ul>
                                                @foreach(json_decode($policy->description) as $desc)
                                                    <li>{{ $desc }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('termsandconditions.edit', $policy->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('termsandconditions.destroy', $policy->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this policy?');">
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
                            No policies available. <a href="{{ route('termsandconditions.create') }}">Create a new policy</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
