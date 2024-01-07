<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientSideController extends Controller
{
    public function home()
    {
        return view('clients.pages.home');
    }
    public function shop()
    {
        return view('clients.pages.shop');
    }
    public function cart()
    {
        return view('clients.pages.cart');
    }
    public function checkout()
    {
        return view('clients.pages.checkout');
    }
    public function productDetail()
    {
        return view('clients.pages.product-detail');
    }
    public function contact()
    {
        return view('clients.pages.contact');
    }
}
