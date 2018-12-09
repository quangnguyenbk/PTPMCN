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


Route::group(['prefix'=>'shipper'], function(){
    Route::get('list', 'ShipperController@getList');
    Route::get('done/{id}', 'ShipperController@getDone');
});

Route::group(['prefix'=>'admin'], function(){

Route::get('admin/login', 'UserController@getLoginAdmin');
Route::post('admin/login', 'UserController@postLoginAdmin');

Route::get('admin/logout', 'UserController@getLogout');
Route::get('customer/main', function(){
    return view('customer.main');
});

Route::group(['prefix'=>'admin', 'middleware'=>'adminLogin'], function(){
	Route::group(['prefix'=>'supplier'], function(){
		Route::get('list', 'SupplierController@getList');
		Route::get('add', 'SupplierController@getAdd');
		Route::post('add','SupplierController@postAdd' );

		Route::get('update/{id}', 'SupplierController@getUpdate');
		Route::post('update/{id}', 'SupplierController@postUpdate');

		Route::get('delete/{id}', 'SupplierController@getDelete');
	
	});

    Route::group(['prefix'=>'laptop'], function(){
        Route::get('list', 'LaptopController@getList');
        Route::get('add', 'LaptopController@getAdd');
        Route::get('update/{id}', 'LaptopController@getUpdate');
        Route::get('delete/{id}','LaptopController@delete');
        
        Route::post('add','LaptopController@postAdd' );
        Route::post('update/{id}','LaptopController@postUpdate' );
        Route::get('change/{id}', 'LaptopController@getChange');
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