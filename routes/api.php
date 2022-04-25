<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'AuthController@login');

Route::get('/product', 'ProductController@index');
Route::get('/product/group-by', 'ProductController@groupBy');
Route::get('/product/{id}', 'ProductController@show');

Route::get('/category', 'CategoryController@index');
Route::get('/category/{id}', 'CategoryController@show');

Route::get('/product-detail', 'ProductDetailController@index');
Route::get('/product-detail/{id}', 'ProductDetailController@show');

Route::group(['middleware' => ['auth:api']], function(){
    
    Route::post('/logout', 'AuthController@logout');

    Route::post('/product/store', 'ProductController@store');
    Route::post('/product/{id}/update', 'ProductController@update');
    Route::post('/product/{id}/delete', 'ProductController@destroy');
    
    Route::post('/product-detail/store', 'ProductDetailController@store');
    Route::post('/product-detail/{id}/update', 'ProductDetailController@update');
    Route::post('/product-detail/{id}/delete', 'ProductDetailController@destroy');
    
    Route::post('/category/store', 'CategoryController@store');
    Route::post('/category/{id}/update', 'CategoryController@update');
    Route::post('/category/{id}/delete', 'CategoryController@destroy');
});

