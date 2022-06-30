<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Client\ClientOrderController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {

    Route::post('set/transfer/currency', [ClientOrderController::class, 'setTransferCurrency']);
});
