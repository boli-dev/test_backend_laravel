<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TestController;

Route::get('/test', [TestController::class, 'index']);

Route::get('/dates', [TestController::class, 'dates']);
Route::get('/weekends', [TestController::class, 'weekends']);
Route::get('/clearList', [TestController::class, 'clearList']);
Route::get('/valuesAssigned', [TestController::class, 'valuesAssigned']);
Route::get('/checkAboveOrBelow1P', [TestController::class, 'checkAboveOrBelow1P']);
Route::get('/result', [TestController::class, 'finalTouch']);
