<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ROLECONTROLLER;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\FacbookController;
use App\Http\Controllers\TestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::post("/user/login","LoginController@login")->middleware("throttle:5,1");

Route::group([ 'middleware' => ['auth','admin']],function(){
	Route::get('/productshow', function(){
         return view('productshow');
	});
   Route::get('/admin', 'Admin@index')->name('admin');

    Route::get('/categoryshow', 'CategoryController@show')->name('categoryshow');
    Route::get('/category',[CategoryController::class,'index'])->name('addcategory');
    Route::POST('/category',[CategoryController::class,'create']);
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit');
    Route::put('/edit/{id}',[CategoryController::class,'update'])->name('update');
    Route::get('/delete/{id}',[CategoryController::class,'destroy'])->name('destroy');

    Route::get('/productshow', 'ProductController@show')->name('productshow');
    Route::get('/create',function(){
        return view('create');
    });
     Route::get('/product',[ProductController::class,'index'])->name('addproduct');
     Route::POST('/product',[ProductController::class,'store']);
     Route::get('/editproduct/{id}',[ProductController::class,'edit'])->name('editproduct');
     Route::put('/editproduct/{id}',[ProductController::class,'update'])->name('update');
     Route::get('/deleteproduct/{id}',[ProductController::class,'destroy'])->name('destroy');

    Route::get('/roleshow', 'ROLECONTROLLER@show')->name('roleshow');
   Route::get('/addrole', 'ROLECONTROLLER@index');
   Route::post('/addrole', 'ROLECONTROLLER@create')->name('addrole');
   Route::get('/editrole/{id}', 'ROLECONTROLLER@edit')->name('editrole');
   Route::put('/editrole/{id}','ROLECONTROLLER@update')->name('updaterole');
   Route::get('/deleterole/{id}','ROLECONTROLLER@destroy')->name('destroy');

   Route::get('/userlist', 'ROLECONTROLLER@user_list')->name('userlist');
  Route::get('/edituserlist/{id}', 'ROLECONTROLLER@edit_user_list')->name('edituserlist');
   Route::put('/edituserlist/{id}', 'ROLECONTROLLER@update_user_list')->name('updateuserlist');
    Route::get('/deleteuser/{id}', 'ROLECONTROLLER@destroy_user')->name('deleteuser');

     
});
Route::get('event','UserAuth@index');
Route::get('changepassword', 'ChangePasswordController@index');
Route::post('changepassword', 'ChangePasswordController@store')->name('change.password');
   Route::get('change-password', 'API\UserController@change_password');  
// Route::get('/productshow', 'ProductController@show')->name('productshow')->Middleware(AdminMiddleware::class);

// Route::get('facebook', function () {
//     return view('facebook');
// });

// Route::get('auth/facebook', 'FacebookController@redirectToFacebook');
// Route::get('auth/facebook/callback', 'FacebookController@handleFacebookCallback'); 


Route::get('facebook','FacebookController@redirectToFacebook');
Route::get('facebook/callback','FacebookController@handleFacebookCallback');

Route::get('test', 'TestController@index');