<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsUserExist;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', function () {
    return csrf_token();
});


#Product
Route::post('/store', [ProductController::class,'store']);//send token from header
Route::post('/createProduct', [ProductController::class,'createProduct']);//send token from header
Route::get('/GetProductById', [ProductController::class,'getProductById']);
Route::get('/GetProductById/{id}', [ProductController::class, 'getProductById']);
Route::put('/update/{id}', [ProductController::class, 'update']);//send token from header
Route::delete('/delete/{id}', [ProductController::class, 'destroy']);//send token from header



#Category
Route::get('/getCategoryWithProduct/{id}', [CategoryController::class, 'getCategoryWithProduct']);



#User 
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->middleware(IsUserExist::class);
Route::get('/getUsers', [UserController::class, 'getUsers'])->middleware('auth:sanctum');
Route::post('/logout', [UserController::class, 'logout']);




 