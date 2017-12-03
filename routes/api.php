<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['middleware'=>['api']], function(){

    Route::post('/auth/signup','AuthController@signup');
    Route::post('/auth/signin','AuthController@signin');


    Route::group(['middleware'=>['jwt.auth']], function(){

        Route::get('/profile','UserController@show');

//        todolist

//        lihat semua list
        Route::get('/todolistitems','ToDoListController@index');
//        lihat spesific list
        Route::get('/todolistitems/{id}','ToDoListController@show');
//        tambah list
        Route::post('/todolistitem','ToDoListController@create');

//        edit list
        Route::put('/todolistitems/{id}','ToDoListController@update');

        //        delete list
        Route::delete('/todolistitems/{id}','ToDoListController@destroy');

    });

});