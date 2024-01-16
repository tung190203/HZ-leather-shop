@extends('admin')
@section('content')
    <div class="body-wrapper">
        @include('admin.layouts.topbar')
        <style>
            .truncate-text {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 600px;
            }

            .truncate-name {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 150px;
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6 mb-2 text-end">
                    <button type="button" style="background-color:#5d86fc;box-shadow:0 0 2px black" class="btn m-1"><a
                            href="{{ route('admin.banner.create') }}" style="color: white ">Add Banner</a></button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Banner Management</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Banner</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Arrival Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Update Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $banner->id }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <img src="{{ Storage::disk('minio')->url($banner->image) }}"
                                                        alt="banner" width="300" height="75" class="rounded">
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $banner->type }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $banner->created_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $banner->updated_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="action-btn">
                                                        <a href="{{ route('admin.banner.detail', ['banner' => $banner->id]) }}"
                                                            class="text-info ">
                                                            <i class="ti ti-eye fs-5"></i>
                                                        </a>
                                                        <a href="" class="text-danger  ms-2"
                                                            onclick="deleteItem('banner',{{ $banner->id }})">
                                                            <i class="ti ti-trash fs-5"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Slider Management</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Slider</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Arrival Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Update Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $slider)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $slider->id }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <img src="{{ Storage::disk('minio')->url($slider->image) }}"
                                                        alt="banner" width="75" height="75" class="rounded">
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $slider->type }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $slider->created_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $slider->updated_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="action-btn">
                                                        <a href="{{ route('admin.banner.detail', ['banner' => $slider->id]) }}"
                                                            class="text-info ">
                                                            <i class="ti ti-eye fs-5"></i>
                                                        </a>
                                                        <a href="" class="text-danger  ms-2"
                                                            onclick="deleteItem('banner',{{ $slider->id }})">
                                                            <i class="ti ti-trash fs-5"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Poster Management</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Poster</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Arrival Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Update Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posters as $poster)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $poster->id }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <img src="{{ Storage::disk('minio')->url($poster->image) }}"
                                                        alt="banner" width="75" height="75" class="rounded">
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $poster->type }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $poster->created_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $poster->updated_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="action-btn">
                                                        <a href="{{ route('admin.banner.detail', ['banner' => $poster->id]) }}"
                                                            class="text-info ">
                                                            <i class="ti ti-eye fs-5"></i>
                                                        </a>
                                                        <a href="" class="text-danger  ms-2"
                                                            onclick="deleteItem('banner',{{ $poster->id }})">
                                                            <i class="ti ti-trash fs-5"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Social Management</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Social</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Arrival Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Update Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($socials as $social)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $social->id }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <img src="{{ Storage::disk('minio')->url($social->image) }}"
                                                        alt="banner" width="75" height="75" class="rounded">
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $social->type }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $social->created_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $social->updated_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="action-btn">
                                                        <a href="{{ route('admin.banner.detail', ['banner' => $social->id]) }}"
                                                            class="text-info ">
                                                            <i class="ti ti-eye fs-5"></i>
                                                        </a>
                                                        <a href="" class="text-danger  ms-2"
                                                            onclick="deleteItem('banner',{{ $social->id }})">
                                                            <i class="ti ti-trash fs-5"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
