@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Edit Category</h1>

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

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $category->title }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $category->description }}" required>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <!-- Display Current Image -->
        <div class="mb-3" id="current-image-container">
            <label>Current Image:</label>
            @if(!empty($category->image))
            <img src="{{ asset('' . $category->mainImagePath) }}" alt="{{ $category->title }}" class="smimage">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <!-- Hidden Fields for Cropping Data -->
        <input type="hidden" name="cropData" id="cropData" value="{{ old('cropData') }}">
        <input type="hidden" name="existing_image" id="existing_image" value="{{ $category->image }}">

        <!-- Submit and Cancel Buttons -->
        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <!-- Modal for Image Cropping -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="image-preview" style="width: 100%; display: none;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveCrop" class="btn btn-primary">Save Crop</button>
                </div>
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

    // Initialize Cropper.js for new image upload
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
            y: Math.round(cropData.y),
        });

        cropper.getCroppedCanvas().toBlob((blob) => {
            const reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                document.getElementById('existing_image').value = reader.result;
                displayExistingImage(reader.result);
            };

            // Close modal after saving crop
            const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
            cropModal.hide();
        }, 'image/png');
    });

    // Function to display the existing or cropped image preview
    function displayExistingImage(src) {
        const currentImageContainer = document.getElementById('current-image-container');
        currentImageContainer.innerHTML = `<img src="${src}" alt="Category Image" style="max-width: 200px; max-height: 200px;">`;
    }

    // Initialize preview on page load if an existing image is present
    window.addEventListener('load', () => {
        const existingImage = document.getElementById('existing_image').value;
        if (existingImage) {
            displayExistingImage(existingImage);
        }
    });
</script>
@endsection
