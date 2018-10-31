<?php

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

Route::group(['prefix'=>'admin'], function(){
	Route::group(['prefix'=>'supplier'], function(){
		Route::get('list', 'SupplierController@getList');
		Route::get('add', 'SupplierController@getAdd');
		Route::get('update', 'SupplierController@getUpdate');

		Route::post('add','SupplierController@postAdd' );
	});
});