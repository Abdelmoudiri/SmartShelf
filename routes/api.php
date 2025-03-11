<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);


Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum','restrictRole:admin']], function(){
    Route::apiResource('categories',CategoryController::class);
    Route::apiResource('rayons', RayonController::class);
    Route::apiResource('clients',UserController::class);

    Route::post('/products',[ProductController::class,'store']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::patch('/products/{id}',[ProductController::class,'update']);
    
    Route::patch('/clients/{id}/suspend',[UserController::class,'suspend']);
    Route::patch('/clients/{id}/activate',[UserController::class,'activate']);
});

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/products',[ProductController::class,'index']);
    Route::get('/products/{id}',[ProductController::class,'show']);
    Route::get('/popular/products',[ProductController::class,'popular']);
    Route::get('/promoted/products',[ProductController::class,'promoted']);
    Route::post('/search/products',[ProductController::class,'search']);
    
    Route::get('/orders',[OrderController::class,'index']);
});

Route::group(['middleware' => ['auth:sanctum','restrictRole:custumor']], function(){
    Route::post('/orders',[OrderController::class,'store']);
});