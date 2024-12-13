@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Advertisement</h4>
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

                    <form action="{{ route('admin.advertisements.store') }}" method="POST" enctype="multipart/form-data" id="advertisementForm">
                        @csrf
                        <input type="hidden" name="cropData" id="cropData">
                        <input type="hidden" name="image_cropped" id="croppedImage">

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="link">Link</label>
                            <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" id="image" class="form-control" accept="image/*" required>
                            <small class="text-muted">Maximum file size: 2MB. Supported formats: JPG, JPEG, PNG, GIF</small>
                        </div>

                        <!-- Hidden input for image -->
                        <input type="hidden" name="image[0]" id="image_base64" required>

                        <!-- Cropped Image Preview -->
                        <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
                            <label>Cropped Image Preview:</label>
                            <img id="cropped-image-preview" style="max-width: 150px; max-height: 200px; display: block;">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Advertisement</button>
                            <a href="{{ route('admin.advertisements.index') }}" class="btn btn-secondary">Cancel</a>
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
                <img id="image-preview" style="width: 100%; height: auto; display: none;">
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

    // Image input change event
    document.getElementById('image').addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            currentFile = files[0];
            const url = URL.createObjectURL(currentFile);
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = url;
            imagePreview.style.display = 'block';

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
    });

    // Save cropped image data and update hidden input fields
    document.getElementById('saveCrop').addEventListener('click', function () {
        if (!cropper) return;

        const cropData = cropper.getData();
        document.getElementById('cropData').value = JSON.stringify({
            width: Math.round(cropData.width),
            height: Math.round(cropData.height),
            x: Math.round(cropData.x),
            y: Math.round(cropData.y)
        });

        cropper.getCroppedCanvas().toBlob((blob) => {
            const reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                // Set the base64 string of the cropped image into the hidden input
                document.getElementById('image_base64').value = reader.result;

                // Set cropped image preview
                const croppedImagePreview = document.getElementById('cropped-image-preview');
                croppedImagePreview.src = reader.result;
                document.getElementById('cropped-preview-container').style.display = 'block';
            };

            // Close modal after saving crop
            const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
            cropModal.hide();
        }, 'image/png');
    });

    // Show toast message after form submission
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.toast')) {
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        }
    });
</script>
@endsection