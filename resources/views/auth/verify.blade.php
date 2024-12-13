@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="notification-card">
                <div class="notification-header">{{ __('Verify Your Email Address') }}</div>

                <div class="notification-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.notification-card {
    background-color: #f8f9fa;
    border-left: 5px solid #007bff;
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.notification-header {
    font-size: 1.4rem;
    font-weight: bold;
    color: #343a40;
    margin-bottom: 10px;
}

.notification-body {
    font-size: 1rem;
    color: #495057;
    line-height: 1.6;
}

.notification-body .btn-link {
    color: #007bff;
    text-decoration: underline;
    padding-left: 0;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
}
</style>

<!-- JavaScript to redirect after 5 seconds -->
{{-- <script>
   
    setTimeout(function() {
        window.location.href = "{{ route('index') }}"; 
    }, 5000);
</script> --}}