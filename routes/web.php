<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsUserExist;
use App\Http\Controllers\ApiController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', function () {
    return csrf_token();
});


#Product
Route::post('/api/store', [ProductController::class,'store']);//send token from header
Route::post('/api/createProduct', [ProductController::class,'createProduct']);//send token from header
Route::get('/api/getAllProduct', [ProductController::class,'getAllProduct']);
Route::get('/api/getAllProduct', [ProductController::class,'getAllProduct']);
Route::get('/api/getProductById/{id}', [ProductController::class, 'getProductById']);
Route::get('/api/getProductById', [ProductController::class, 'getProductById']);
Route::put('/api/update/{id}', [ProductController::class, 'update']);//send token from header
Route::delete('/api/delete/{id}', [ProductController::class, 'destroy']);//send token from header



#Category
Route::get('/getCategoryWithProduct/{id}', [CategoryController::class, 'getCategoryWithProduct']);



#User 
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->middleware(IsUserExist::class);
Route::get('/getUsers', [UserController::class, 'getUsers'])->middleware('auth:sanctum');
Route::post('/logout', [UserController::class, 'logout']);


Route::get('/api/csrf-token', [ProductController::class, 'getCsrfToken']);


 