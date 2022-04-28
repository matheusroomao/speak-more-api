<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('codes', App\Http\Controllers\Api\CodeController::class)->names('code');
Route::apiResource('plans', App\Http\Controllers\Api\PlanController::class)->names('plan');

Route::post('calculate', [App\Http\Controllers\Api\CalculateController::class, 'calculate'])->name('calculate');
