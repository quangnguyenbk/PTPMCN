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
    Route::group(['prefix'=>'purchaseorder'], function(){
        Route::get('list','PurchaseOrderController@getList');
        Route::get('add', 'SupplierController@getAdd');
        Route::get('update', 'SupplierController@getUpdate');
        Route::post('add','SupplierController@postAdd' );
    });
    Route::group(['prefix'=>'purchaseorderitem'], function(){
        Route::get('detail/{id}','PurchaseOrderItemController@getItems');
    });
    Route::group(['prefix'=>'sales_order'], function(){
        Route::get('list', 'SalesOrderController@getList');
        Route::get('detail/{id}', 'SalesOrderController@getDetail');
        Route::get('add', 'SalesOrderController@getAdd');
        Route::get('edit_detail_order/{id}', 'SalesOrderController@getEditDetailOrder');

        Route::post('add','SalesOrderController@postAdd' );
        Route::post('edit_detail_order/{id}', 'SalesOrderController@postEditDetailOrder');
    });

});
Route::get('/clear-cache', function() {
    return Artisan::call('cache:clear');
});