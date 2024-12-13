@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Policy</h4>
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

                    <form action="{{ route('termsandconditions.store') }}" method="POST">
                        @csrf

                        {{-- Policy Type Input --}}
                        <div class="form-group mb-3">
                            <label for="policy_type">Type of Policy</label>
                            <select name="policy_type" id="policy_type" class="form-control" required>
                                <option value="Our Policy">Our Policy</option>
                                <option value="Return Policy">Return Policy</option>
                                <option value="Return Condition">Return Condition</option>
                                <option value="Terms and Conditions">Terms and Conditions</option>
                            </select>
                        </div>

                        {{-- Description Fields --}}
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <div id="description-container">
                                <div class="input-group mb-2">
                                    <textarea name="description[]" class="form-control" required></textarea>
                                    <button type="button" class="btn btn-success" onclick="addDescriptionField()">+</button>
                                </div>
                            </div>
                        </div>

                        {{-- Submit and Cancel Buttons --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Policy</button>
                            <a href="{{ route('termsandconditions.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to add new description fields dynamically
    function addDescriptionField() {
        const container = document.getElementById('description-container');
        const newField = document.createElement('div');
        newField.classList.add('input-group', 'mb-2');
        newField.innerHTML = `
            <textarea name="description[]" class="form-control" required></textarea>
            <button type="button" class="btn btn-danger" onclick="removeDescriptionField(this)">-</button>
        `;
        container.appendChild(newField);
    }

    // JavaScript function to remove a description field
    function removeDescriptionField(button) {
        button.parentElement.remove();
    }
</script>
@endsection
