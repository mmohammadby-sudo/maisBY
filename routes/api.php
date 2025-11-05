<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Route::middleware('auth:sanctum')->delete('/api/delete/{id}', [ProductController::class, 'destroy']);//need token 

Route::middleware('auth:sanctum')->group(function () {
Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
Route::post('/store', [ProductController::class,'store']);
Route::get('/getAllProduct', [ProductController::class,'getAllProduct']);
Route::get('/getProductById/{id}', [ProductController::class, 'getProductById']);
Route::put('/update/{id}', [ProductController::class, 'update']);

});



Route::post('/token', [UserController::class,'token']);
   
