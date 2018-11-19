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
		Route::post('add','SupplierController@postAdd' );

		Route::get('update/{id}', 'SupplierController@getUpdate');
		Route::post('update/{id}', 'SupplierController@postUpdate');

		Route::get('delete/{id}', 'SupplierController@getDelete');
		
	});
    Route::group(['prefix'=>'purchaseorders'], function(){
        Route::get('list','PurchaseOrderController@getList');
        Route::get('add', 'PurchaseOrderController@getAdd');
        Route::get('update', 'PurchaseOrderController@getUpdate');
        Route::post('add','PurchaseOrderController@postAdd' );
    });
    Route::group(['prefix'=>'purchaseorderitem'], function(){
        Route::get('detail/{id}','PurchaseOrderItemController@getItems');
    });
});