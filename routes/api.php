<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('article', [ProductController::class, 'index']);
Route::get('article/{id}/show', [ProductController::class, 'show']);
Route::post('product/add', [ProductController::class, 'store']);
Route::put('article/{id}/modifier', [ProductController::class, 'update']);
Route::delete('article/{id}/delete', [ProductController::class, 'destroy']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
