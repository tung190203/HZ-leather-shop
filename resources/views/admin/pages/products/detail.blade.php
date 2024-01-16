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
                                        <h6 class="fs-5 mb-0">Detail Category</h6>
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
                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                        @endif
                            <form action="{{ route('admin.product.detail', ['product' => $product->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Product Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="product.etc"
                                        value="{{ $product->name }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Image</label> <br>
                                    <img id="imagePreview" src="{{ Storage::disk('minio')->url($product->images) }}"
                                        width="150" height="150" alt="" class="mb-3 rounded">
                                    <input id="imageInput" type="file" name="images" class="form-control"
                                        accept=".jpg, .jpeg, .png" onchange="uploadImage()">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Cover Image</label> <br>
                                   <div id="oldPre">
                                    @foreach ($product->coverPhotos as $coverPhoto)
                                    <img class=" imagePrev mb-3 rounded "  src="{{ Storage::disk('minio')->url($coverPhoto->image)}}"
                                        width="150" height="150" alt="" >
                                    @endforeach
                                   </div>
                                    <input  type="file" name="image[]" class="form-control"
                                        accept=".jpg, .jpeg, .png" multiple onchange="previewImage(this)">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Price</label>
                                    <input type="text" min="1" name="price" class="form-control" id="numbInput"
                                        oninput="formatNumb('#numbInput')" value="{{ $product->price }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Sale Price</label>
                                    <input type="text" min="1" name="sale_price" class="form-control"
                                        id="numb1Input" oninput="formatNumb('#numb1Input')"
                                        value="{{ $product->sale_price }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Quantity</label>
                                    <input type="text" min="1" name="quantity" class="form-control"
                                        id="numb2Input" oninput="formatNumb('#numb2Input')"
                                        value="{{ $product->quantity }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Color</label>
                                    <input type="text" min="1" name="color" class="form-control"
                                        value="{{ $product->color }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea class="form-control p-7" name="description" id="" cols="20" rows="5">{{ $product->description }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"{{ $category->name ? 'selected' : '' }}>{{$category->name}}</option>
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
