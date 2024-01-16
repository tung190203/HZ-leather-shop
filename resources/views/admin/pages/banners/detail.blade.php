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
                                        <h6 class="fs-5 mb-0">Detail Banners</h6>
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
                            <form action="{{ route('admin.banner.detail', ['banner' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Image</label> <br>
                                    <img id="imagePreview" src="{{ Storage::disk('minio')->url($banner->image) }}"
                                        width="150" height="150" alt="" class="mb-3 rounded">
                                    <input id="imageInput" type="file" name="image" class="form-control"
                                        accept=".jpg, .jpeg, .png" onchange="uploadImage()">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="form-lable fw-semibold">Type</label>
                                    <select name="type" class="form-control fw-semibold">
                                        @foreach(config('default.banners.type') as $key => $value)
                                            <option value="{{ $key }}" {{ $banner->type == $key ? 'selected' : '' }}>{{ $value }}</option>
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
