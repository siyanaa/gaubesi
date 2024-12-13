@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Edit SubCategory</h1>
    <form action="{{ route('subcategories.update', $subCategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Title Input --}}
        <div class="mb-3">
            <label for="title" class="form-label">SubCategory Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $subCategory->title }}" required>
        </div>

        {{-- Category Selection --}}
        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        

        {{-- Submit and Cancel Buttons --}}
        <button type="submit" class="btn btn-primary">Update SubCategory</button>
        <a href="{{ route('subcategories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
