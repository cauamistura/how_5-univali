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
    Route::get('product/user', [ProductController::class, 'getProductsByUser']);
    Route::get('product/{id}', [ProductController::class, 'show']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::post('product/', [ProductController::class, 'create']);
    Route::get('product/', [ProductController::class, 'index']);  
    Route::delete('product/{id}', [ProductController::class, 'delete']); 
});

Route::get('users', [AuthController::class, 'allUsers']);