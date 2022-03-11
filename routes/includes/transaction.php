<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/transactions/{uuid}', [TransactionController::class, 'show']);
    Route::post('/transactions', [TransactionController::class, 'store']);
});
