<?php

use App\Http\Controllers\ResourceController;
use App\Http\Controllers\User\PredicateController as UserPredicateController;
use App\Http\Controllers\User\ResourceController as UserResourceController;
use App\Http\Controllers\User\StatementController as UserStatementController;
use App\Http\Controllers\User\TokenController as UserTokenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/tokens', [UserTokenController::class, 'store']);
Route::delete('/tokens', [UserTokenController::class, 'destroy'])->middleware('auth:sanctum');

Route::apiResource('resources', ResourceController::class)
    ->only('index', 'show');

Route::middleware([
    'auth:sanctum',
])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'show']);
    Route::apiResource('resources', UserResourceController::class)
        ->shallow();
    Route::apiResource('predicates', UserPredicateController::class)
        ->shallow();
    Route::apiResource('statements', UserStatementController::class)
        ->shallow();
});
