<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    // Rotas para autenticação
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::put('user/update/{id}', [AuthController::class, 'update']);

    // Rotas para produtos
    Route::get('products/user', [ProductController::class, 'getProductsByUser']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'delete']);
    Route::post('products/', [ProductController::class, 'create']);
    Route::get('products/', [ProductController::class, 'index']);
});

Route::get('users', [AuthController::class, 'allUsers']);