@extends('admin.layouts.master')

@section('content')
    <div class="card-header">
        <h1 class="card-title">Social Links</h1>
        <a href="{{ route('social-links.create') }}" class="btn btn-primary float-right">Add New Social Link</a>
    </div>

    <!-- Table displaying social links -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Google Map Link</th>
                    <th>Facebook Link</th>
                    <th>Instagram Link</th>
                    <th>LinkedIn Link</th>
                    <th>TikTok Link</th>
                    <th>Reddit Link</th>
                    <th>Embed Facebook Page</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socialLinks as $key => $link)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="{{ $link->google_map }}" target="_blank" class="custom-link">{{ $link->google_map }}</a></td>
                        <td><a href="{{ $link->facebook_link }}" target="_blank" class="custom-link">{{ $link->facebook_link }}</a></td>
                        <td><a href="{{ $link->instagram_link }}" target="_blank" class="custom-link">{{ $link->instagram_link }}</a></td>
                        <td><a href="{{ $link->linkedin_link }}" target="_blank" class="custom-link">{{ $link->linkedin_link }}</a></td>
                        <td><a href="{{ $link->tiktok_link }}" target="_blank" class="custom-link">{{ $link->tiktok_link }}</a></td>
                        <td><a href="{{ $link->reddit_link }}" target="_blank" class="custom-link">{{ $link->reddit_link }}</a></td>
                        <td>{{ $link->embed_fbpage }}</td>
                        <td>
                         
                            <a href="{{ route('social-links.edit',$link->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('social-links.destroy', $link->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sociallink?')">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Custom CSS for Links -->
    <style>
        .custom-link {
            color: black;
            text-decoration: none; /* Optional: To remove underline */
        }

        .custom-link:hover {
            text-decoration: underline; /* Optional: Adds underline on hover */
        }
    </style>
@endsection
