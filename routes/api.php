<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\userController;

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
Route::post('/login' , [adminController::class , 'login']);
Route::post('/register' , [adminController::class , 'register']);
Route::get('/products' , [adminController::class , 'getProducts']);
Route::post('/activateProduct' , [adminController::class , 'activateProduct']);



Route::get('/userproducts' , [userController::class , 'getActiveProducts']);
Route::get('/deleteproduct/{id}' , [userController::class , 'deleteProduct']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
