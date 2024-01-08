<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function shop()
    {
        return view('clients.pages.shop');
    }
    public function productDetail()
    {
        return view('clients.pages.product-detail');
    }
}
