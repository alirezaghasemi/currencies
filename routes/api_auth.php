<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;


Route::prefix('v1')->group(function () {
    Route::post('get/verify/code', [AuthController::class, 'getVerifyCode']);
    Route::post('get/token', [AuthController::class, 'getToken']);
});


