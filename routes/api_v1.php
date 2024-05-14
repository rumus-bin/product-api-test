<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [App\Http\Controllers\Api\V1\UserController::class, 'create'])->name('user.register');
Route::post('/login', [App\Http\Controllers\Api\V1\AuthController::class, 'login'])->name('login');

//Route::middleware('auth:sanctum')
//    ->get('/products', [App\Http\Controllers\Api\V1\ProductController::class, 'index'])
//    ->name('products.index');

Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::get('/products', [App\Http\Controllers\Api\V1\ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/product/{id}', [App\Http\Controllers\Api\V1\ProductController::class, 'get'])
        ->name('product.get');
});
