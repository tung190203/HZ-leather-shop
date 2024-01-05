<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSideController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientSideController;
use App\Http\Controllers\Admin\ExportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Admin Side
Route::prefix('admin')->group(function(){
    Route::match(['get','post'],'login',[AdminAuthController::class,'login'])->name('admin.login');
    Route::get('/404',function(){return view('admin.pages.404');})->name('admin.error');
});
Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function(){
        //Other
        Route::get('/dashboard',[AdminSideController::class,'dashboard'])->name('admin.dashboard');
        Route::get('/logout',[AdminAuthController::class,'logout'])->name('admin.logout');
        //User
        Route::prefix('user')->group(function(){
            Route::get('/',[AdminAuthController::class,'user'])->name('admin.user');
            Route::match(['get','post'],'create',[AdminAuthController::class,'createUser'])->name('admin.user.create');
            Route::match(['get','post'],'edit/{id}',[AdminAuthController::class,'editUser'])->name('admin.user.edit');
            Route::get('/delete/{id}',[AdminAuthController::class,'deleteUser'])->name('admin.user.delete');
        });
        //Product
        Route::prefix('product')->group(function(){
            Route::get('/',[AdminProductController::class,'product'])->name('admin.product');
            Route::match(['get','post'],'create',[AdminProductController::class,'createProduct'])->name('admin.product.create');    
        });
        //Category
        Route::prefix('category')->group(function(){
            Route::get('/',[AdminCategoryController::class,'category'])->name('admin.category');
            Route::match(['get','post'],'create',[AdminCategoryController::class,'createCategory'])->name('admin.category.create');    
        });
        //Export Data
        Route::prefix('export')->group(function(){
            Route::get('/product',[ExportController::class,'exportProduct'])->name('admin.export.product');
        });
    });
});

//Client Side

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('client.login');
Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('client.register');
Route::match(['get', 'post'], '/forgot', [AuthController::class, 'forgot'])->name('client.forgot');

Route::middleware(['auth'])->group(function () {
   

    Route::get('/logout', [AuthController::class, 'logout'])->name('client.logout');
    //Client Side
    Route::get('/', [ClientSideController::class, 'home'])->name('client.home');
    Route::get('/shop', [ClientSideController::class, 'shop'])->name('client.shop');
    Route::get('/cart', [ClientSideController::class, 'cart'])->name('client.cart');
    Route::get('/checkout', [ClientSideController::class, 'checkout'])->name('client.checkout');
    Route::get('/product-detail', [ClientSideController::class, 'productDetail'])->name('client.product.detail');
    Route::get('/contact', [ClientSideController::class, 'contact'])->name('client.contact');
});
