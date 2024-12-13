@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Create Site Setting</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 p-3"
                            role="alert" aria-live="assertive" aria-atomic="true" id="toastMessage">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('sitesettings.store') }}" method="POST" enctype="multipart/form-data"
                        id="siteSettingsForm">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="office_title">Office Title</label>
                            <input type="text" name="office_title" id="office_title" class="form-control" value="{{ old('office_title') }}" required>
                        </div>

                        <!-- Office Address -->
                        <div class="form-group mb-3">
                            <label for="office_address">Office Address</label>
                            <div id="office_address_container">
                                @if(old('office_address'))
                                    @foreach(old('office_address') as $address)
                                        <div class="d-flex mb-2">
                                            <input type="text" name="office_address[]" class="form-control" value="{{ $address }}" required>
                                            <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Remove</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex mb-2">
                                        <input type="text" name="office_address[]" class="form-control" required>
                                        <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Remove</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-info btn-sm" id="add_address">Add More Address</button>
                        </div>

                        <!-- Office Contact -->
                        <div class="form-group mb-3">
                            <label for="office_contact">Office Contact</label>
                            <div id="office_contact_container">
                                @if(old('office_contact'))
                                    @foreach(old('office_contact') as $contact)
                                        <div class="d-flex mb-2">
                                            <input type="text" name="office_contact[]" class="form-control" value="{{ $contact }}" required>
                                            <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Remove</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex mb-2">
                                        <input type="text" name="office_contact[]" class="form-control" required>
                                        <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Remove</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-info btn-sm" id="add_contact">Add More Contact</button>
                        </div>

                        <!-- Office Email -->
                        <div class="form-group mb-3">
                            <label for="office_email">Office Email</label>
                            <div id="office_email_container">
                                @if(old('office_email'))
                                    @foreach(old('office_email') as $email)
                                        <div class="d-flex mb-2">
                                            <input type="email" name="office_email[]" class="form-control" value="{{ $email }}">
                                            <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Remove</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex mb-2">
                                        <input type="email" name="office_email[]" class="form-control">
                                        <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Remove</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-info btn-sm" id="add_email">Add More Email</button>
                        </div>

                        <!-- Office Description -->
                        <div class="form-group mb-3">
                            <label for="office_description">Office Description</label>
                            <textarea name="office_description" id="office_description" class="form-control" rows="5"
                                >{{ old('office_description') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="established_year">Established Year</label>
                            <input type="text" name="established_year" id="established_year" class="form-control"
                                value="{{ old('established_year') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="slogan">Slogan</label>
                            <input type="text" name="slogan" id="slogan" class="form-control"
                                value="{{ old('slogan') }}">
                        </div>

                        

                        <!-- Image Upload with Cropper.js -->
                        <div class="form-group mb-3">
                            <label for="main_logo">Main Logo</label>
                            <input type="file" name="main_logo" id="main_logo" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="side_logo">Side Logo</label>
                            <input type="file" name="side_logo" id="side_logo" class="form-control">
                        </div>

                        <!-- Crop Data Hidden Field -->
                        <input type="hidden" name="cropData" id="cropData">
                        
                        <!-- Hidden input to simulate array submission -->
                        <input type="hidden" name="image[]" id="croppedImage"> 

                        <!-- Cropped Image Preview -->
                        <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
                            <label>Cropped Image Preview:</label>
                            <img id="cropped-image-preview" style="max-width: 100%; max-height: 200px; display: block;">
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input type="radio" name="status" id="status_active" value="1" class="form-check-input" {{ old('status') == '1' ? 'checked' : '' }} required>
                                <label for="status_active" class="form-check-label">Active</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="status" id="status_inactive" value="0" class="form-check-input" {{ old('status') == '0' ? 'checked' : '' }} required>
                                <label for="status_inactive" class="form-check-label">Inactive</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Site Setting</button>
                            <a href="{{ route('sitesettings.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Image Cropping -->
<div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cropper-container" style="width: 100%; max-height: 500px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="cropImageBtn">Crop Image</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- JavaScript to dynamically add/remove fields -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function addNewField(containerId, nameAttr) {
            const container = document.getElementById(containerId);
            const field = document.createElement('div');
            field.className = 'd-flex mb-2';
            field.innerHTML = `<input type="text" name="${nameAttr}" class="form-control" required>
                               <button type="button" class="btn btn-danger btn-sm ms-2 remove-field">Remove</button>`;
            container.appendChild(field);
        }

        document.getElementById('add_address').addEventListener('click', function () {
            addNewField('office_address_container', 'office_address[]');
        });

        document.getElementById('add_contact').addEventListener('click', function () {
            addNewField('office_contact_container', 'office_contact[]');
        });

        document.getElementById('add_email').addEventListener('click', function () {
            addNewField('office_email_container', 'office_email[]');
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-field')) {
                event.target.parentElement.remove();
            }
        });

        // Initialize Bootstrap Toast
        const toastElement = document.getElementById('toastMessage');
        if (toastElement) {
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        }

        // Image Cropper logic
        let cropper;
        const imageInput = document.getElementById('main_logo');
        const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
        const cropperContainer = document.getElementById('cropper-container');

        imageInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file && /^image\/(jpe?g|png|gif)$/i.test(file.type)) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    cropperContainer.innerHTML = `<img id="imageToCrop" src="${event.target.result}" style="max-width: 100%; max-height: 500px;">`;
                    const image = document.getElementById('imageToCrop');
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 2,
                    });
                    cropModal.show();
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file.');
            }
        });

        document.getElementById('cropImageBtn').addEventListener('click', function () {
            if (cropper) {
                const croppedCanvas = cropper.getCroppedCanvas();
                const croppedImageURL = croppedCanvas.toDataURL('image/png');
                document.getElementById('cropData').value = croppedImageURL;
                document.getElementById('cropped-image-preview').src = croppedImageURL;
                document.getElementById('cropped-preview-container').style.display = 'block';
                cropModal.hide();
            }
        });
    });
</script>
@endpush
