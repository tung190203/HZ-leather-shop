<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    public function category(){
        $categories = Category::all();
        return view('admin.pages.categories.category',compact('categories'));
    }
    public function createCategory(Request $request){
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'description' => 'required|string',     
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $category = new Category([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
            $category->save();
            return redirect()->route('admin.category.create')->with('success','Create category success');

        }
        return view('admin.pages.categories.create');
    }
    public function editCategory(Request $request,Category $category){
        $category = Category::where('id',$category->id)->get();
        if($request->isMethod('post')){
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'description' => 'required|string',     
            ]);
            try {
                $validator->validate();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->save();
            return redirect()->route('admin.category.edit',$category->id)->with('success','Edit category success');

        }
        return view('admin.pages.categories.edit',compact('category'));
    }
}
