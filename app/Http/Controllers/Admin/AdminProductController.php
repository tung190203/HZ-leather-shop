<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CoverPhoto;
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
                'images' => 'required|image|mimes:jpeg,png,jpg',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
                'price' => 'required',
                'sale_price' => 'nullable|string',
                'quantity' => 'required',
                'color' => 'required|string',
                'description' => 'required|string',
                'category_id' => 'required|string',
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //main image
            $imagePath = $request->file('images');
            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
            Storage::disk('minio')->put($imageName, file_get_contents($imagePath));
            $coverPhotoPaths = $request->file('image');
            $coverPhotos = [];
            foreach ($coverPhotoPaths as $coverPhotoPath) {
                $coverPhotoName = time() . '_' . uniqid() . '.' . $coverPhotoPath->getClientOriginalExtension();
                Storage::disk('minio')->put($coverPhotoName, file_get_contents($coverPhotoPath));
                $coverPhotos[] = $coverPhotoName;
            }
            // Tạo sản phẩm
            $product = new Product([
                'name' => $request->input('name'),
                'images' => $imageName,
                'price' => $request->input('price'),
                'sale_price' => $request->input('sale_price'),
                'quantity' => $request->input('quantity'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'color' => $request->input('color'),
                'status' => config('default.product.status.in_stock'),

            ]);
            $product->save();
            // Tạo các ảnh bìa và liên kết chúng với sản phẩm
            foreach ($coverPhotos as $coverPhoto) {
                $coverPhotoModel = new CoverPhoto([
                    'product_id' => $product->id,
                    'image' => $coverPhoto,
                ]);
                $coverPhotoModel->save();
            }
            return redirect()->route('admin.product.create')->with('success', 'Create product success');
        }
        return view('admin.pages.products.create', compact('categories'));
    }
    public function detailProduct(Request $request, Product $product)
    {   
        $product->load('coverPhotos');
        $categories = Category::all();
        if ($request->isMethod('put')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'images' => 'image|mimes:jpeg,png,jpg',
                'image.*' => 'sometimes|image|mimes:jpeg,png,jpg',
                'price' => 'required',
                'sale_price' => 'nullable|string',
                'quantity' => 'required',
                'description' => 'required|string',
                'category_id' => 'required|string',
                'color'=> 'required|string',
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
            $product->color = $request->input('color');
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
            if ($request->hasFile('image')) {
                $coverPhotoPaths = $request->file('image');
                if($product->coverPhotos->count() > 0){
                    foreach ($product->coverPhotos as $coverPhoto) {
                        Storage::disk('minio')->delete($coverPhoto->image);
                        $coverPhoto->delete();
                    }
                }
                $coverPhotos = [];
                foreach ($coverPhotoPaths as $coverPhotoPath) {
                    $coverPhotoName = time() . '_' . uniqid() . '.' . $coverPhotoPath->getClientOriginalExtension();
                    Storage::disk('minio')->put($coverPhotoName, file_get_contents($coverPhotoPath));
                    $coverPhotos[] = $coverPhotoName;
                }
                foreach ($coverPhotos as $coverPhoto) {
                    $coverPhotoModel = new CoverPhoto([
                        'product_id' => $product->id,
                        'image' => $coverPhoto,
                    ]);
                    $coverPhotoModel->save();
                }
            }
            return redirect()->route('admin.product.detail', $product->id)->with('success', 'Update product success');
        }
        return view('admin.pages.products.detail', compact('product', 'categories'));
    }
    public function deleteProduct(Product $product)
    {
        try {
            DB::beginTransaction();
            Storage::disk('minio')->delete($product->images);
            foreach ($product->coverPhotos as $coverPhoto) {
                Storage::disk('minio')->delete($coverPhoto->image);
                $coverPhoto->delete();
            }
            $product->delete();
            DB::commit();
            return redirect()->route('admin.product')->with('success', 'Delete product success');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product')->with('error', 'Lỗi khi xóa sản phẩm');
        }
    }
}
