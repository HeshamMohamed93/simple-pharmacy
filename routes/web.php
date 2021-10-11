<?php

use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.index');
})->name('home');


Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::resource('product', ProductController::class);
Route::resource('pharmacy', PharmacyController::class);
Route::post('pharmacy/products/{pharmacy}', [PharmacyController::class, 'addProducts'])->name('pharmacy.add-products');
Route::get('pharmacy/products/{pharmacy}', [PharmacyController::class, 'listProducts'])->name('pharmacy.list-products');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');
