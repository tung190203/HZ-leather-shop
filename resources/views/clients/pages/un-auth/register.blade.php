@extends('index')
@section('content')
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
                                <h2 class="mb-1 fs-7 fw-bolder">Welcome to Hz Leather</h2>

                                <p class="mb-7"></p>
                                <div class="row">
                                    <div class="col-6 mb-2 mb-sm-0">
                                        <a class="btn text-dark border fw-normal d-flex align-items-center justify-content-center rounded-2 py-8"
                                            href="javascript:void(0)" role="button">
                                            <img src="{{ asset('assets/images/svgs/google-svg.svg') }}" alt=""
                                                class="img-fluid me-2" width="18" height="18">
                                            <span class="flex-shrink-0">Google</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn text-dark border fw-normal d-flex align-items-center justify-content-center rounded-2 py-8"
                                            href="javascript:void(0)" role="button">
                                            <img src="{{ asset('assets/images/svgs/facebook-svg.svg') }}" alt=""
                                                class="img-fluid me-2" width="18" height="18">
                                            <span class="flex-shrink-0">Facebook</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="position-relative text-center my-4">
                                    <p class="mb-0 fs-4 px-3 d-inline-block bg-body text-dark  position-relative"
                                        style="z-index: 1000">
                                        or sign up with
                                    </p>
                                    <span
                                        class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('client.register') }}" method="post">
                                    @csrf
                                    <div class="mb-3 row">
                                        <div class="col-lg-6">
                                            <label for="exampleInputEmail1" class="form-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="exampleInputEmail1" class="form-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            aria-describedby="emailHelp" value="{{old('email')}}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value="" checked>
                                            <label class="form-check-label text-dark fs-3" for="flexCheckChecked">
                                                Remeber this Device
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit"class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</button>
                                </form>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-medium">Have account Hz Leather?</p>
                                    <a class="text-primary fw-medium ms-2" href="{{ route('client.login') }}">Sign In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
