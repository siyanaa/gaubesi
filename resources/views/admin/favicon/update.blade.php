@extends('admin.layouts.master')

@section('content')
    @include('admin.includes.forms')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Edit Favicon</h1>
        </div>
    
        <div class="container-fluid">
            <form id="quickForm" method="POST" action="{{ route('favicons.update', $favicon->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $favicon->id ?? '' }}">
                <input type="hidden" name="cropData" id="cropData">

                <div class="card-body">

                    <!-- Favicon 32x32 -->
                    <div class="form-group">
                        <label for="favicon_thirtytwo">Favicon 32x32</label><span style="color:red; font-size:large">*</span>
                        <input type="file" name="favicon_thirtytwo" class="form-control" id="favicon_thirtytwo" onchange="previewAndCropImage(event, 'favicon_thirtytwo')">
                        @if ($favicon->favicon_thirtytwo)
                            <img src="{{ asset('storage/' . $favicon->favicon_thirtytwo) }}" id="favicon_thirtytwo_preview" style="max-width: 500px; max-height:500px" />
                        @endif
                        <span>{{ $favicon->favicon_thirtytwo ?? old('favicon_thirtytwo') }}</span>
                    </div>

                    <!-- Favicon 16x16 -->
                    <div class="form-group">
                        <label for="favicon_sixteen">Favicon 16x16</label><span style="color:red; font-size:large">*</span>
                        <input type="file" name="favicon_sixteen" class="form-control" id="favicon_sixteen" onchange="previewAndCropImage(event, 'favicon_sixteen')">
                        @if ($favicon->favicon_sixteen)
                            <img src="{{ asset('storage/' . $favicon->favicon_sixteen) }}" id="favicon_sixteen_preview" style="max-width: 500px; max-height:500px" />
                        @endif
                        <span>{{ $favicon->favicon_sixteen ?? old('favicon_sixteen') }}</span>
                    </div>

                    <!-- Favicon ICO -->
                    <div class="form-group">
                        <label for="favicon_ico">Favicon ICO</label><span style="color:red; font-size:large">*</span>
                        <input type="file" name="favicon_ico" class="form-control" id="favicon_ico" onchange="previewAndCropImage(event, 'favicon_ico')">
                        @if ($favicon->favicon_ico)
                            <img src="{{ asset('storage/' . $favicon->favicon_ico) }}" id="favicon_ico_preview" style="max-width: 500px; max-height:500px" />
                        @endif
                        <span>{{ $favicon->favicon_ico ?? old('favicon_ico') }}</span>
                    </div>

                    <!-- Apple Touch Icon -->
                    <div class="form-group">
                        <label for="appletouch_icon">Apple Touch Icon</label><span style="color:red; font-size:large">*</span>
                        <input type="file" name="appletouch_icon" class="form-control" id="appletouch_icon" onchange="previewAndCropImage(event, 'appletouch_icon')">
                        @if ($favicon->appletouch_icon)
                            <img src="{{ asset('storage/' . $favicon->appletouch_icon) }}" id="appletouch_icon_preview" style="max-width: 500px; max-height:500px" />
                        @endif
                        <span>{{ $favicon->appletouch_icon ?? old('appletouch_icon') }}</span>
                    </div>

                    <!-- Site Manifest -->
                    <div class="form-group">
                        <label for="site_manifest">Site Manifest</label><span style="color:red; font-size:large">*</span>
                        <input type="file" name="site_manifest" class="form-control" id="site_manifest">
                        @if ($favicon->site_manifest)
                            <img src="{{ asset('storage/' . $favicon->site_manifest) }}" id="site_manifest_preview" style="max-width: 500px; max-height:500px" />
                        @endif
                        <span>{{ $favicon->site_manifest ?? old('site_manifest') }}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
                    <img id="image-preview" style="max-width: 100%; max-height: 500px;">
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
        let currentFileInput;

        function previewAndCropImage(event, inputId) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                const imagePreview = document.getElementById('image-preview');
                imagePreview.src = url;

                // Show the crop modal
                const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
                cropModal.show();

                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(imagePreview, {
                    aspectRatio: 1, // Adjust aspect ratio as needed
                    viewMode: 1,
                });

                currentFileInput = inputId;
            }
        }

        document.getElementById('saveCrop').addEventListener('click', function () {
            if (cropper) {
                const cropData = cropper.getData();
                document.getElementById('cropData').value = JSON.stringify({
                    [currentFileInput]: cropData
                });

                const croppedCanvas = cropper.getCroppedCanvas();
                croppedCanvas.toBlob(function (blob) {
                    const url = URL.createObjectURL(blob);
                    document.getElementById(currentFileInput + '_preview').src = url;
                });

                // Close modal after saving crop
                const cropModal = bootstrap.Modal.getInstance(document.getElementById('cropModal'));
                cropModal.hide();
            }
        });
    </script>
@stop
