<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />
    <!-- Favicons and theme styles as per your login page -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('adminassets/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('adminassets/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('adminassets/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('adminassets/assets/img/favicons/favicon.ico') }}">
    <link href="{{ asset('adminassets/assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('adminassets/assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <link href="{{ asset('adminassets/assets/toastr/toastr.min.css') }}" rel="stylesheet">
</head>

<body>
    <style>
        .fa-eye{
            font-size: 24px;
        }
    </style>
@if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <script>
        @if(Session::has('toast_message'))
            // Assuming you're using a toast library like Toastr
            toastr.success("{{ Session::get('toast_message') }}");
        @endif
    </script>


    <main class="main" id="top">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-center g-0">
                <div class="col-lg-8 col-xxl-5 py-3 position-relative">
                    <div class="card overflow-hidden z-index-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">
                                <div class="col-md-5 text-center bg-card-gradient py-1">
                                    <div class="position-relative p-4  pb-md-7 light">
                                        <a class="link-light mb-1 font-sans-serif fs-4 d-inline-block fw-bolder"
                                            href="#">Welcome to Nexon Property</a>
                                    </div>
                                    <img height="200" width="200" src="{{asset("image/about.jpg")}}" class="rounded">
                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <h3>Register a New Account</h3>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Full Name</label>
                                                <input class="form-control" id="name" type="text" name="name"
                                                    value="{{ old('name') }}" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email Address</label>
                                                <input class="form-control" id="email" type="email" name="email"
                                                    value="{{ old('email') }}" required>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="password">Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="password" type="password"
                                                        name="password" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            onclick="togglePassword('password', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="password_confirmation">Confirm
                                                    Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" id="password-confirm" type="password"
                                                        name="password_confirmation" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            onclick="togglePassword('password-confirm', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary d-block w-100 mt-3"
                                                type="submit">Register</button>
                                        </form>
                                        <div class="text-center mt-3">
                                            <a href="{{ route('login') }}">Already have an account? Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScripts -->
    <script src="{{ asset('adminassets/assets/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/fontawesome/all.min.js') }}"></script>
    <script>
        function togglePassword(fieldId, element) {
            var inputField = document.getElementById(fieldId);
            var icon = element.querySelector('i');
            if (inputField.type === 'password') {
                inputField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                inputField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>