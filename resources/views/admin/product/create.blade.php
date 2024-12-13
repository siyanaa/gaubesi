@extends('admin.layouts.master')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="card-header">
                    <h4>Create New Product</h4>
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

                    <!-- Product creation form -->
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                        @csrf
                        <input type="hidden" name="cropData" id="cropData">
                        <input type="hidden" name="main_image_cropped" id="croppedImage">

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-8 p-4 bg-white rounded shadow-sm">

                                 <!-- Name -->
                                 <div class="form-group mb-3">
                                    <label for="title">Company</label>
                                    <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name') }}" required>
                                </div>

                                <!-- Title -->
                                <div class="form-group mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                </div>

                                <!-- Description -->
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                                </div>

                                <!-- Main Image Upload -->
                                <div class="form-group mb-3">
                                    <label for="main_image">Main Image</label>
                                    <input type="file" id="main_image" class="form-control" required>
                                </div>

                                <!-- Hidden input for main image -->
                                <input type="hidden" name="main_image[0]" id="main_image_base64" required>

                                <!-- Cropped Main Image Preview -->
                                <div class="form-group mb-3" id="cropped-preview-container" style="display: none;">
                                    <label>Cropped Main Image Preview:</label>
                                    <img id="cropped-image-preview" style="max-width: 150px; max-height: 200px; display: block;">
                                </div>

                                <!-- Other Images Upload -->
                                <div class="form-group mb-3">
                                    <label for="other_images">Other Images</label>
                                    <input type="file" id="other_images" class="form-control" name="other_images[]" multiple>
                                </div>

                                <!-- Other Images Preview -->
                                <div class="form-group mb-3" id="other-images-preview-container" style="display: none;">
                                    <label>Selected Other Images Preview:</label>
                                    <div id="other-images-preview" style="display: flex; flex-wrap: wrap;"></div>
                                </div>

                                 <!-- Brand -->
                                 <div class="form-group mb-3">
                                    <label for="brand">Brand</label>
                                    <input type="text" name="brand" id="brand" class="form-control" value="{{ old('brand') }}" >
                                </div>

                                <!-- Flavour -->
                                <div class="form-group mb-3">
                                    <label for="flavour">Flavour</label>
                                    <input type="text" name="flavour" id="flavour" class="form-control" value="{{ old('flavour') }}" >
                                </div>

                                <!-- Location -->
                                <div class="form-group mb-3">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}" >
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-4 p-4 bg-light rounded shadow-sm">
                                <!-- Category -->
                                <div class="form-group mb-3">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Choose Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Sub Category -->
                                <div class="form-group mb-3">
                                    <label for="sub_category_id">Sub Category</label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                        <option value="">Choose Sub Category</option>
                                        @foreach($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" {{ old('sub_category_id') == $subCategory->id ? 'selected' : '' }}>
                                                {{ $subCategory->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Cost Price -->
                                <div class="form-group mb-3">
                                    <label for="cost_price">Cost Price</label>
                                    <input type="text" name="cost_price" id="cost_price" class="form-control" value="{{ old('cost_price') }}" required>
                                </div>

                                <!-- Selling Price -->
                                <div class="form-group mb-3">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="text" name="selling_price" id="selling_price" class="form-control" value="{{ old('selling_price') }}" required>
                                </div>

                                <!-- Weight -->
                                <div class="form-group mb-3">
                                    <label for="weight">Weight</label>
                                    <input type="text" name="weight" id="weight" class="form-control" value="{{ old('weight') }}" required>
                                </div>

                                <!-- Quantity -->
                                <div class="form-group mb-3">
                                    <label for="product_quantity">Quantity</label>
                                    <input type="text" name="product_quantity" id="product_quantity" class="form-control" value="{{ old('product_quantity') }}" required>
                                </div>


                                <!-- Availability Status -->
                                <div class="form-group mb-3">
                                    <label for="availability_status">Availability Status</label>
                                    <select name="availability_status" id="availability_status" class="form-control" required>
                                        <option value="available" {{ old('availability_status') == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="sold" {{ old('availability_status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                       
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="form-group mb-3">
                                    <label>Status</label>
                                    <div class="gap-2">
                                        <div class="form-check">
                                            <input type="radio" name="status" id="status_active" value="1" class="form-check-input" {{ old('status') == '1' ? 'checked' : '' }} required>
                                            <label for="status_active" class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="status" id="status_inactive" value="0" class="form-check-input" {{ old('status') == '0' ? 'checked' : '' }} required>
                                            <label for="status_inactive" class="form-check-label">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Buttons -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Product</button>
                                <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
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
                document.getElementById('main_image_base64').value = reader.result;


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




    // Preview for other images
    document.getElementById('other_images').addEventListener('change', function (e) {
        const files = e.target.files;
        const previewContainer = document.getElementById('other-images-preview');
        previewContainer.innerHTML = ''; // Clear previous previews
        document.getElementById('other-images-preview-container').style.display = 'block';


        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '100px';
                img.style.margin = '5px';
                img.style.border = '1px solid #ccc';
                img.style.padding = '2px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });


    // Show toast message after form submission
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.toast')) {
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        }
    });
    // document.getElementById('update_time').addEventListener('change', function () {
    //     const date = new Date(this.value);
    //     const formattedDate = date.toLocaleDateString('en-US', {
    //         year: 'numeric',
    //         month: 'long',
    //         day: '2-digit',
    //     }).replace(',', ''); // Format to "Y - F - d"


    //     this.value = `${date.getFullYear()} - ${date.toLocaleString('default', { month: 'long' })} - ${date.getDate().toString().padStart(2, '0')}`;
    // });
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const subCategorySelect = document.getElementById('sub_category_id');
       
        // Object to store all subcategories grouped by category ID
        const subCategories = @json($subCategories->groupBy('category_id'));


        categorySelect.addEventListener('change', function() {
            const selectedCategoryId = this.value;
           
            // Clear current options
            subCategorySelect.innerHTML = '<option value="">Choose Sub Category</option>';
           
            if (selectedCategoryId && subCategories[selectedCategoryId]) {
                subCategories[selectedCategoryId].forEach(function(subCategory) {
                    const option = new Option(subCategory.title, subCategory.id);
                    subCategorySelect.add(option);
                });
            }
        });


        // Trigger change event on page load if a category is already selected (e.g., old input after validation error)
        if (categorySelect.value) {
            categorySelect.dispatchEvent(new Event('change'));
        }
    });


</script>
@endsection