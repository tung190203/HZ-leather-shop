<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">

<head>
    @include('clients.layouts.header')
</head>

<body>
    <div id="main-wrapper">
        @if (
            !in_array(request()->route()->getName(), [
                'client.login',
                'client.register',
                'client.forgot',
                'client.verify',
                'client.change.password',
            ]))
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
                if (Auth::check()) {
                    $carts = App\Models\Cart::where('user_id', Auth::id())->where('status', config('default.cart.status.pending'))->get();
                    $totalCart = $carts->count() ?? 0;
                } else {
                    // Nếu không có người dùng đăng nhập, không làm gì cả
                    $totalCart = 0;
                }

                $subtotal = 0;
                $vat = 0;

            @endphp
            @if ($totalCart > 0)
                <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">{{ $totalCart }} new</span>
            @else
                <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm"></span>
            @endif
        </div>
        <div class="offcanvas-body h-100 px-4 pt-0">
            @if ($totalCart > 0)
                @foreach ($carts as $cart)
                    <ul class="mb-0">
                        <li class="pb-7">
                            <div class="row">
                                <div class="d-flex align-items-center justify-content-between col-12">
                                    <div class="d-flex align-items-center justify-content-start col-10">
                                        <img src="{{ Storage::disk('minio')->url($cart->product->images) }}"
                                            width="95" height="75" class="rounded-1 me-9 flex-shrink-0"
                                            alt="" />
                                        <div>
                                            <h6 class="mb-1"
                                                style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:130px">
                                                {{ $cart->product->name }}</h6>
                                            <p class="mb-0 text-muted fs-2">{{ $cart->product->category->name }}</p>
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <h6 class="fs-2 fw-semibold mb-0 text-muted">
                                                    @if ($cart->product->sale_price == null)
                                                        {{ $cart->product->price }} VND (X{{ $cart->quantity }})
                                                    @else
                                                        {{ $cart->product->sale_price }} VND (X{{ $cart->quantity }})
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <form action="{{ route('client.cart.delete', ['cart' => $cart->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn "><i
                                                    class="ti ti-trash fs-5 text-danger"></i></button>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </li>
                    </ul>
                    @php
                        $subtotal += intVal(str_replace('.', '', $cart->total));
                    @endphp
                @endforeach
                @php
                    $vat = $subtotal * 0.1;
                @endphp
                <div class="align-bottom">
                    <div class="d-flex align-items-center pb-7 border-top pt-5">
                        <span class="text-dark fs-3">Sub Total</span>
                        <div class="ms-auto">
                            <span id="subtotalVal" class="text-dark fw-semibold fs-3"></span>
                            <script>
                                convertAndDisplayValue('subtotalVal', {{ $subtotal }});
                            </script>

                        </div>
                    </div>
                    <div class="d-flex align-items-center pb-7">
                        <span class="text-dark fs-3">VAT <span class="fs-2">(10%)</span></span>
                        <div class="ms-auto">
                            <span id="vatVal" class="text-dark fw-semibold fs-3"></span>
                            <script>
                                convertAndDisplayValue('vatVal', {{ $vat }});
                            </script>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pb-7">
                        <span class="text-dark fs-3">Total</span>
                        <div class="ms-auto">
                            <span id="totalVal" class="text-dark fw-semibold fs-3"></span>
                            <script>
                                convertAndDisplayValue('totalVal', {{ $subtotal + $vat }});
                            </script>
                        </div>
                    </div>
                    <div class="align-bottom">
                        <a href="{{ route('client.checkout') }}" class="btn btn-outline-primary w-100">Go to
                            Checkout</a>
                    </div>
                </div>
            @else
                <div class="d-flex align-items-center justify-content-center mb-4">
                    <h6 class="fs-2 fw-semibold mb-0 text-muted">No product in cart</h6>
                </div>
            @endif


        </div>
    </div>
    <!--  Search Bar -->
    <form action="" class="form" method="post">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content rounded-1">
                    <div class="modal-header border-bottom">

                        @csrf
                        <input type="search" class="form-control fs-3" name="search" placeholder="Search here"
                            id="search" />
                        <a data-bs-dismiss="modal" class="lh-1">
                            <i class="ti ti-x fs-5 ms-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

</body>

</html>
