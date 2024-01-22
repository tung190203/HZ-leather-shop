@extends('index')
@section('content')
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 w-xs-100 chat-container">
                        <div class="invoice-inner-part h-100">
                            <form action="" method="post">
                                @csrf
                                <div class="invoiceing-box">
                                    <div class="invoice-header d-flex align-items-center border-bottom p-3">
                                        <h4 class="font-medium text-uppercase mb-0">Invoice -
                                            HZ#{{ str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) }}</h4>
                                        <div class="ms-auto">
                                            <h4 class="invoice-number"></h4>
                                        </div>
                                    </div>
                                    <div class="p-3" id="custom-invoice">
                                        <div class="invoice-123" id="printableArea">
                                            <div class="row pt-3">
                                                <div class="col-md-12">
                                                    <div class="">
                                                        <address>
                                                            <h6>&nbsp;From,</h6>
                                                            <h6 class="fw-bold">&nbsp;Hz-Leather</h6>
                                                            <p class="ms-1">
                                                                1108, Clair Street, <br />Massachusetts,
                                                                <br />Woods Hole - 02543
                                                            </p>
                                                        </address>
                                                    </div>
                                                    <div class="text-end">
                                                        <address>
                                                            <h6>To,</h6>
                                                            <h6 class="fw-bold invoice-customer">
                                                                {{ auth()->user()->first_name }}
                                                                {{ auth()->user()->last_name }}
                                                            </h6>
                                                            <p class="ms-4">
                                                                {{ auth()->user()->address }}
                                                            </p>
                                                            <p class="mt-4 mb-1">
                                                                <span>Invoice Date :</span>
                                                                <i class="ti ti-calendar"></i>
                                                                {{ date('d-m-Y') }}
                                                            </p>
                                                        </address>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive mt-5" style="clear: both">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <!-- start row -->
                                                                <tr>
                                                                    <th class="text-center">#</th>
                                                                    <th>Description</th>
                                                                    <th class="text-end">Quantity</th>
                                                                    <th class="text-end">Unit Cost</th>
                                                                    <th class="text-end">Total</th>
                                                                </tr>
                                                                <!-- end row -->
                                                            </thead>
                                                            <tbody>
                                                                <!-- start row -->
                                                                @php
                                                                    $total = 0;
                                                                @endphp
                                                                @foreach ($carts as $cart)
                                                                    <tr>
                                                                        <td class="text-center">{{ $cart->id }}</td>
                                                                        <td>{{ $cart->product->name }}</td>
                                                                        <td class="text-end">{{ $cart->quantity }}</td>
                                                                        @if ($cart->product->sale_price == null)
                                                                            <td class="text-end">{{ $cart->product->price }}
                                                                                VND
                                                                            </td>
                                                                        @else
                                                                            <td class="text-end">
                                                                                {{ $cart->product->sale_price }} VND</td>
                                                                        @endif
                                                                        <td class="text-end">{{ $cart->total }} VND</td>
                                                                    </tr>
                                                                    @php
                                                                        $total += intVal(str_replace('.', '', $cart->total));
                                                                    @endphp
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @php
                                                    $vat = $total * 0.1;
                                                    $totalWithVat = $total + $vat;
                                                @endphp
                                                <div class="col-md-12">
                                                    <div class="pull-right mt-1 text-end mt-4">
                                                        <p>Sub - Total amount: {{ number_format($total, 0, ',', '.') }}
                                                            VND</p>
                                                        <p>Vat (10%) : {{ number_format($vat, 0, ',', '.') }} VND</p>
                                                        <hr />
                                                        <h3><b>Total :</b>
                                                            {{ number_format($totalWithVat, 0, ',', '.') }}VND
                                                        </h3>
                                                    </div>
                                                    <hr />
                                                    <div class="text-end">
                                                        <button class="btn bg-danger-subtle text-danger" type="submit">
                                                            Proceed to payment
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
