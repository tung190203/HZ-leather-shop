@extends('index')
@section('content')
    <style>
        .step {
            display: none;
        }

        .step[data-step="1"] {
            display: block;
        }
    </style>
    <div class="body-wrapper">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="step" data-step="1">
                <div class="card">
                    <div class="card-body">
                        <div class="w-100 w-xs-100 chat-container">
                            <div class="invoice-inner-part h-100">
                                <div class="invoiceing-box">
                                    <div class="invoice-header d-flex align-items-center border-bottom p-3">
                                        <h4 class="font-medium text-uppercase mb-0">Personal Information</h4>
                                        <div class="ms-auto">
                                            <i class="invoice-number">Please confirm information before continuing</i>
                                        </div>
                                    </div>
                                    <div class="p-3" id="custom-invoice">
                                        <div class="invoice-123" id="printableArea">
                                            <div class="row pt-3">
                                                <div class=" col-md-12">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6 col-xl-6 col-sm-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">UserName</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ auth()->user()->username }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6 col-xl-6 col-sm-12">
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">Email</label>
                                                                <input type="email" class="form-control"
                                                                    value="{{ auth()->user()->email }}"
                                                                    aria-describedby="emailHelp" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-6 col-lg-4 col-xl-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">First
                                                                    Name</label>
                                                                <input type="text" class="form-control" name="first_name"
                                                                    id="first_name"
                                                                    value="{{ auth()->user()->first_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-lg-4 col-xl-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Last
                                                                    Name</label>
                                                                <input type="text" class="form-control" name="last_name"
                                                                    id="last_name" value="{{ auth()->user()->last_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-4 col-xl-4 col-sm-12">
                                                            <div class="mb-3">
                                                                <label class="form-label">Phone Number</label>
                                                                <input type="text" class="form-control" id="phone"
                                                                    name="phone" value="{{ auth()->user()->phone }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (auth()->user()->address == null)
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6 col-xl-6 col-sm-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label"> Exact Address
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        value="" id="address1"
                                                                        placeholder="Street Name, House Number, Building"
                                                                        oninput="combineInputs()">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6 col-xl-6 col-sm-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Province/City</label>
                                                                    <input type="text" class="form-control"
                                                                        value="" id="address2"
                                                                        placeholder="Province/City, District, Ward/Commune"
                                                                        oninput="combineInputs()">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirm Address</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ auth()->user()->address }}" id="result"
                                                            name="address">

                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="text-start">
                                                        <div class="form-check form-switch py-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="flexSwitchCheckDefault" onchange="saveInfor()" />
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckDefault">Save information for
                                                                future purchases</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="text-end">
                                                        <button type="button" class="btn bg-primary-subtle text-primary"
                                                            onclick="prevStep(this)">Previous</button>
                                                        <button class="btn bg-danger-subtle text-danger" type="button"
                                                            onclick="nextStep(this)">
                                                            Next
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="multiStepForm" action="{{ route('client.order') }}" method="POST">
                @csrf
                <div class="step" data-step="2">
                    <div class="card">
                        <div class="card-body">
                            <div class="w-100 w-xs-100 chat-container">
                                <div class="invoice-inner-part h-100">
                                    <div class="invoiceing-box">
                                        <div class="invoice-header d-flex align-items-center border-bottom p-3">
                                            <h4 class="font-medium text-uppercase mb-0">Invoice
                                            </h4>
                                            <div class="ms-auto">
                                                <h4 class="invoice-number">
                                                    HZ#{{ str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) }}</h4>
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
                                                                <h6 class="fw-bold invoice-customer" id="fullNameChecker">
                                                                    {{ auth()->user()->first_name }}
                                                                    {{ auth()->user()->last_name }}
                                                                </h6>
                                                                <p class="ms-4" id="addressChecker">
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
                                                                            <td class="text-center">{{ $cart->id }}
                                                                            </td>
                                                                            <td>{{ $cart->product->name }}</td>
                                                                            <td class="text-end">{{ $cart->quantity }}
                                                                            </td>
                                                                            @if ($cart->product->sale_price == null)
                                                                                <td class="text-end">
                                                                                    {{ $cart->product->price }}
                                                                                    VND
                                                                                </td>
                                                                            @else
                                                                                <td class="text-end">
                                                                                    {{ $cart->product->sale_price }} VND
                                                                                </td>
                                                                            @endif
                                                                            <td class="text-end">{{ $cart->total }} VND
                                                                            </td>
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
                                                            <button type="button"
                                                                class="btn bg-primary-subtle text-primary"
                                                                onclick="prevStep(this)">Previous</button>
                                                            <button class="btn bg-danger-subtle text-danger"
                                                                type="submit" onclick="nextStep(this)">
                                                                Purchase
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step" data-step="3">
                    <div class="card">
                        <div class="card-body">
                            <div class="w-100 w-xs-100 chat-container">
                                <div class="invoice-inner-part h-100">
                                    <div class="invoiceing-box">
                                        <div class="p-3" id="custom-invoice">
                                            <div class="invoice-123" id="printableArea">
                                                <div class="row pt-3">
                                                    <div class="col-md-12 mb-3">

                                                        <div class="text-center">
                                                            <img src="{{ asset('assets/images/logo.png') }}"
                                                                width="100" alt="" class="mb-3 mt-3">
                                                            <h3 class="text-danger">Thank you for your purchase</h3>
                                                            <p class="text-muted">Your order has been placed and is being
                                                                processed. When the item is shipped, you will receive an
                                                                email with the tracking information.</p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="text-end">
                                                                <button class="btn bg-primary-subtle text-primary"
                                                                    type="button" onclick="backToHome()">
                                                                    Back to Home
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
