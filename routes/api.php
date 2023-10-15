<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [UserController::class, 'login']);
Route::middleware(['auth:api'])->group(function() {
    Route::get('users', [UserController::class, 'index']);
    Route::post('user/create', [UserController::class, 'create']);
    Route::post('user/edit', [UserController::class, 'edit']);
    Route::get('user/delete/{id}', [UserController::class, 'delete']);
});

Route::middleware(['auth:api'])->group(function() {
    Route::get('address', [AddressController::class, 'index']);
    Route::post('address/create', [AddressController::class, 'create']);
    Route::post('address/edit', [AddressController::class, 'edit']);
    Route::get('address/delete/{id}', [AddressController::class, 'delete']);
});