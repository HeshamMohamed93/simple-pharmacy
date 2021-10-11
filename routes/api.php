<?php

use App\Http\Controllers\API\PharmacyController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('pharmacy/products/{pharmacy}', [PharmacyController::class, 'addProducts'])->name('pharmacy.add-products');
Route::resource('pharmacy', PharmacyController::class);
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::resource('product', ProductController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
