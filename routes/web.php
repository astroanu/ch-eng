<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;

Route::get('/', [OrdersController::class, 'showTopProducts']);

Route::get('/update-stock/{merchantProductNumber}', [OrdersController::class, 'showUpdateStock']);
Route::post('/update-stock/{merchantProductNumber}', [OrdersController::class, 'updateStock']);
