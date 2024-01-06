<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{
    public function product()
    {
        $products = Product::paginate(10);
        return view('admin.pages.products.product', compact('products'));
    }
    public function createProduct(Request $request)
    {
        $categories = Category::all();
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'price' => 'required',
                'sale_price' => 'nullable|string',
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
            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();

            // Lưu ảnh lên MinIO
            Storage::disk('minio')->put($imageName, file_get_contents($imagePath));
            $product = new Product([
                'name' => $request->input('name'),
                'images' => $imageName,
                'price' => $request->input('price'),
                'sale_price' => $request->input('sale_price'),
                'quantity' => $request->input('quantity'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'status' => config('default.product.status.in_stock'),
            ]);
            $product->save();
            return redirect()->route('admin.product.create')->with('success', 'Create product success');
        }
        return view('admin.pages.products.create', compact('categories'));
    }
    public function detailProduct(Request $request, Product $product)
    {
        $categories = Category::whereNotIn('id', [$product->category_id])->get();
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'price' => 'required',
                'sale_price' => 'nullable|string',
                'description' => 'required|string',
                'images' => 'image|mimes:jpeg,png,jpg',
                'quantity' => 'required',
                'category_id' => 'required|string',
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->sale_price = $request->input('sale_price');
            $product->quantity = $request->input('quantity');
            $product->description = $request->input('description');
            $product->category_id = $request->input('category_id');
            if ($request->hasFile('images')) {
                $imagePath = $request->file('images');
                if ($product->images) {
                    Storage::disk('minio')->delete($product->images);
                }
                $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
                Storage::disk('minio')->put($imageName, file_get_contents($imagePath));
                $product->images = $imageName;
            }
            $product->save();
            return redirect()->route('admin.product.detail', $product->id)->with('success', 'Update product success');
        }
        return view('admin.pages.products.detail', compact('product', 'categories'));
    }
    public function deleteProduct(Product $product)
    {
        try {
            DB::beginTransaction();
            Storage::disk('minio')->delete($product->images);
            $product->delete();
            DB::commit();
            return redirect()->route('admin.product')->with('success', 'Delete product success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product')->with('error', 'Lỗi khi xóa sản phẩm');
        }
    }
}
