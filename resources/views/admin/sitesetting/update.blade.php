@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Update Site Setting</h4>
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

                    <form action="{{ route('sitesettings.update', $siteSetting->id) }}" method="POST" enctype="multipart/form-data" id="siteSettingsForm">
                        @csrf
                        @method('PUT')
                    

                        <div class="form-group mb-3">
                            <label for="office_title">Office Title</label>
                            <input type="text" name="office_title" id="office_title" class="form-control" value="{{ old('office_title', $siteSetting->office_title) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Office Address</label>
                            <div id="office_address_container">
                                @foreach(old('office_address', json_decode($siteSetting->office_address, true) ?? []) as $index => $address)
                                    <div class="input-group mb-2">
                                        <input type="text" name="office_address[]" class="form-control" value="{{ $address }}" required>
                                        <button type="button" class="btn btn-outline-secondary add-field" data-target="office_address">+</button>
                                        @if($index > 0)
                                            <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Office Contact</label>
                            <div id="office_contact_container">
                                @foreach(old('office_contact', json_decode($siteSetting->office_contact, true) ?? []) as $index => $contact)
                                    <div class="input-group mb-2">
                                        <input type="text" name="office_contact[]" class="form-control" value="{{ $contact }}" required>
                                        <button type="button" class="btn btn-outline-secondary add-field" data-target="office_contact">+</button>
                                        @if($index > 0)
                                            <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label>Office Email</label>
                            <div id="office_email_container">
                                @foreach(old('office_email', json_decode($siteSetting->office_email, true) ?? []) as $index => $email)
                                    <div class="input-group mb-2">
                                        <input type="email" name="office_email[]" class="form-control" value="{{ $email }}" required>
                                        <button type="button" class="btn btn-outline-secondary add-field" data-target="office_email">+</button>
                                        @if($index > 0)
                                            <button type="button" class="btn btn-outline-danger remove-field">-</button>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="office_description">Office Description</label>
                            <textarea name="office_description" id="office_description" class="form-control" rows="5">{{ old('office_description', $siteSetting->office_description) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="established_year">Established Year</label>
                            <input type="text" name="established_year" id="established_year" class="form-control"
                                value="{{ old('established_year', $siteSetting->established_year) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="slogan">Slogan</label>
                            <input type="text" name="slogan" id="slogan" class="form-control"
                                value="{{ old('slogan', $siteSetting->slogan) }}">
                        </div>

                        <!-- Main Logo Upload -->
    <div class="form-group mb-3">
        <label for="main_logo">Main Logo</label>
        <input type="file" name="main_logo" id="main_logo" class="form-control" accept="image/*">
        @if($siteSetting->main_logo)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $siteSetting->main_logo) }}" alt="Current Main Logo" style="max-width: 200px; height: auto;">
            </div>
        @endif
    </div>

    <!-- Side Logo Upload -->
    <div class="form-group mb-3">
        <label for="side_logo">Side Logo</label>
        <input type="file" name="side_logo" id="side_logo" class="form-control" accept="image/*">
        @if($siteSetting->side_logo)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $siteSetting->side_logo) }}" alt="Current Side Logo" style="max-width: 200px; height: auto;">
            </div>
        @endif
    </div>

    <!-- Hidden inputs for cropped images -->
    <input type="hidden" name="main_logo_cropped" id="main_logo_cropped">
    <input type="hidden" name="side_logo_cropped" id="side_logo_cropped">
    <input type="hidden" name="main_logo_crop_data" id="main_logo_crop_data">
    <input type="hidden" name="side_logo_crop_data" id="side_logo_crop_data">
    
                        <!-- Cropped Image Previews -->
                        <div class="form-group mb-3" id="main-logo-preview-container" style="display: none;">
                            <label>Cropped Main Logo Preview:</label>
                            <img id="main-logo-preview" style="max-width: 200px; height: auto; display: block;">
                        </div>
                        <div class="form-group mb-3" id="side-logo-preview-container" style="display: none;">
                            <label>Cropped Side Logo Preview:</label>
                            <img id="side-logo-preview" style="max-width: 200px; height: auto; display: block;">
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <input type="radio" name="status" id="status_active" value="1" class="form-check-input" {{ old('status', $siteSetting->status) ? 'checked' : '' }} required>
                                <label for="status_active" class="form-check-label">Active</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="status" id="status_inactive" value="0" class="form-check-input" {{ old('status', $siteSetting->status) ? '' : 'checked' }} required>
                                <label for="status_inactive" class="form-check-label">Inactive</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Site Setting</button>
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
                <img id="image-preview" style="max-width: 100%; max-height: 400px; display: block;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveCrop" class="btn btn-primary">Save Crop</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Cropper.js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    let cropper;
    let currentFile;
    let currentImageType;

    // Image file input change event for both logos
    document.getElementById('main_logo').addEventListener('change', function(e) {
        handleImageUpload(e, 'main_logo');
    });

    document.getElementById('side_logo').addEventListener('change', function(e) {
        handleImageUpload(e, 'side_logo');
    });

    function handleImageUpload(e, imageType) {
        const files = e.target.files;
        if (files && files.length > 0) {
            currentFile = files[0];
            currentImageType = imageType;
            const url = URL.createObjectURL(currentFile);
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = url;

            // Show the crop modal
            const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
            cropModal.show();

            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(imagePreview, {
                aspectRatio: 16 / 9,
                viewMode: 1,
            });
        }
    }

    // Save cropped image data and update hidden input fields
    document.getElementById('saveCrop').addEventListener('click', function () {
        const cropData = cropper.getData();
        const cropDataString = JSON.stringify({
            width: Math.round(cropData.width),
            height: Math.round(cropData.height),
            x: Math.round(cropData.x),
            y: Math.round(cropData.y)
        });

        const base64Image = cropper.getCroppedCanvas().toDataURL('image/png');

        if (currentImageType === 'main_logo') {
            document.getElementById('main_logo_cropped').value = base64Image;
            document.getElementById('main_logo_crop_data').value = cropDataString;
            document.getElementById('main-logo-preview').src = base64Image;
            document.getElementById('main-logo-preview-container').style.display = 'block';
        } else if (currentImageType === 'side_logo') {
            document.getElementById('side_logo_cropped').value = base64Image;
            document.getElementById('side_logo_crop_data').value = cropDataString;
            document.getElementById('side-logo-preview').src = base64Image;
            document.getElementById('side-logo-preview-container').style.display = 'block';
        }

        // Close modal after saving crop
        const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
        cropModal.hide();
    });

    // Show toast message after form submission
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.toast')) {
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        }
    });

    // Function to add new field
    function addField(container, fieldName) {
        const newField = document.createElement('div');
        newField.className = 'input-group mb-2';
        newField.innerHTML = `
            <input type="${fieldName === 'office_email' ? 'email' : 'text'}" name="${fieldName}[]" class="form-control" required>
            <button type="button" class="btn btn-outline-secondary add-field" data-target="${fieldName}">+</button>
            <button type="button" class="btn btn-outline-danger remove-field">-</button>
        `;
        container.appendChild(newField);
    }

    // Add field event listener
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('add-field')) {
            const targetContainer = document.getElementById(e.target.dataset.target + '_container');
            addField(targetContainer, e.target.dataset.target);
        }
    });

    // Remove field event listener
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-field')) {
            e.target.closest('.input-group').remove();
        }
    });

    // Initialize empty fields if none exist
    document.addEventListener('DOMContentLoaded', function() {
        const containers = ['office_address', 'office_contact', 'office_email'];
        containers.forEach(function(container) {
            const containerElement = document.getElementById(container + '_container');
            if (containerElement.children.length === 0) {
                addField(containerElement, container);
            }
        });
    });
</script>
@endsection