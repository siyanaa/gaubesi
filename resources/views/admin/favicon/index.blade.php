@extends('admin.layouts.master')

@section('content')
    @include('admin.includes.forms')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            {{-- <a href="{{ route('favicons.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Add Favicon
            </a> --}}
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Apple Touch Icon</th>
                <th>Favicon ICO</th>
                <th>Favicon 16x16</th>
                <th>Favicon 32x32</th>
                
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($icons as $icon)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $icon->appletouch_icon) }}" style="width: 150px; height: 150px;">
                </td>
                <td>
                    <img src="{{ asset('storage/' . $icon->favicon_ico) }}" style="width: 150px; height: 150px;">
                </td>
                <td>
                    <img src="{{ asset('storage/' . $icon->favicon_sixteen) }}" style="width: 150px; height: 150px;">
                </td>
                <td>
                    @if ($icon->favicon_thirtytwo)
                        <img src="{{ asset('storage/' . $icon->favicon_thirtytwo) }}" style="width: 150px; height: 150px;">
                    @else
                        <span>No Favicon 32x32 Found</span>
                    @endif
                </td>
                {{-- <td>
                    @if ($icon->site_manifest)
                        @php
                            $filePath = storage_path('app/public/' . $icon->site_manifest);
                            $manifestContent = file_exists($filePath) ? file_get_contents($filePath) : 'File not found.';
                        @endphp
                        <pre style="width: 300px; height: 300px; overflow: auto; border: 1px solid #ccc; padding: 10px; white-space: pre-wrap;">{{ $manifestContent }}</pre>
                        <a href="{{ asset('storage/' . $icon->site_manifest) }}" download class="btn btn-primary btn-sm mt-2">Download Site Manifest</a>
                    @else
                        <span>No Site Manifest Found</span>
                    @endif
                </td> --}}
                <td>
                    <a href="{{ route('favicons.edit', $icon->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                </td>
            </tr>
        @endforeach
        
        </tbody>
    </table>

    <script>
        var myModal = document.getElementById('myModal');
        var myInput = document.getElementById('myInput');

        if (myModal) {
            myModal.addEventListener('shown.bs.modal', function() {
                myInput.focus();
            });
        }
    </script>
@endsection
