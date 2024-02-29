<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

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
        $categories = Category::all();
        $products = Product::where('name', 'like', '%' . $request->search . '%')->paginate(9);
        return view('clients.pages.shop', compact('products','categories'));
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
    function saveInfor(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]);
            $data = $request->all();
            Session::put('saveInfo', $data);
            $user = auth()->user();
            $user->update($data);
    
            return redirect()->route('client.checkout');
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    public function order(Request $request){
       try{
        $user_id = auth()->user()->id;
        $cart_id = $request->cart_id;
        $payment_methods = $request->payment_methods;
        $data = [
            'user_id' => $user_id,
            'cart_id' => $cart_id,
            'payment_methods' => $payment_methods,
        ];
        $order = Order::create($data);
        return response()->json(['success' => 'Order successfully!'], 200);
       }catch(\Exception $e){
           return response()->json(['errors' => $e->getMessage()], 422);
       }
    }
}
