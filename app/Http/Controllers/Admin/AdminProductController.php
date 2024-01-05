<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{
    public function product(){
        $products = Product::with('categories')->get();
        return view('admin.pages.products.product',compact('products'));
    }
    public function createProduct(Request $request){
        $categories = Category::all();
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'price' => 'required',
                'description' => 'required|string',
                'images' => 'required|image|mimes:jpeg,png,jpg',
                'quantity' => 'required',
                'category_id' => 'required|string',
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $imagePath = $request->file('images');
            $imageName = time().'.'.$imagePath->getClientOriginalExtension();

            // Lưu ảnh lên MinIO
            Storage::disk('minio')->put($imageName, file_get_contents($imagePath));
            $product = new Product([
                'name' => $request->input('name'),
                'images' => $imageName,
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'status' => config('default.product.status.in_stock'),
            ]);
            $product->save();
            return redirect()->route('admin.product.create')->with('success','Create product success');

        }
        return view('admin.pages.products.create',compact('categories'));
    }
}
