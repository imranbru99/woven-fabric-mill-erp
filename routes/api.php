<?php

use App\Http\Controllers\Api\MillApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (): void {
    Route::post('/floor/production', [MillApiController::class, 'production']);
    Route::post('/floor/stoppage', [MillApiController::class, 'stoppage']);
    Route::post('/gate/scan', [MillApiController::class, 'gate']);
    Route::post('/warehouse/receive', [MillApiController::class, 'receive']);
    Route::get('/buyer/orders', [MillApiController::class, 'buyerOrders']);
    Route::post('/loom-monitor/import', [MillApiController::class, 'loomMonitor']);
});
