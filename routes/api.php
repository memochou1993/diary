<?php

use App\Http\Controllers\PublicResourceController;
use App\Http\Controllers\Auth\PredicateController;
use App\Http\Controllers\Auth\ResourceController;
use App\Http\Controllers\Auth\StatementController;
use App\Http\Controllers\Auth\TokenController;
use Illuminate\Support\Facades\Route;

Route::post('/tokens', [TokenController::class, 'store']);

Route::apiResource('resources', PublicResourceController::class)
    ->only('index', 'show');

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::apiResource('users.resources', ResourceController::class)
        ->only('index');
});

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
