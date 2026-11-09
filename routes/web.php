<?php

use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VisitorController::class, 'index']);

Route::resource('visitors', VisitorController::class);
