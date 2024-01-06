@extends('admin')
@section('content')
    <div class="body-wrapper">
        @include('admin.layouts.topbar')
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12 ">

                    <div class="card">
                        <div class="px-4 py-3 border-bottom">
                            <h5 class="card-title fw-semibold mb-0">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="fs-5 mb-0">Add User</h6>
                                    </div>
                                </div>
                            </h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>Success! Add user successfully</strong> {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('admin.user.create') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="mb-4">
                                    <label class="form-label fw-semibold"> First Name</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="first name.etc"
                                        value="{{old('first_name')}}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold"> Last Name</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="last name.etc"
                                        value="{{old('last_name')}}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold"> Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="email@gmail.com.etc"
                                        value="{{old('email')}}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold"> Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="****.etc">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">Chọn vai trò</option>
                                        @foreach(config('default.user.role') as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-md-flex align-items-center">
                                    <div class="mt-3 mt-md-0 ms-auto">
                                        <button type="submit" class="btn btn-primary font-medium rounded-pill px-4">
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-plus me-2 fs-4"></i>Add
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
