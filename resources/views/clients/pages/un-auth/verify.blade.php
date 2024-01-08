@extends('index')
@section('content')
<style>
    #btlogin{
        background-color: #f1f4ff;
        color:#5d86fc;
    }
    #btlogin:hover{
        background-color: #5d86fc;
        color: #fff;
    }
</style>
    <div id="main-wrapper">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="#" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <img src="{{ asset('assets/images/logo.png') }}" width="180" alt="Logo" />
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 80px);">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="img-fluid"
                                width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-2 ">
                            <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-1 ">
                                <h2 class="mb-1 fs-7 fw-bolder">Two Step Verification</h2>
                                <p class="mb-7">We sent a verification code to your email. Enter the code from the email in the field below.</p>                            
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{route('client.verify')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label fw-semibold">Type your 6 digits security
                                        code</label>
                                      <div class="d-flex align-items-center">
                                        <input type="text" class="form-control verified" style="margin:5px" maxlength="1" name="code[]">
                                        <input type="text" class="form-control verified" style="margin:5px" maxlength="1" name="code[]">
                                        <input type="text" class="form-control verified" style="margin:5px" maxlength="1" name="code[]">
                                        <input type="text" class="form-control verified" style="margin:5px" maxlength="1" name="code[]">
                                        <input type="text" class="form-control verified" style="margin:5px" maxlength="1" name="code[]">
                                        <input type="text" class="form-control verified" style="margin:5px" maxlength="1" name="code[]">
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4" id="submitBtn" disabled>Verify My Account</button>
                                  </form>
                                  <div class="d-flex align-items-center">
                                    <p class="fs-4 mb-0 text-dark">Didn't get the code?</p>
                                    <a class="text-primary fw-medium ms-2" href="javascript:void(0)">Resend</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection