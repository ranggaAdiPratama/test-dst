<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{uuid}', [ProductController::class, 'show']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::post('/products/{uuid}', [ProductController::class, 'update']);
    Route::delete('/products/{uuid}', [ProductController::class, 'delete']);
});
