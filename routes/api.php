<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('show-image', [ImageUploadController::class, 'show']);
Route::get('upload-image', [ ImageUploadController::class, 'index' ]);
Route::post('upload-image', [ ImageUploadController::class, 'store' ])->name('image.store');

Route::middleware(['auth:api'])->group(function () {
    Route::post('store', [ProductController::class, 'store']);
    Route::get('index', [ProductController::class, 'index']);
    Route::get('show', [ProductController::class, 'show']);

    Route::post('logout', [AuthController::class, 'logout']);
});
