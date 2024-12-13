@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Add New FAQ</h4>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary float-end">Back to FAQs List</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.faqs.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="question">Question</label>
                            <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="answer">Answer</label>
                            <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ old('answer') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add FAQ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection