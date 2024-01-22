@extends('index')
@section('content')
    <style>
        .truncate-pname {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.6rem;
        }

        .stickyscroll {
            position: sticky;
            top: 70px;
            height: 100%;
        }
    </style>
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-lg-3 card stickyscroll">
                    <div class="shop-filters flex-shrink-0 d-none d-lg-block">
                        <ul class="list-group pt-2 border-bottom rounded-0">
                            <h6 class="my-3 mx-4 fw-semibold">Filter by Category</h6>
                            <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                    href="{{ route('client.shop.filter', ['item' => 'all']) }}"><i
                                        class="ti ti-circles fs-5"></i>All
                                </a>
                            </li>
                            <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                <form action="{{ route('client.shop.filter', ['item' => 'category']) }}" method="get">
                                    @csrf
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="margin-right:10px">
                                            <select name="category_id" class="form-select" id="category_id">
                                                <option value="">Choice Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }} {{ $category->id == old('category_id') ? 'selected' : '' }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <button class="btn btn-secondary" type="submit"><i
                                                    class="ti ti-filter"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        <ul class="list-group pt-2 border-bottom rounded-0">
                            <h6 class="my-3 mx-4 fw-semibold">Sort By</h6>
                            <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                    href="{{ route('client.shop.filter', ['item' => 'new']) }}"><i
                                        class="ti ti-ad-2 fs-5"></i>Newest
                                </a>
                            </li>
                            <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                    href="{{ route('client.shop.filter', ['item' => 'hight']) }}"><i
                                        class="ti ti-sort-ascending-2 fs-5"></i>Price: High-Low
                                </a>
                            </li>
                            <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                    href="{{ route('client.shop.filter', ['item' => 'low']) }}"><i
                                        class="ti ti-sort-descending-2 fs-5"></i></i>Price:
                                    Low-High
                                </a>
                            </li>
                            <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                    href="{{ route('client.shop.filter', ['item' => 'sale']) }}"><i
                                        class="ti ti-ad-2 fs-5"></i>Discounted
                                </a>
                            </li>
                        </ul>
                        <div class="by-pricing border-bottom rounded-0">
                            <h6 class="mt-4 mb-3 mx-4 fw-semibold">By Pricing</h6>
                            <form id="filterForm" action="{{route('client.shop.filter',['item'=>'price'])}}" method="get">
                                <div class="pb-4 px-4">
                                    @php
                                        $max = 0;
                                        foreach ($products as $product) {
                                            $price = intval(str_replace('.', '', $product->price));
                                            if ($price > $max) {
                                                $max = $price;
                                            }
                                        }
                                        $maximum = $max;
                                    @endphp
                                    <input type="range" class="form-range" id="priceRange" name="price" min="0"
                                        oninput="updatePriceDisplay(this.value,'priceDisplay','filterForm')" max="{{ $maximum }}" step="10000"
                                        value="0">
                                    <span id="priceDisplay">0 VND</span>
                                </div>
                            </form>
                        </div>
                        <div class="p-4">
                            <a href="{{ route('client.shop.filter', ['item' => 'reset']) }}"
                                class="btn btn-primary w-100">Reset Filters</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 card">
                    <div class="card-body p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a class="btn btn-primary d-lg-none d-flex" data-bs-toggle="offcanvas" href="#offcanvasExample"
                                role="button" aria-controls="offcanvasExample">
                                <i class="ti ti-menu-2 fs-6"></i>
                            </a>
                            <h5 class="fs-5 fw-semibold mb-0 d-none d-lg-block">Products</h5>
                            <form class="position-relative" action="{{ route('client.shop.search') }}" method="get">
                                @csrf
                                <input type="text" class="form-control search-chat py-2 ps-5" name="search"
                                    id="text-srh" placeholder="Search Product">
                                <i
                                    class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                            </form>
                        </div>
                        <div class="row">
                            {{-- product --}}
                            @foreach ($products as $product)
                                <div class="col-sm-6 col-6 col-lg-4 col-xl-4">
                                    <div class="card hover-img overflow-hidden rounded-2">
                                        <div class="position-relative">
                                            <a href="{{ route('client.product.detail', ['product' => $product->id]) }}"><img
                                                    src="{{ Storage::disk('minio')->url($product->images) }}"
                                                    width="250" height="250" class="card-img-top rounded-0"
                                                    alt="product"></a>
                                            <a href=""
                                                class="text-bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lov"><i
                                                    class="ti ti-heart fs-4"></i></a>
                                        </div>
                                        <div class="card-body pt-3 p-4">
                                            <h6 class="fw-semibold fs-4 truncate-pname">{{ $product->name }} </h6>
                                            <div class="d-flex align-items-center justify-content-between">
                                                @if ($product->sale_price != null)
                                                    <h6 class="fw-semibold fs-4 mb-0 text-danger">
                                                        {{ $product->sale_price }} VND<span
                                                            class="ms-2 fw-normal text-muted fs-1"><del>{{ $product->price }}
                                                                VND</del></span></h6>
                                                @else
                                                    <h6 class="fw-semibold fs-4 mb-0 text-danger">{{ $product->price }} VND
                                                    </h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- end product --}}
                            <div class="col-12 mb-3">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item ">
                                            <a class="page-link" href="#" tabindex="-1"
                                                aria-disabled="true">Previous</a>
                                        </li>
                                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                                            <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $products->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                                aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-body shop-filters w-100 p-0">
                                    <ul class="list-group pt-2 border-bottom rounded-0">
                                        <h6 class="my-3 mx-4 fw-semibold">Filter by Category</h6>
                                        <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                                href="{{ route('client.shop.filter', ['item' => 'all']) }}"><i
                                                    class="ti ti-circles fs-5"></i>All
                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                            <form  action="{{ route('client.shop.filter', ['item' => 'category']) }}"
                                                method="get">
                                                @csrf
                                                <div class="d-flex justify-content-around align-items-center">
                                                    <div style="margin-right:10px">
                                                        <select name="category_id" class="form-select" id="category_id">
                                                            <option value="">Choice Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-secondary" type="submit">Filter</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                    <ul class="list-group pt-2 border-bottom rounded-0">
                                        <h6 class="my-3 mx-4 fw-semibold">Sort By</h6>
                                        <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                                href="{{ route('client.shop.filter', ['item' => 'new']) }}"><i
                                                    class="ti ti-ad-2 fs-5"></i>Newest
                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                                href="{{ route('client.shop.filter', ['item' => 'hight']) }}"><i
                                                    class="ti ti-sort-ascending-2 fs-5"></i>Price: High-Low
                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                                href="{{ route('client.shop.filter', ['item' => 'low']) }}"><i
                                                    class="ti ti-sort-descending-2 fs-5"></i></i>Price: Low-High
                                            </a>
                                        </li>
                                        <li class="list-group-item border-0 p-0 mx-4 mb-2">
                                            <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                                                href="{{ route('client.shop.filter', ['item' => 'sale']) }}"><i
                                                    class="ti ti-ad-2 fs-5"></i>Discounted
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="by-pricing border-bottom rounded-0">
                                        <h6 class="mt-4 mb-3 mx-4 fw-semibold">By Pricing</h6>
                                        <form id="filterFormMob" action="{{route('client.shop.filter',['item'=>'price'])}}" method="get">
                                            <div class="pb-4 px-4">
                                                @php
                                                    $max = 0;
                                                    foreach ($products as $product) {
                                                        $price = intval(str_replace('.', '', $product->price));
                                                        if ($price > $max) {
                                                            $max = $price;
                                                        }
                                                    }
                                                    $maximum = $max;
                                                @endphp
                                                <input type="range" class="form-range" id="priceRange" name="price" min="0"
                                                    oninput="updatePriceDisplay(this.value,'priceDisplayMob','filterFormMob')" max="{{ $maximum }}" step="10000"
                                                    value="0">
                                                <span id="priceDisplayMob">0 VND</span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="p-4">
                                        <a href="{{ route('client.shop.filter', ['item' => 'reset']) }}"
                                            class="btn btn-primary w-100">Reset Filters</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
