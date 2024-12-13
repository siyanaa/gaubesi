@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Advertisement</h4>
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

                    <form action="{{ route('admin.advertisements.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required>{{ old('description', $advertisement->description) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="link">Link</label>
                            <input type="url" name="link" id="link" class="form-control" value="{{ old('link', $advertisement->link) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Current Image:</label>
                            @if($advertisement->image && Storage::disk('public')->exists($advertisement->image))
                            <img src="{{ asset('' . $advertisement->image) }}" alt="Advertisement Image" class="col-md-4 lgimage order-md-2 order-1">
                                     
                            @else
                                <p class="text-muted">No image currently set</p>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">New Image (optional)</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <small class="text-muted">Maximum file size: 2MB. Supported formats: JPG, JPEG, PNG, GIF</small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Advertisement</button>
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
                <img id="image-preview" style="width: 100%; display: none;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveCrop" class="btn btn-primary">Save Crop</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    let cropper;
    let currentFile;

    document.getElementById('image').addEventListener('change', function (e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            currentFile = files[0];
            const url = URL.createObjectURL(currentFile);
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = url;
            imagePreview.style.display = 'block';

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

    document.getElementById('saveCrop').addEventListener('click', function () {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas();
        if (canvas) {
            const croppedImageUrl = canvas.toDataURL();
            // Create a new file input element
            const newInput = document.createElement('input');
            newInput.type = 'hidden';
            newInput.name = 'cropped_image';
            newInput.value = croppedImageUrl;
            document.querySelector('form').appendChild(newInput);
            
            // Show preview
            const previewContainer = document.createElement('div');
            previewContainer.className = 'mt-3';
            previewContainer.innerHTML = `
                <label>Cropped Image Preview:</label>
                <img src="${croppedImageUrl}" class="img-thumbnail" style="max-width: 200px;">
            `;
            document.querySelector('.form-group:last-of-type').before(previewContainer);
        }

        const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
        cropModal.hide();
    });
</script>
@endpush
@endsection