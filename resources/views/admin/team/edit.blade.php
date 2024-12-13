@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Team Member</h4>
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

                    <!-- Form for editing a team member -->
                    <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data" id="teamForm">
                        @csrf
                        @method('PUT')

                        <!-- Name Input -->
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $team->name) }}" required>
                        </div>

                        <!-- Position Input -->
                        <div class="form-group mb-3">
                            <label for="position">Position</label>
                            <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $team->position) }}" required>
                        </div>

                        <!-- Main Image Input with Cropping -->
                        <div class="form-group mb-3">
                            <label for="main_image">Main Image</label>
                            <input type="file" id="main_image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Upload the image to be cropped.</small>
                        </div>

                        <!-- Hidden input to store the base64 string of the main image -->
                        <input type="hidden" name="croppedImage[]" id="main_image_base64" {{ $team->image ? '' : 'required' }}>

                        <!-- Cropped Main Image Preview -->
                        <div class="form-group mb-3" id="cropped-preview-container" style="display: {{ $team->image ? 'block' : 'none' }};">
                            <label>Cropped Main Image Preview:</label>
                            <img id="cropped-image-preview" src="{{ $team->image }}" style="max-width: 150px; max-height: 200px; display: block;">
                        </div>

                        <!-- Social Media Links Input -->
                        <div class="form-group mb-3">
                            <label for="social_media_links">Social Media Links</label>
                            <div id="socialMediaLinksContainer">
                                @foreach(json_decode($team->social_media_links) as $link)
                                    <div class="input-group mb-2">
                                        <input type="text" name="social_media_links[]" class="form-control" value="{{ $link }}" placeholder="Enter social media link" required>
                                        <button type="button" class="btn btn-danger" onclick="removeSocialMediaLink(this)">-</button>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-success mb-2" onclick="addSocialMediaLink()">+</button>
                            </div>
                            <small class="form-text text-muted">Click the + button to add more links.</small>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Team Member</button>
                            <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Cancel</a>
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

<!-- Include Cropper.js library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    let cropper;
    let currentFile;

    // Main image input change event
    document.getElementById('main_image').addEventListener('change', function (e) {
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

        cropper.getCroppedCanvas().toBlob((blob) => {
            const reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                // Set the base64 string of the cropped image into the hidden input
                document.getElementById('main_image_base64').value = reader.result;

                // Set cropped image preview
                const croppedImagePreview = document.getElementById('cropped-image-preview');
                croppedImagePreview.src = reader.result;
                document.getElementById('cropped-preview-container').style.display = 'block';

                // Close modal after saving crop
                const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
                cropModal.hide();
            };
        }, 'image/png');
    });

    // Form submission validation
    document.getElementById('teamForm').addEventListener('submit', function (e) {
        const croppedImageValue = document.getElementById('main_image_base64').value;

        // Check if the cropped image field is empty and a new image is being uploaded
        if (!croppedImageValue && document.getElementById('main_image').files.length > 0) {
            e.preventDefault();
            alert('Please crop the image before submitting the form.');
        }
    });

    // Add dynamic social media input field
    function addSocialMediaLink() {
        const container = document.getElementById('socialMediaLinksContainer');
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';

        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'social_media_links[]';
        input.className = 'form-control';
        input.placeholder = 'Enter social media link';
        input.required = true;

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-danger';
        removeButton.textContent = '-';
        removeButton.onclick = function () {
            container.removeChild(inputGroup);
        };

        inputGroup.appendChild(input);
        inputGroup.appendChild(removeButton);
        container.appendChild(inputGroup);
    }

    // Remove dynamic social media input field
    function removeSocialMediaLink(button) {
        button.parentElement.remove();
    }
</script>
@endsection