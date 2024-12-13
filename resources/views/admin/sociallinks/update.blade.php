@extends('admin.layouts.master')

@section('content')
    @include('admin.includes.forms')

    <div class="card-header">
        <h1 class="card-title">Update Social Links</h1>
    </div>

    <!-- Social Links update form -->
    <form action="{{ route('social-links.update', $socialLink->id) }}" method="POST" id="socialLinksForm">
        @csrf
        @method('PUT')

        <!-- Google Map Link -->
        <div class="form-group mb-3">
            <label for="google_map">Google Map Link</label>
            <input type="url" name="google_map" id="google_map" class="form-control" value="{{ old('google_map', $socialLink->google_map) }}" required>
        </div>

        <!-- Facebook Link -->
        <div class="form-group mb-3">
            <label for="facebook_link">Facebook Link</label>
            <input type="url" name="facebook_link" id="facebook_link" class="form-control" value="{{ old('facebook_link', $socialLink->facebook_link) }}" required>
        </div>

        <!-- Instagram Link -->
        <div class="form-group mb-3">
            <label for="instagram_link">Instagram Link</label>
            <input type="url" name="instagram_link" id="instagram_link" class="form-control" value="{{ old('instagram_link', $socialLink->instagram_link) }}">
        </div>

        <!-- LinkedIn Link -->
        <div class="form-group mb-3">
            <label for="linkedin_link">LinkedIn Link</label>
            <input type="url" name="linkedin_link" id="linkedin_link" class="form-control" value="{{ old('linkedin_link', $socialLink->linkedin_link) }}">
        </div>

        <!-- TikTok Link -->
        <div class="form-group mb-3">
            <label for="tiktok_link">TikTok Link</label>
            <input type="url" name="tiktok_link" id="tiktok_link" class="form-control" value="{{ old('tiktok_link', $socialLink->tiktok_link) }}">
        </div>

        <!-- Reddit Link -->
        <div class="form-group mb-3">
            <label for="reddit_link">Reddit Link</label>
            <input type="url" name="reddit_link" id="reddit_link" class="form-control" value="{{ old('reddit_link', $socialLink->reddit_link) }}">
        </div>

        <!-- Embed Facebook Page -->
        <div class="form-group mb-3">
            <label for="embed_fbpage">Embed Facebook Page</label>
            <textarea name="embed_fbpage" id="embed_fbpage" class="form-control" rows="5">{{ old('embed_fbpage', $socialLink->embed_fbpage) }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Social Links</button>
            <a href="{{ route('social-links.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
