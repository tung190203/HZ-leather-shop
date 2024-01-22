@extends('index')
@section('content')
    <style>
        .social-container {
            position: relative;
            overflow: hidden;
        }

        .social-container img {
            width: 100%;
            object-fit: cover; 
            transition: 0.3s ease-in-out;
        }

        .social-container:hover img {
            filter: brightness(70%);
            transition: 0.3s ease-in-out;
        }

        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .social-container:hover .overlay {
            opacity: 1;
        }

        .social-link {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .social-link:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>

    <div class="body-wrapper">
        <div class="container ">
            <div class="row mb-4">
                <div id="carouselExampleControls" class="carousel slide carousel-dark w-100" data-bs-ride="carousel">
                    <div class="carousel-inner rounded"
                        style="margin-top:5vh; box-shadow:0 0 5px rgba(13, 12, 12, 0.295); width:100%">
                        @foreach ($banners as $banner)
                            <div class="carousel-item active">
                                <img src="{{ Storage::disk('minio')->url($banner->image) }}" class="d-block w-100 "
                                    alt="bannerImage" />
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev align-items-middle" href="#carouselExampleControls" role="button"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
            {{-- service --}}
            <div class="row">
                <div class="col-sm-6 col-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="row card-body pt-3 p-4">
                            <div class="col-xl-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-car text-danger" style="font-size: 70px"></i>
                            </div>
                            <div class="col-xl-9">
                                <h6 class="mt-4">Free Shipping</h6>
                                <p>Free shipping for orders over 500.000K</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="row card-body pt-3 p-4">
                            <div class="col-xl-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-refresh text-danger" style="font-size: 70px"></i>
                            </div>
                            <div class="col-xl-9">
                                <h6 class="mt-4">Flexible Return Policy</h6>
                                <p>Satisfying Returns for Customers</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="row card-body pt-3 p-4">
                            <div class="col-xl-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-gift text-danger" style="font-size: 70px"></i>
                            </div>
                            <div class="col-xl-9">
                                <h6 class="mt-4">Free Gift</h6>
                                <p>Discover Freebies with every purchase</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="row card-body pt-3 p-4">
                            <div class="col-xl-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-headphones text-danger" style="font-size: 70px"></i>
                            </div>
                            <div class="col-xl-9">
                                <h6 class="mt-4">Support 24/7</h6>
                                <p>Always Here, Anytime You Need</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <h1 class="text-center mt-4 mb-4"
                    style="font-size: 70px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                    Shop Top Collections</h1>
                @foreach ($sliders as $banner)
                    <div class="col-lg-3">
                        <div class="card">
                            <img src="{{ Storage::disk('minio')->url($banner->image) }}" height="306"
                                class="d-block rounded w-100" alt="bannerImage" />
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-6">
                    <div class="card" style="background-color: #ececec">
                        <div class="card-body ">
                            <div style="width:100%;aspect-ratio:1/1;text-align:center;background-color:#ececec"
                                class="d-flex flex-column align-items-center justify-content-center">
                                <h4>Satisfy enthusiasts</h4>
                                <h1>Customize your accessories</h1>
                                <a href="{{ route('client.shop') }}"><input type="button" class="btn btn-dark text-white"
                                        value="Shop Now"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="carouselExampleControls1" class="carousel slide carousel-dark w-100" data-bs-ride="carousel">
                        <div class="carousel-inner rounded" style=" box-shadow:0 0 5px rgba(13, 12, 12, 0.295); width:100%">
                            @foreach ($posters as $key => $poster)
                                @if ($key < 3)
                                    <div class="carousel-item active">
                                        <img src="{{ Storage::disk('minio')->url($poster->image) }}"
                                            class="d-block mx-auto rounded" style="width: 100%; aspect-ratio: 1/1;"
                                            alt="bannerImage" />
                                    </div>
                                @else
                                    @php
                                        $remainingPosters[] = $poster;
                                    @endphp
                                @endif
                            @endforeach
                        </div>
                        <a class="carousel-control-prev align-items-middle" href="#carouselExampleControls1" role="button"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls1" role="button"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="carouselExampleControls2" class="carousel slide carousel-dark w-100"
                        data-bs-ride="carousel">
                        <div class="carousel-inner rounded"
                            style=" box-shadow:0 0 5px rgba(13, 12, 12, 0.295); width:100%">
                            @if (isset($remainingPosters) && count($remainingPosters) > 0)
                                @foreach ($remainingPosters as $poster)
                                    <div class="carousel-item active">
                                        <img src="{{ Storage::disk('minio')->url($poster->image) }}"
                                            class="d-block mx-auto rounded" style="width: 100%; aspect-ratio: 1/1;"
                                            alt="bannerImage" />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev align-items-middle" href="#carouselExampleControls2"
                            role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls2" role="button"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body ">
                            <div style="width:100%;aspect-ratio:1/1;text-align:center"
                                class="d-flex flex-column align-items-center justify-content-center">
                                <h4>Satisfy enthusiasts</h4>
                                <h1>Customize your accessories</h1>
                                <a href="{{ route('client.shop') }}"><input type="button"
                                        class="btn btn-dark text-white" value="Shop Now"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div style="border-bottom:2px solid black">
                                    <h5 class="card-title  fw-semibold">Best Seller</h5>
                                </div>
                            </div>
                            <div class="overflow-auto card mt-4 mb-0 shadow-none " style="height: 450px">
                                <div class="hstack p-3 bg-hover-light-black position-relative">
                                    <img src="../assets/images/music/album1.jpg" alt="top-1" width="60"
                                        height="60" class="rounded ms-3" />
                                    <div class="ms-3">
                                        <h6 class="mb-0">N95</h6>
                                        <span class="fs-3">Kendrick Lamar</span>
                                    </div>
                                    <div class="ms-auto">
                                        <a class="" href="javascript:void(0)">
                                            <i class="ti ti-shopping-cart text-primary fs-5"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div style="border-bottom:2px solid black">
                                    <h5 class="card-title  fw-semibold">Promotion</h5>
                                </div>
                            </div>
                            <div class="overflow-auto card mt-4 mb-0 shadow-none " style="height: 450px">
                                @foreach ($promotions as $promotion)
                                    <div class="hstack p-3 bg-hover-light-black position-relative">
                                        <img src="{{ Storage::disk('minio')->url($promotion->images) }}" alt="top-1"
                                            width="60" height="60" class="rounded ms-3" />
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $promotion->name }}</h6>
                                            <span class="fs-3">{{ $promotion->price }}</span>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="">
                                                <i class="ti ti-shopping-cart text-primary fs-5"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div style="border-bottom:2px solid black">
                                    <h5 class="card-title  fw-semibold">New Product</h5>
                                </div>
                            </div>
                            <div class="overflow-auto card mt-4 mb-0 shadow-none " style="height: 450px">
                                @foreach ($newProducts as $newProduct)
                                    <div class="hstack p-3 bg-hover-light-black position-relative">
                                        <img src="{{ Storage::disk('minio')->url($newProduct->images) }}" alt="top-1"
                                            width="60" height="60" class="rounded ms-3" />
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $newProduct->name }}</h6>
                                            <span class="fs-3">{{ $newProduct->price }}</span>
                                        </div>
                                        <div class="ms-auto">
                                            <a class="" href="">
                                                <i class="ti ti-shopping-cart text-primary fs-5"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              @foreach ($socials as $social)
                  <div class="col-lg-2 col-sm-4 col-4">
                      <div class="social-container d-flex justify-content-center">
                          <img src="{{ Storage::disk('minio')->url($social->image) }}" width="196" height="196" class="rounded border mb-5"
                              alt="social" style="max-width: 100%;">
                          <div class="overlay">
                              <a href="#" class="social-link"><i class="ti ti-brand-instagram fs-5"></i> Hz-Leather</a>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
          

        </div>
    </div>
@endsection
