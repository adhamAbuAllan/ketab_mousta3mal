<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/book/add',[BookController::class,'add']);
Route::post('/photo/add',[PhotoController::class,'addImages']);
Route::post('/category/add',[CategoryController::class,'add']);
Route::get('/book/all',[BookController::class,'all']);
Route::post('/book/one',[BookController::class,'one']);

