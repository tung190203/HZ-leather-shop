@extends('index')
@section('content')
    @include('clients.layouts.un-auth.menu')
    <style>
        .form-container {
            background-color: rgba(0, 0, 0, 0.575);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(252, 252, 252, 0.276);
        }

        .spanError {
            color: red;
            font-size: 12px;
        }
    </style>
    <div class="container-fluid" style="padding-top:5%;padding-bottom:15%;background-image:url(./assets/img/discount.jpg)">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-4 mb-4 form-container">
                <h2 class="text-center mb-4 mt-5" style="color:white;font-weight: bold">Register</h2>

                <form action="{{ route('client.register') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-outline mb-4">
                                <label class="form-label" style="color:white">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}"
                                    class="form-control" />
                                <span class="spanError text-danger">{{ $errors->first('first_name') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-outline mb-4">
                                <label class="form-label" style="color:white">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}"
                                    class="form-control" />
                                <span class="spanError text-danger">{{ $errors->first('last_name') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" style="color:white">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" />
                        <span class="spanError text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" style="color:white">Password</label>
                        <input type="password" name="password" class="form-control" />
                        <span class="spanError text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" style="color:white">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" />
                        <span class="spanError text-danger">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                    <div class="text-center">
                        <p style="color:white">Have a account? <a href="/login" style="font-weight: bold">Login</a></p>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection
