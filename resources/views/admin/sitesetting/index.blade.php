@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3>SiteSettings</h3>
            <br>
            <div class="card">
                {{-- <div class="card-header">
                    <h4>Site Settings List</h4>
                    <a href="{{ route('sitesettings.create') }}" class="btn btn-primary float-end">Add New Setting</a>
                </div> --}}
                <div class="card-body">
                    <!-- Display success message -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    

                    <!-- Check if there are any site settings -->
                    @if($siteSettings->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Office Title</th>
                                    <th>Office Address</th>
                                    <th>Office Contact</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siteSettings as $setting)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $setting->office_title }}</td>
                                    <td>
                                        @if(is_array(json_decode($setting->office_address, true)))
                                            {{ implode(', ', json_decode($setting->office_address, true)) }}
                                        @else
                                            {{ $setting->office_address }}
                                        @endif
                                    </td>
                                    <td>@if(is_array(json_decode($setting->office_contact, true)))
                                        {{ implode(', ', json_decode($setting->office_contact, true)) }}
                                    @else
                                        {{ $setting->office_contact }}
                                    @endif</td>
                                    <td>
                                        @if($setting->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                            <a href="{{ route('sitesettings.edit', $setting->id) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <form action="{{ route('sitesettings.destroy', $setting->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this setting?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>

                                               

                                            <!-- Button to trigger Social Links Modal -->
@if($setting->socialLinks)
<button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#socialLinksModal{{ $setting->id }}">
    S
</button>

<!-- Social Links Modal with Edit Form -->
<div class="modal fade" id="socialLinksModal{{ $setting->id }}" tabindex="-1" aria-labelledby="socialLinksModalLabel{{ $setting->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="socialLinksModalLabel{{ $setting->id }}">Edit Social Links</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('social-links.update', $setting->socialLinks->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="google_map">Google Map Link</label>
                        <input type="url" name="google_map" id="google_map" class="form-control" value="{{ old('google_map', $setting->socialLinks->google_map) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="facebook_link">Facebook Link</label>
                        <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="{{ old('facebook_link', $setting->socialLinks->facebook_link) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="instagram_link">Instagram Link</label>
                        <input type="url" name="instagram_link" id="instagram_link" class="form-control" value="{{ old('instagram_link', $setting->socialLinks->instagram_link) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="linkedin_link">LinkedIn Link</label>
                        <input type="url" name="linkedin_link" id="linkedin_link" class="form-control" value="{{ old('linkedin_link', $setting->socialLinks->linkedin_link) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="tiktok_link">TikTok Link</label>
                        <input type="url" name="tiktok_link" id="tiktok_link" class="form-control" value="{{ old('tiktok_link', $setting->socialLinks->tiktok_link) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="reddit_link">Reddit Link</label>
                        <input type="url" name="reddit_link" id="reddit_link" class="form-control" value="{{ old('reddit_link', $setting->socialLinks->reddit_link) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="embed_fbpage">Embed Facebook Page</label>
                        <textarea name="embed_fbpage" id="embed_fbpage" class="form-control" rows="5">{{ old('embed_fbpage', $setting->socialLinks->embed_fbpage) }}</textarea>
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
@endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            No site settings available. <a href="{{ route('sitesettings.create') }}">Create a new setting</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
