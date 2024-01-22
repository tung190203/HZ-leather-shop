<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function shop()
    {
        $categories = Category::all();
        $products = Product::paginate(9);
        return view('clients.pages.shop', compact('products','categories'));
    }
    public function productDetail(Product $product)
    {
        $product = $product->load('category', 'coverPhotos');
        $listCoverPhoto = $product->coverPhotos->pluck('image')->prepend($product->images);
        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(4)->get();
        $renderColors = explode(' ', $product->color);
        // dd($renderColors);
        return view('clients.pages.product-detail', compact('product', 'listCoverPhoto', 'relatedProducts', 'renderColors'));
    }
    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search . '%')->paginate(9);
        return view('clients.pages.shop', compact('products'));
    }
    public function filter(Request $request, $item)
    {
        $categories = Category::all();
        switch ($item) {
            case 'all':
                $products = Product::paginate(9);
                break;
            case 'new':
                $products = Product::orderBy('created_at', 'desc')->paginate(9);
                break;
            case 'low':
                $products = Product::orderBy('price', 'desc')->paginate(9);
                break;
            case 'hight':
                $products = Product::orderBy('price', 'asc')->paginate(9);
                break;
            case 'sale':
                $products = Product::whereNotNull('sale_price')->paginate(9);
                break;
            case 'category':
                $category_id = $request->category_id;
                $products = Product::where('category_id', $request->category_id)->paginate(9);
                break;
            case 'price':
                $price = $request->input('price',0);
                $products = Product::where(function ($query) use ($price) {
                    $query->whereRaw('CAST(REPLACE(price, ".", "") AS UNSIGNED) >= ?', $price);
                })->paginate(9);
                break;
            case 'reset':
                return redirect()->route('client.shop');
            default:
                $products = Product::paginate(9);
                break;
        }
        return view('clients.pages.shop', compact('products','categories'))->with('success', 'Filter successfully!');
    }
}
