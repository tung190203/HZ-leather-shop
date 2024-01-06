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
    </style>
    <div class="container-fluid" style="padding-top:5%;padding-bottom:15%;background-image:url(./assets/img/discount.jpg)">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-4 mb-4 form-container">
                <h2 class="text-center mb-4 mt-5" style="color:white;font-weight: bold">Login</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('client.login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-outline mb-4">
                        <label class="form-label" style="color:white">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" />
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" style="color:white">Password</label>
                        <input type="password" name="password" class="form-control" />
                    </div>
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked />
                                <label class="form-check-label" style="color:white"> Remember me </label>
                            </div>
                        </div>
                        <div class="col">
                            <a href="/forgot" style="font-weight: bold">Forgot password?</a>
                        </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                    <div class="text-center">
                        <p style="color:white">Not a member? <a href="/register" style="font-weight: bold">Register</a></p>
                    </div>
                </form>

            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

@endsection
