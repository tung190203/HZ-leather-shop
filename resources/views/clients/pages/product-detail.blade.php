@extends('index')
@section('content')
    <style>
        #sync1 .item img,
        #sync2 .swiper-slide img {
            max-width: 100%;
            overflow: hidden;
        }

        #sync2 {
            overflow: hidden;

            max-width: 100%;
        }

        #sync2 .swiper-wrapper {
            display: flex;
            transition: transform 0.3s ease;
        }

        #sync2 .swiper-slide {
            flex: 0 0 auto;
            margin-right: 5px;
        }

        #sync2 .swiper-slide img {
            transition: transform 0.3s ease;
        }

        #sync2 .swiper-slide img:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        .truncateText {
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 20;
            -webkit-box-orient: vertical;
            line-height: 1.5;
            max-height: calc(1.5 * 20);
            letter-spacing: 0.5px;
        }

        #toggleButton {
            color: #007bff;
            cursor: pointer;
            float: right;
        }

        .unselectable {
            -webkit-user-select: none;
            /* Chrome, Safari, Edge */
            -moz-user-select: none;
            /* Firefox */
            -ms-user-select: none;
            /* IE 10+ */
            user-select: none;
            /* Standard syntax */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .rating {
            display: flex;
            justify-content: flex-start;
            margin-top: 10px;
        }

        .rating label {
            font-size: 24px;
            cursor: pointer;
        }

        .rating input {
            display: none;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: orange;
        }

        .rating input:checked~label {
            color: orange;
        }

        .scrollable-review {
            height: 350px;
            overflow-y: scroll;
        }
    </style>
    <div class="body-wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-xl-6 col-sm-12">
                            <div id="sync1" class=" mb-2">
                                <div class="item rounded overflow-hidden cssimage">
                                    <img src="{{ Storage::disk('minio')->url($product->images) }}" alt="mainImage"
                                        id="mainImage" height="534" class="rounded  w-100">
                                </div>
                            </div>
                            <div id="sync2" class=" mb-2 swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($listCoverPhoto as $coverPhoto)
                                        <div class="swiper-slide">
                                            <img src="{{ Storage::disk('minio')->url($coverPhoto) }}" alt="subImage"
                                                height="130" class="rounded mt-2 w-100"
                                                onclick="changeImage('{{ Storage::disk('minio')->url($coverPhoto) }}')">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-sm-12">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>{{ session('success') }}</strong>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    <strong>{{ $errors->first() }}</strong>
                                </div>
                            @endif
                            <form action="{{ route('client.cart.add') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="shop-content">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span
                                            class="badge text-bg-success fs-2 fw-semibold rounded-3">{{ $product->status }}</span>
                                    </div>
                                    <h4 class="fw-semibold">{{ $product->name }}</h4>
                                    <p class="mb-3">45 Reviews</p>
                                    <h4 class="fw-semibold mb-3 text-danger">
                                        @if ($product->sale_price != null)
                                            <del class="fs-2 text-muted"> {{ $product->price }} VND</del>
                                            {{ $product->sale_price }} VND
                                            <input type="hidden" name="sale_price" value="{{ $product->sale_price }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                        @else
                                            {{ $product->price }} VND
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                        @endif

                                    </h4>
                                    <div class="d-flex align-items-center gap-2 pb-2  border-bottom">
                                        <h6 class="mb-0 fs-4 fw-semibold">Remaining quantity:</h6>
                                        <p class="mb-0 fs-4 fw-normal">{{ $product->quantity }} products available</p>
                                    </div>
                                    <div class="d-flex align-items-center gap-8 py-9">
                                        <h6 class="mb-0 fs-4 fw-semibold">Category:</h6>
                                        <p class="mb-0 fs-4 fw-normal">{{ $product->category->name }}</p>
                                    </div>
                                    <div class="d-flex align-items-center gap-8 py-9">
                                        <h6 class="mb-0 fs-4 fw-semibold" style="margin-right:30px">Color:</h6>
                                        @foreach ($renderColors as $colors)
                                            <div id="renColor" data-color="{{ $colors }}"
                                                style="width: 25px; height: 25px; background-color:{{ $colors }};box-shadow:0 0 3px;cursor:pointer; border-radius: 50%;">
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="color" id="colorPicker">
                                    </div>
                                    <div class="d-flex align-items-center gap-5 pb-3  col-lg-4 col-sm-6 col-6 ">
                                        <h6 class="mb-0 fs-4 fw-semibold">QTY:</h6>
                                        <input type="number" name="quantity" value="1" class="form-control"
                                            min="1" max="{{ intval(str_replace('.', '', $product->quantity)) }}">
                                    </div>
                                    <div class="d-sm-flex align-items-center gap-3 pt-3 mb-7 border-top">
                                        <a href="javascript:void(0)"
                                            class="btn d-block btn-primary px-5 py-8 mb-2 mb-sm-0">Buy
                                            Now</a>
                                        <button type="submit" class="btn d-block btn-danger px-7 py-8" id="addToCart">Add
                                            to
                                            Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link d-flex active" data-bs-toggle="tab" href="#desc" role="tab">
                                        <span><i class="ti ti-file-description fs-4"></i>
                                        </span>
                                        <span class="d-none d-md-block ms-2">Description</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" data-bs-toggle="tab" href="#review" role="tab">
                                        <span><i class="ti ti-eye fs-4"></i>
                                        </span>
                                        <span class="d-none d-md-block ms-2">Reviews</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="desc" role="tabpanel">
                                    <div class="p-3">
                                        <p class="truncateText fs-4">
                                            {{ $product->description }}
                                        </p>
                                        <p id="toggleButton" class="unselectable">Read more</p>
                                    </div>
                                </div>
                                <div class="tab-pane p-3" id="review" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-6 col-sm 12">
                                            <form class="review-form" action="" method="post">
                                                @csrf
                                                <h4 class="fw-semibold mb-5">Add a review</h4>
                                                <div class="mb-3">
                                                    <label class="form-label">Rating</label>
                                                    <div class="rating">
                                                        <input type="radio" id="star1" name="rating"
                                                            value="1" />
                                                        <label for="star1">&#9733;</label>
                                                        <input type="radio" id="star2" name="rating"
                                                            value="2" />
                                                        <label for="star2">&#9733;</label>
                                                        <input type="radio" id="star3" name="rating"
                                                            value="3" />
                                                        <label for="star3">&#9733;</label>
                                                        <input type="radio" id="star4" name="rating"
                                                            value="4" />
                                                        <label for="star4">&#9733;</label>
                                                        <input type="radio" id="star5" name="rating"
                                                            value="5" />
                                                        <label for="star5">&#9733;</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="reviewText" class="form-label">Your Review</label>
                                                    <textarea class="form-control" id="reviewText" rows="5" placeholder="Write your review"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Review</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-6 col-xl-6 col-sm 12" style="border-left:1px solid #dfe5ef">
                                            <h4 class="fw-semibold mb-5">Others Reviews</h4>
                                            {{-- testcomment --}}
                                            <div class="scrollable-review">
                                                <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}"
                                                        alt="user8" width="40" height="40"
                                                        class="rounded-circle" />
                                                    <div>
                                                        <h6 class="fs-2 text-muted">
                                                            Andrew, 2 hours ago
                                                        </h6>
                                                        <div
                                                            class="p-2 text-bg-light rounded-1 d-inline-block text-dark fs-3">
                                                            If I don’t like something, I’ll stay away from it.
                                                        </div>
                                                        <div>
                                                            <span class="fw-semibold fs-2 mt-2" style="cursor:pointer; margin-left:30px">reply</span>
                                                        <span class="fw-semibold fs-2 mt-2" style="cursor:pointer; margin-left:30px">delete this review</span>
                                                        </div>
                                                        

                                                        <!-- Mục trả lời ở cấp 2 -->
                                                        <div
                                                            class="hstack gap-3 align-items-start mb-7 justify-content-start ml-5 mt-4">
                                                            <img src="{{ asset('assets/images/profile/user-1.jpg') }}"
                                                                alt="user9" width="40" height="40"
                                                                class="rounded-circle" />
                                                            <div>
                                                                <h6 class="fs-2 text-muted">
                                                                    Another User, 1 hour ago
                                                                </h6>
                                                                <div
                                                                    class="p-2 text-bg-light rounded-1 d-inline-block text-dark fs-3">
                                                                    Another response goes here.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Kết thúc mục trả lời cấp 2 -->
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- endtestcomment --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="related-products pt-7">
                <h4 class="mb-3 fw-semibold">Related Products</h4>
                <div class="row">
                    @foreach ($relatedProducts as $related)
                        <div class="col-sm-6 col-lg-3 col-6 col-xl-3">
                            <div class="card hover-img overflow-hidden rounded-2">
                                <div class="position-relative">
                                    <a href="{{ route('client.product.detail', ['product' => $related->id]) }}"><img
                                            src="{{ Storage::disk('minio')->url($related->images) }}" width="218"
                                            class="card-img-top rounded-0" alt="related"></a>
                                    <a href=""
                                        class="text-bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3"
                                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lov"><i
                                            class="ti ti-heart fs-4"></i></a>
                                </div>
                                <div class="card-body pt-3 p-4">
                                    <h6 class="fw-semibold fs-4">{{ $related->name }}</h6>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-semibold fs-4 mb-0">{{ $related->sale_price }} <span
                                                class="ms-2 fw-normal text-muted fs-3"><del>{{ $related->price }}</del></span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
