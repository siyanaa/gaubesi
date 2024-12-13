@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Messages</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($contacts->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ Str::limit($contact->message, 50) }}</td>
                                        
                                        {{-- <td>
                                            @if($contact->inspection && $contact->property)
                                                {{ $contact->property->name ?? 'Property #' . $contact->property->id }}
                                            @else
                                                N/A
                                            @endif
                                        </td> --}}
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewMessageModal{{ $contact->id }}">
                                                View
                                            </button>

                                            <div class="modal fade" id="viewMessageModal{{ $contact->id }}" tabindex="-1" aria-labelledby="viewMessageModalLabel{{ $contact->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewMessageModalLabel{{ $contact->id }}">Message from {{ $contact->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                                                            <p><strong>Message:</strong> {{ $contact->message }}</p>
                                                            
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
                            No contact messages available.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection