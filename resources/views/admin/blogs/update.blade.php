@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Blog</h4>
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
                 

        <!-- Blog update form -->
        <form id="updateForm" method="POST" action="{{ route('admin.blogs.update', ['blog' => $blog->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <!-- Title -->
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $blog->title) }}" placeholder="Blog Title" required>
                </div>

                <!-- Description -->
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control summernote" id="description" required>{{ old('description', $blog->description) }}</textarea>
                </div>
                
                <!-- Keywords -->
                <div class="form-group mb-3">
                    <label for="keywords">Keywords</label>
                    <textarea name="keywords" id="keywords" class="form-control" rows="5" required>{{ old('keywords', $blog->keywords) }}</textarea>
                </div>
               
                <!-- Author -->
                <div class="form-group mb-3">
                    <label for="author">Author</label>
                    <input type="text" name="author" class="form-control" id="author" value="{{ old('author', $blog->author) }}">
                </div>

                <!-- Image Upload -->
                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <!-- Display Current Image -->
                <div class="form-group mb-3" id="current-image-container">
                    <label>Current Image:</label>
                    @if(!empty($blog->image))
                        @php
                            $images = is_string($blog->image) ? json_decode($blog->image, true) : $blog->image;
                        @endphp
                        @if(is_array($images) && count($images) > 0)
                            @foreach($images as $image)
                                <img src="{{ asset($image) }}" alt="Blog Image" style="max-width: 200px; max-height: 200px;">
                            @endforeach
                        @else
                            <p>No valid image data found.</p>
                        @endif
                    @else
                        <p>No image uploaded.</p>
                    @endif
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" name="cropData" id="cropData" value="{{ old('cropData') }}">
                <input type="hidden" name="existing_image" id="existing_image" value="{{ $blog->image }}">

                <!-- Status -->
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <div class="form-check">
                        <input type="radio" name="status" id="status_active" value="1" class="form-check-input" {{ old('status', $blog->status) == '1' ? 'checked' : '' }} required>
                        <label for="status_active" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="status" id="status_inactive" value="0" class="form-check-input" {{ old('status', $blog->status) == '0' ? 'checked' : '' }} required>
                        <label for="status_inactive" class="form-check-label">Inactive</label>
                    </div>
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
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

        function displayExistingImage() {
            const existingImage = document.getElementById('existing_image').value;
            const previewContainer = document.getElementById('image-preview-container');
            
            if (existingImage) {
                try {
                    const images = JSON.parse(existingImage);
                    if (Array.isArray(images) && images.length > 0) {
                        previewContainer.innerHTML = '';
                        images.forEach(image => {
                            const img = document.createElement('img');
                            img.src = image;
                            img.style.maxWidth = '100%';
                            img.style.maxHeight = '200px';
                            img.style.display = 'block';
                            img.style.marginBottom = '10px';
                            previewContainer.appendChild(img);
                        });
                    } else {
                        previewContainer.innerHTML = '<p>No Image Available</p>';
                    }
                } catch (e) {
                    console.error("Error parsing existing image:", e);
                    previewContainer.innerHTML = '<p>Error displaying image</p>';
                }
            } else {
                previewContainer.innerHTML = '<p>No Image Available</p>';
            }
        }

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
                    document.getElementById('existing_image').value = JSON.stringify([reader.result]);
                    displayExistingImage();
                };

                // Close modal after saving crop
                const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
                cropModal.hide();
            }, 'image/png');
        });

        // Initialize preview on page load
        window.addEventListener('load', displayExistingImage);
    </script>
@endsection
