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

// TODO: Add new route
Route::post('/login' , [adminController::class , 'login']);
Route::post('/register' , [adminController::class , 'register']);
Route::get('/products' , [adminController::class , 'getProducts']);
Route::post('/activateProduct' , [adminController::class , 'activateProduct']);

Route::post('/wishlist/{id}/{user_id}' , [adminController::class , 'addNewWishlist']);


Route::get('/userproducts' , [userController::class , 'getActiveProducts']);
Route::get('/deleteproduct/{id}' , [userController::class , 'deleteProduct']);


Route::group(['middleware' => ['auth:sanctum']] , function (){
    Route::get('/products' , [adminController::class , 'getProducts']);
    Route::get('/products/{id}' , [adminController::class , 'getUserProducts']);
    Route::post('/logout' , [adminController::class , 'logout']);
    Route::get('/wishlist/{id}' , [adminController::class , 'getWishlist']);
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//
//});



