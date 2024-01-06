@extends('admin')
@section('content')
    <div class="body-wrapper">
        @include('admin.layouts.topbar')
        <style>
            .truncate-text {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 250px;
            }

            .truncate-name {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 130px;
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6 mb-3 text-end">
                    <button type="button" style="background-color:#5d86fc;box-shadow:0 0 2px black" class="btn m-1"><a
                            href="{{ route('admin.export.product') }}" style="color: white "> <i
                                class="ti ti-download fs-5"></i> Export</a></button>
                    <button type="button" style="background-color:#5d86fc;box-shadow:0 0 2px black" class="btn m-1" id="btnadd"><a
                            href="{{ route('admin.product.create') }}" style="color: white ">Add Product</a></button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold mb-4">Product Management</h5>
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
                                                <h6 class="fw-semibold mb-0">Image</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Price (VND)</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Sale</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Description</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Status</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Arrival Date</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-normal mb-0">{{ $product->id }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1">{{ $product->name }}</h6>
                                                    <span class="fw-normal">
                                                        {{ $product->category ? $product->category->name : 'No Category' }}
                                                    </span>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <img src="{{ Storage::disk('minio')->url($product->images) }}"
                                                        width="75" height="75" class="rounded" alt="Product Image">
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class=" fw-normal">{{ $product->price }}</span>
                                                    </div>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <span class="fw-normal mb-0 ">
                                                        {{ $product->sale_price ?? 'No' }}
                                                    </span>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal truncate-text">{{ $product->description }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $product->status }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $product->created_at }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="action-btn">
                                                        <a href="{{ route('admin.product.detail', ['product' => $product->id]) }}"
                                                            class="text-info ">
                                                            <i class="ti ti-eye fs-5"></i>
                                                        </a>
                                                        <a href="" class="text-danger ms-2"
                                                            onclick="deleteItem('product',{{ $product->id }})">
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
                                    <li class="page-item ">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
