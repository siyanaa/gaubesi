@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product List</h4>
                    <a href="{{ route('product.create') }}" class="btn btn-primary float-end">Add New
                        Prduct</a>
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

                    @if($products->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Selling Price</th>
                                    <th>Cost Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->category->title }}</td>
                                        <td>{{ $product->subCategory->title }}</td>
                                        
                                        <td>${{ number_format($product->selling_price, 2) }}</td>
                                        <td>${{ number_format($product->cost_price, 2) }}</td>

                                        <td>
                                            @if($product->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>

                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>

                                            <!-- Image Modal -->

                                                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#imageModal{{ $product->id }}">
                                                    I
                                                </button>
    
                                            <div class="modal fade" id="imageModal{{ $product->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $product->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="imageModalLabel{{ $product->id }}">Edit Product Images</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{-- <form action="{{ route('product.updateImages', $product->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="main_image">Main Image</label>
                                                                    <input type="file" id="main_image" name="main_image" class="form-control">
                                                                </div>
                                                            
                                                                <!-- Cropped Main Image Preview -->
                                                                <div class="form-group mb-3" id="cropped-preview-container"
                                                                                                                        style="display: none;">
                                                                                                                        <label>Cropped Main Image Preview:</label>
                                                                                                                        <img id="cropped-image-preview"
                                                                                                                            style="max-width: 150px; max-height: 200px; display: block;">
                                                                                                                    </div>
                                                            
                                                                <!-- Hidden input to store the base64 string of the cropped image -->
                                                                <input type="hidden" name="main_image_base64" id="main_image_base64">
                                                            
                                                                <!-- Cropping Modal -->
                                                                <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
                                                                    {{-- <div class="modal-dialog modal-lg"> --}}
                                                                        
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
                                                            
                                                                <div class="form-group mb-3">
                                                                    <label for="other_images">Other Images</label>
                                                                    <input type="file" id="other_images" class="form-control" name="other_images[]" multiple>
                                                                </div>
                                                            
                                                               <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                   

                                     <!-- Button to trigger Offer Modal -->
                                   <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#offerModal{{ $product->id }}">
                                     O
                                   </button>

                                    <!-- Offer Modal with Create/Edit Form -->
                                   <div class="modal fade" id="offerModal{{ $product->id }}" tabindex="-1" aria-labelledby="offerModalLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                     <div class="modal-content" style="min-height: 300px;">
                                       <div class="modal-header">
                                         <h5 class="modal-title" id="offerModalLabel{{ $product->id }}">
                                          {{ $product->offer ? 'Edit' : 'Create' }} Offer for {{ $product->title }}
                                         </h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                      <div class="modal-body">
                                        <form action="{{ route('offers.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            
                                            <div class="form-group mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="featured_product" id="featured_product{{ $product->id }}" value="1" 
                                                        {{ $product->offer && $product->offer->featured_product == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="featured_product{{ $product->id }}">Featured</label>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="offered_product" id="offered_product{{ $product->id }}" value="1" 
                                                        {{ $product->offer && $product->offer->offered_product == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="offered_product{{ $product->id }}">Special Offer</label>
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="daydeal" id="daydeal{{ $product->id }}" value="1" 
                                                        {{ $product->offer && $product->offer->daydeal == 'Yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="daydeal{{ $product->id }}">Deal Of The Day</label>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group mt-4">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>                                        
                                 </div>
                                     </div>
                                     </div>
                                   </div>
                               </td>
                             </tr>
                  @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    No products available. <a href="{{ route('product.create') }}">Create a new product</a>.
                </div>
            @endif
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

            // Initialize Cropper.js
            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(imagePreview, {
                aspectRatio: 16 / 9, // You can change the aspect ratio as needed
                viewMode: 1,
            });
        }
    });
    document.getElementById('other_images').addEventListener('change', function (e) {
        const files = e.target.files;
        const previewContainer = document.getElementById('other-images-preview');
        previewContainer.innerHTML = ''; // Clear previous previews
        document.getElementById('other-images-preview-container').style.display = 'block'; // Show the preview container

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


</script>
@endsection