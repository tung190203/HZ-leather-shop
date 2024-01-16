<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">

<head>
    @include('clients.layouts.header')
</head>

<body>
    <div id="main-wrapper">
        @if (
            !in_array(request()->route()->getName(),
                ['client.login', 'client.register', 'client.forgot','client.verify','client.change.password']))
            @include('clients.layouts.menu')
        @endif

        @yield('content')
        @include('clients.layouts.footer')
    </div>
    <!--  Shopping Cart -->
    <div class="offcanvas offcanvas-end shopping-cart" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header py-4">
            <h5 class="offcanvas-title fs-5 fw-semibold" id="offcanvasRightLabel">
                Shopping Cart
            </h5>
            @php
            $totalCart = App\Models\Cart::where('user_id', Auth::id())->where('status',config('default.cart.status.pending'))->count();
            $carts = App\Models\Cart::where('user_id', Auth::id())->where('status',config('default.cart.status.pending'))->get();
            @endphp
            <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">{{$totalCart}} new</span>
        </div>
        <div class="offcanvas-body h-100 px-4 pt-0" data-simplebar>
            @php
            $subtotal = 0;
            $vat = 0;
            @endphp
            @if(count($carts) > 0)
            @foreach($carts as $cart)
            <ul class="mb-0">
                <li class="pb-7">
                    <div class="d-flex align-items-center">
                        <img src="{{Storage::disk('minio')->url($cart->product->images)}}" width="95" height="75"
                            class="rounded-1 me-9 flex-shrink-0" alt=""/>
                        <div>
                            <h6 class="mb-1" style="max-width:95%; overflow: hidden; text-overflow: ellipsis;  white-space: nowrap;">{{$cart->product->name}}</h6>
                            <p class="mb-0 text-muted fs-2">{{$cart->product->category->name}}</p>
                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <h6 class="fs-2 fw-semibold mb-0 text-muted">
                                    @if($cart->product->sale_price == null)
                                    {{$cart->product->price}} VND (X{{$cart->quantity}}) 
                                    @else
                                    {{$cart->product->sale_price}} VND (X{{$cart->quantity}}) 
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            @php
            $subtotal += intVal(str_replace('.','', $cart->total));
            
            @endphp
            @endforeach
            @php
            $vat = $subtotal * 0.1;
            @endphp
            @else
            <div class="d-flex align-items-center justify-content-center mb-4">
                <h6 class="fs-2 fw-semibold mb-0 text-muted">No product in cart</h6>
            </div>
            @endif
            <div class="align-bottom">
                <div class="d-flex align-items-center pb-7 border-top pt-5">
                    <span class="text-dark fs-3">Sub Total</span>
                    <div class="ms-auto">
                        <span class="text-dark fw-semibold fs-3">{{$subtotal}} VND</span>
                    </div>
                </div>
                <div class="d-flex align-items-center pb-7">
                    <span class="text-dark fs-3">VAT <span class="fs-2">(10%)</span></span>
                    <div class="ms-auto">
                        <span class="text-dark fw-semibold fs-3">{{$vat}} VND</span>
                    </div>
                </div>
                <div class="d-flex align-items-center pb-7">
                    <span class="text-dark fs-3">Total</span>
                    <div class="ms-auto">
                        <span class="text-dark fw-semibold fs-3">{{$subtotal + $vat}} VND</span>
                    </div>
                </div>
            </div>
            
            <div class="align-bottom">
                <a href="{{route('client.cart')}}" class="btn btn-outline-primary w-100">Go to shopping
                    cart</a>
            </div>
        </div>
    </div>
    <!--  Search Bar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content rounded-1">
                <div class="modal-header border-bottom">
                    <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
                    <a href="javascript:void(0)" data-bs-dismiss="modal" class="lh-1">
                        <i class="ti ti-x fs-5 ms-3"></i>
                    </a>
                </div>
                <div class="modal-body message-body" data-simplebar="">
                    <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
                    <ul class="list mb-0 py-2">
                        <li class="p-1 mb-1 bg-hover-light-black">
                            <a href="#">
                                <span class="fs-3 text-dark fw-normal d-block">Modern</span>
                                <span class="fs-3 text-muted d-block">/dashboards/dashboard1</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    
</body>

</html>
