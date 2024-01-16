@extends('index')
@section('content')
    <div class="body-wrapper">
        <div class="container-fluid" style="min-height: 700px">
            <div class="row card mb-4">
                <div class="card-header  bg-white">
                    <h3 class="card-title mt-4">Shopping Cart</h3>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total (no VAT)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($carts) > 0)
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td>{{ $cart->id }}</td>
                                        <td>
                                            <img src="{{ Storage::disk('minio')->url($cart->product->images) }}"
                                                class="rounded" width="75" height="75" alt="">
                                        </td>
                                        <td>{{ $cart->quantity }} Product</td>
                                        <td>{{ $cart->product->price }} VND</td>
                                        <td>{{ $cart->total }} VND</td>
                                        <td>
                                            <form action="{{ route('client.cart.delete', ['cart' => $cart->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="ti ti-trash fs-3"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">No product in cart</td>
                                </tr>
                                @endif
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item ">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $carts->lastPage(); $i++)
                                    <li class="page-item {{ $i == $carts->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $carts->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $carts->nextPageUrl() }}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    @endsection
