<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function shop()
    {
        $products = Product::paginate(9);
        return view('clients.pages.shop',compact('products'));
    }
    public function productDetail(Product $product)
    {
        $product = $product->load('category', 'coverPhotos');
        $listCoverPhoto = $product->coverPhotos->pluck('image')->prepend($product->images);
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(4)->get();
        $renderColors = explode(' ', $product->color);
        // dd($renderColors);
        return view('clients.pages.product-detail',compact('product','listCoverPhoto','relatedProducts','renderColors'));
    }
}
