<?php

use App\Http\Controllers\StatementController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::post('/tokens', [TokenController::class, 'store']);

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::delete('/tokens', [TokenController::class, 'destroy']);

    Route::apiResource('users.statements', StatementController::class)
        ->shallow();
});
