<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\user\UserProductController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('/product/{id}', [HomeController::class, 'showProductDetails'])->name('product.details');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('redirect',[HomeController::class,'redirect']);

Route::get('view_category',[AdminController::class,'view_category']);
Route::post('add_category',[AdminController::class,'add_category']);

Route::get('edit_category/{id}', [AdminController::class, 'edit'])->name('edit_category');
Route::put('update_category/{id}', [AdminController::class, 'update'])->name('admin.update_category');
Route::delete('delete_category/{id}', [AdminController::class, 'delete'])->name('admin.delete_category');

Route::resource('products',ProductController::class);



// User Routes

//Route::resource('uProducts',UserProductController::class);

//cart route


Route::middleware('auth')->group(function () {
    // View the cart for the authenticated user
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');

    // Add a product to the cart
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

    // Update the quantity of a product in the cart
    Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');

    // Remove a product from the cart
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Clear the cart for the authenticated user
    Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
});



