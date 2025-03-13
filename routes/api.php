<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RayonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('hello', function () {
//     return 'Hello World';
// });

Route::apiResource('produits',ProduitController::class);
Route::apiResource('rayons',RayonController::class);
Route::apiResource('categories',CategoryController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');