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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/testing/{mytest}', 'API\TestingController@index');

Route::group(['middleware' => 'auth:api'], function(){
 
Route::get('user', 'API\UserController@user');
Route::post('uploadImage', 'API\UserController@uploadImage');
Route::post('change-password', 'API\UserController@change_password');
Route::post('profile_image', 'API\UserController@profile_image');
Route::get('auth/facebook', 'API\FacebookController@redirectToFacebook');
Route::get('social/auth/facebook', 'API\FacebookController@callback');

// Route::post('editproduct','API\Products@update');
});

// Route::get('list','Users@list');

 Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('forgot', 'API\UserController@forgot_password');
Route::post('reset', 'API\UserController@reset');

Route::get('user/{id}', 'API\UserController@showbyid');

Route::post('donor', 'API\DonorController@save');
Route::get('donor', 'API\DonorController@index');
Route::get('donor/{id}','API\DonorController@showbyid');
Route::post('donor/{id}', 'API\DonorController@update');
Route::delete('donor/{id}', 'API\DonorController@deletebyid');

Route::post('product', 'API\Products@save');
Route::get('product','API\Products@index');
Route::get('product/{id}','API\Products@showbyid');
Route::put('product/{id}','API\Products@update');
Route::delete('product/{id}','API\Products@deletebyid');

Route::post('article', 'API\ArticleController@save');
Route::get('article', 'API\ArticleController@index');

