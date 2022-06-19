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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

/////////////////////AUTHENTICATION//////////////////////////////////////
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    ////////////////////TEST/////////////////////////////////////////////
    Route::get('test','UserController@test');
    
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');       
    });
});
////////////////////TEST/////////////////////////////////////////////
Route::post('test','UserController@test');
Route::get('testOla','CategoryController@test');

/////////////////////USERS////////////////////////////////////////////
Route::get('users','UserController@index');
Route::get('user/{id}','UserController@getUserById');
Route::delete('user/{id}','UserController@delete');
Route::patch('user/{id}','UserController@update');
Route::patch('withoutpass/user/{id}','UserController@updateWithoutPass');

/////////////////////CATEGORIES//////////////////////////////////////
Route::get('categories','CategoryController@index');
Route::get('category/{id}','CategoryController@getCategoryById');
Route::post('category','CategoryController@store');
Route::delete('category/{id}','CategoryController@delete'); 
Route::patch('category/{id}','CategoryController@update'); 

/////////////////////PRODUCTS//////////////////////////////////////
Route::get('products','ProductController@index');
Route::get('products/{category_id}','ProductController@getProductsByCategoryId');
Route::get('product/{id}','ProductController@getProductById');
Route::post('product','ProductController@store');
Route::delete('product/{id}','ProductController@delete'); 
Route::patch('product/{id}','ProductController@update'); 

Route::post('email', 'EmailController@sendEmail');

