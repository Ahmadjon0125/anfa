<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);
Route::post('/lead', [LeadController::class, 'store']);


