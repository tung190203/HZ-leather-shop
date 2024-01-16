<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientCartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'color' => 'required',
            'quantity' => 'numeric|min:1',
        ]);
        $salePrice = $request->input('sale_price') ?? $request->input('price');
        $priceWithoutComma = str_replace('.', '', $salePrice);
        $priceAsNumber = intval($priceWithoutComma);
        $subtotal = $request->input('quantity') * $priceAsNumber;
        $total = number_format($subtotal, 0, ',', '.');
        if (Auth::check()) {
            try {
                DB::beginTransaction();
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->input('product_id'),
                    'color' => $request->input('color'),
                    'quantity' => $request->input('quantity') ?? 1,
                    'total' => $total,
                    'status' => config('default.cart.status.pending'),
                ]);
                $cart->save();
                $product = Product::where('id', $request->input('product_id'))->first();
                $product->update([
                    'quantity' => $product->quantity - $request->input('quantity'),
                ]);
                DB::commit();
                return redirect()->back()->with('success', 'Product added to cart successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Error adding product to cart');
            }
        } else {
            return redirect()->route('login')->with('error', 'Please log in to add products to your cart');
        }
    }
    public function cart()
    {
        $carts = Cart::where('user_id', Auth::id())->where('status', config('default.cart.status.pending'))->paginate(5);
        return view('clients.pages.cart', compact('carts'));
    }
    public function deleteCart(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with('success', 'Cart deleted successfully');
    }
}
