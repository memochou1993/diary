<?php

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::post('/tokens', [TokenController::class, 'store']);

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::delete('/tokens', [TokenController::class, 'destroy']);

    Route::apiResource('resources', ResourceController::class)
        ->shallow();
    Route::apiResource('statements', StatementController::class)
        ->shallow();
});
