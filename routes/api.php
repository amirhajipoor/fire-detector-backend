<?php

use App\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Route;

// Protected Routes
Route::prefix('/reports')->controller(ReportController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index')->name('reports.index');
    Route::post('/', 'store')->name('reports.store')->middleware('throttle:1,1');
});
