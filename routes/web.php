<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSideController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ClientCartController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Client\ClientSideController;
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
Route::prefix('admin')->group(function () {
    Route::match(['get', 'post'], 'login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::get('/404', function () {
        return view('admin.pages.404');
    })->name('admin.error');
});
Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        //Other
        Route::get('/dashboard', [AdminSideController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        //User
        Route::prefix('user')->group(function () {
            Route::get('/', [AdminAuthController::class, 'user'])->name('admin.user');
            Route::match(['get', 'post'], 'create', [AdminAuthController::class, 'createUser'])->name('admin.user.create');
            Route::match(['get', 'put'], 'detail/{user}', [AdminAuthController::class, 'detailUser'])->name('admin.user.detail');
            Route::delete('/delete/{user}', [AdminAuthController::class, 'deleteUser'])->name('admin.user.delete');
        });
        //Product
        Route::prefix('product')->group(function () {
            Route::get('/', [AdminProductController::class, 'product'])->name('admin.product');
            Route::match(['get', 'post'], 'create', [AdminProductController::class, 'createProduct'])->name('admin.product.create');
            Route::match(['get', 'put'], 'detail/{product}', [AdminProductController::class, 'detailProduct'])->name('admin.product.detail');
            Route::delete('/delete/{product}', [AdminProductController::class, 'deleteProduct'])->name('admin.product.delete');
        });
        //Category
        Route::prefix('category')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'category'])->name('admin.category');
            Route::match(['get', 'post'], 'create', [AdminCategoryController::class, 'createCategory'])->name('admin.category.create');
            Route::match(['get', 'put'], 'detail/{category}', [AdminCategoryController::class, 'detailCategory'])->name('admin.category.detail');
            Route::delete('/delete/{category}', [AdminCategoryController::class, 'deleteCategory'])->name('admin.category.delete');
        });
        //Export Data
        Route::prefix('export')->group(function () {
            Route::get('/product', [ExportController::class, 'exportProduct'])->name('admin.export.product');
            Route::get('/category', [ExportController::class, 'exportCategory'])->name('admin.export.category');
            Route::get('/user', [ExportController::class, 'exportUser'])->name('admin.export.user');
        });
        Route::prefix('banner')->group(function () {
            Route::get('/', [AdminBannerController::class, 'banner'])->name('admin.banner');
            Route::match(['get', 'post'], 'create', [AdminBannerController::class, 'createBanner'])->name('admin.banner.create');
            Route::match(['get', 'put'], 'detail/{banner}', [AdminBannerController::class, 'detailBanner'])->name('admin.banner.detail');
            Route::delete('/delete/{banner}', [AdminBannerController::class, 'deleteBanner'])->name('admin.banner.delete');
        });
        
    });
});
//social
Route::get('/login/facebook', [AuthController::class, 'redirectToFacebook'])->name('client.login.facebook');
Route::get('/login/facebook/callback', [AuthController::class, 'handleFacebookCallback'])->name('client.login.facebook.callback');
//Client Side
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('client.login');
Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('client.register');
Route::match(['get', 'post'], '/forgot', [AuthController::class, 'forgot'])->name('client.forgot');
Route::match(['get', 'post'], '/verify', [AuthController::class, 'verify'])->name('client.verify');
Route::match(['get', 'post'], '/change-password', [AuthController::class, 'changePassword'])->name('client.change.password');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('client.logout');
    //Client Side
    Route::get('/', [ClientSideController::class, 'home'])->name('client.home');
    Route::prefix('shop')->group(function () {
        Route::get('/', [ClientProductController::class, 'shop'])->name('client.shop');
        Route::get('/search', [ClientProductController::class, 'search'])->name('client.shop.search');
        Route::get('/filter/{item}', [ClientProductController::class, 'filter'])->name('client.shop.filter');
      
    });
    Route::prefix('cart')->group(function(){
        Route::get('/', [ClientCartController::class, 'cart'])->name('client.cart');
        Route::post('/add', [ClientCartController::class, 'addToCart'])->name('client.cart.add');
        Route::post('/update', [ClientCartController::class, 'updateCart'])->name('client.cart.update');
        Route::delete('/delete/{cart}', [ClientCartController::class, 'deleteCart'])->name('client.cart.delete');
    });
    Route::get('/checkout', [ClientSideController::class, 'checkout'])->name('client.checkout');
    Route::post('checkout/save-infor', [ClientProductController::class, 'saveInfor'])->name('client.saveInfor');
    Route::post('checkout/order', [ClientProductController::class, 'order'])->name('client.order');
    Route::get('/product-detail/{product}', [ClientProductController::class, 'productDetail'])->name('client.product.detail');
    Route::get('/contact', [ClientSideController::class, 'contact'])->name('client.contact');
    Route::match(['get','put'],'/profile', [ClientSideController::class, 'profile'])->name('client.profile');
});
