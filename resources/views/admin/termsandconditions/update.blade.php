@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Policy</h4>
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

                    <form action="{{ route('termsandconditions.update', $policy->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Policy Type Input --}}
                        <div class="form-group mb-3">
                            <label for="policy_type">Type of Policy</label>
                            <select name="policy_type" id="policy_type" class="form-control" required>
                                <option value="Our Policy" {{ $policy->policy_type == 'Our Policy' ? 'selected' : '' }}>Our Policy</option>
                                <option value="Return Policy" {{ $policy->policy_type == 'Return Policy' ? 'selected' : '' }}>Return Policy</option>
                                <option value="Return Condition" {{ $policy->policy_type == 'Return Condition' ? 'selected' : '' }}>Return Condition</option>
                                <option value="Terms and Conditions" {{ $policy->policy_type == 'Terms and Conditions' ? 'selected' : '' }}>Terms and Conditions</option>
                            </select>
                        </div>

                        {{-- Description Fields --}}
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <div id="description-container">
                                @foreach(json_decode($policy->description) as $desc)
                                    <div class="input-group mb-2">
                                        <textarea name="description[]" class="form-control" required>{{ $desc }}</textarea>
                                        <button type="button" class="btn btn-danger" onclick="removeDescriptionField(this)">-</button>
                                    </div>
                                @endforeach
                                <div class="input-group mb-2">
                                    <button type="button" class="btn btn-success" onclick="addDescriptionField()">+</button>
                                </div>
                            </div>
                        </div>

                        {{-- Submit and Cancel Buttons --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Policy</button>
                            <a href="{{ route('termsandconditions.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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

    function removeDescriptionField(button) {
        button.parentElement.remove();
    }
</script>
@endsection
