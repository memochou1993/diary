<?php

use App\Http\Controllers\StatementController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users.statements', StatementController::class)
    ->shallow();
