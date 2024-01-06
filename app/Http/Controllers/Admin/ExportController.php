<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CategoryExport;
use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportProduct()
    {
        $products = Product::all();
        return (new ProductExport)->download('products.xlsx');
    }
    public function exportCategory()
    {
        $categories = Category::all();
        return (new CategoryExport)->download('categories.xlsx');
    }
}
