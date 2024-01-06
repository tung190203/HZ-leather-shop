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
                                        <h6 class="fs-5 mb-0">Detail User</h6>
                                    </div>
                                </div>
                            </h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>{{ session('success') }}</strong>
                                </div>
                            @endif
                            <form action="{{ route('admin.user.detail', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Username</label>
                                    <input type="text" disabled class="form-control" value="{{$user->username}}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Role</label>
                                    <select name="role" class="form-control">
                                        @foreach(config('default.user.role') as $key => $value)
                                            <option value="{{$key}}" {{$user->role == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                                             
                                <div class="d-md-flex align-items-center">
                                    <div class="mt-3 mt-md-0 ms-auto">
                                        <button type="submit" class="btn btn-primary font-medium rounded-pill px-4">
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-plus me-2 fs-4"></i>Update
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
