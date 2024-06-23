<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\API\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MessageController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/apartments/search', [ApartmentController::class, 'searchApartments']);
Route::get('/apartments/{apartment:slug}', [ApartmentController::class, 'show']);
Route::post('/messages', [MessageController::class, 'store']);