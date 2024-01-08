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
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-2">
                            <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-2">
                                <h2 class="mb-1 fs-7 fw-bolder">Change Your Password</h2>
                                <p class="mb-7">Please create a new password to continue using.</p>                            
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('client.change.password')}}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection