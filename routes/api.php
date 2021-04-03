<?php

use App\Http\Controllers\PublicResourceController;
use App\Http\Controllers\User\PredicateController;
use App\Http\Controllers\User\ResourceController;
use App\Http\Controllers\User\StatementController;
use App\Http\Controllers\User\TokenController;
use Illuminate\Support\Facades\Route;

Route::post('/tokens', [TokenController::class, 'store']);

Route::apiResource('resources', PublicResourceController::class)
    ->only('index', 'show');

Route::middleware([
    'auth:sanctum',
])->prefix('user')->group(function () {
    Route::delete('/tokens', [TokenController::class, 'destroy']);

    Route::apiResource('resources', ResourceController::class)
        ->shallow();
    Route::apiResource('predicates', PredicateController::class)
        ->shallow();
    Route::apiResource('statements', StatementController::class)
        ->shallow();
});
