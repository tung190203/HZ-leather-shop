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
                    <button type="button" style="background-color:#5d86fc;box-shadow:0 0 2px black" class="btn m-1 "><a
                            href="{{ route('admin.export.category') }}" style="color: white "> <i
                                class="ti ti-download fs-5"></i> Export</a></button>
                    <button type="button" style="background-color:#5d86fc;box-shadow:0 0 2px black" class="btn m-1"><a
                            href="{{ route('admin.category.create') }}" style="color: white ">Add Category</a></button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Categories Management</h5>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">#</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Description</h6>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Arrival Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $category->id }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-1">{{ $category->name }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal truncate-text">{{ $category->description }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{ $category->created_at }}
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="action-btn">
                                                        <a href="{{ route('admin.category.detail', ['category' => $category->id]) }}"
                                                            class="text-info ">
                                                            <i class="ti ti-eye fs-5"></i>
                                                        </a>
                                                        <a href="" class="text-danger  ms-2"
                                                            onclick="deleteItem('category',{{ $category->id }})">
                                                            <i class="ti ti-trash fs-5"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item {{ $categories->currentPage() == 1 ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $categories->previousPageUrl() }}" tabindex="-1"
                                            aria-disabled="true">Previous</a>
                                    </li>
                                    @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                        <li class="page-item {{ $i == $categories->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li
                                        class="page-item {{ $categories->currentPage() == $categories->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $categories->nextPageUrl() }}">Next</a>
                                    </li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
