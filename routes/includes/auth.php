<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/logout', [PassportAuthController::class, 'logout']);
});

Route::post('/login', [PassportAuthController::class, 'login']);
