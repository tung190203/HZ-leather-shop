@extends('admin')
@section('content')
    <div id="main-wrapper">
        <div class="position-relative overflow-hidden min-vh-100 w-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-lg-4">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/backgrounds/errorimg.svg') }}" alt="" class="img-fluid"
                                width="500">
                            <h1 class="fw-semibold mb-7 fs-9">Opps!!!</h1>
                            @if (auth()->check())
                                @if (auth()->user()->role == 'admin')
                                    <h4 class="fw-semibold mb-7">Your login session has definitely expired.</h4>
                                    <a class="btn btn-primary" href="{{ route('admin.login') }}" role="button">Go Back to
                                        Login</a>
                                @else
                                    <h4 class="fw-semibold mb-7">You are not authorized to access this page</h4>
                                    <a class="btn btn-primary" href="{{ route('client.home') }}" role="button">Return
                                        Back</a>
                                @endif
                            @else
                                <h4 class="fw-semibold mb-7">You will be redirected to the login page in <span
                                        id="countdown">4</span> </h4>
                                <script>
                                    setTimeout(function() {
                                        window.location.href = "{{ route('admin.login') }}";
                                    }, 4000);
                                    var countdown = 4; 
                                    var countdownElement = document.getElementById('countdown'); 
                                    function updateCountdown() {
                                        countdown--; 
                                        countdownElement.textContent = countdown;
                                        if (countdown <= 0) {
                                            window.location.href = "{{ route('admin.login') }}";
                                        } else {
                                            setTimeout(updateCountdown, 1000);
                                        }
                                    }
                                    updateCountdown();
                                </script>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
