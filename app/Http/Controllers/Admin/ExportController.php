<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportProduct(){
        $products = Product::all();
        return Excel::download(
            view('admin.pages.products.product',compact('products')),
            'product.xlsx',
            \Maatwebsite\Excel\Excel::XLSX
        );
    }
}
