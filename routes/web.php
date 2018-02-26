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

use App\Lib\MyFormatter;

Route::get('/phpinfo', function(){
    phpinfo();
});

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin'
], function(){
    Route::get('login', 'AdminLogin@index');
    Route::post('login', 'AdminLogin@login');
    Route::get('logout', 'AdminLogin@logout');

    Route::group([
        'middleware'=>'adminLogin'
    ], function(){
        Route::get('/', 'AdminController@index');

        Route::resource('user', 'UserController');
        Route::resource('store', 'StoreController');
        Route::resource('order', 'OrderController');
        Route::resource('car_patt', 'Car_pattController');
        Route::resource('car_model', 'Car_modelController');
        Route::resource('car_com', 'Car_comController');
        Route::resource('car', 'CarController');
        Route::resource('price', 'PriceController');
        Route::resource('price_float', 'Price_floatController');
        Route::resource('transmission', 'TransmissionController');
        Route::resource('additional_service', 'Additional_serviceController');
        Route::get('carPoint', 'CarPointController@index');

        //添加门店管理员
        Route::post('admin', 'AdminController@store');

        Route::resource('img', 'ImgController');
        Route::get('vue/img', 'ImgController@vueIndex');
        Route::post('vue/img', 'ImgController@upload');

        //page linke
        Route::get('edit_passwd', 'UserController@edit');
        Route::post('edit_passwd', 'UserController@edit_passwd');
        Route::get('user/addStore/{id}', 'UserController@addStore');
        Route::post('user/addStore', 'UserController@postAddStore');
        Route::get('warehouse', 'Warehouse@index');
        //ajax
        Route::post('store_status', 'StoreController@status');
        Route::get('getCarByStore', 'CarController@getCarByStore');
        Route::post('dispath', 'OrderController@dispath');
        Route::get('orderPickupInfo', 'OrderController@orderPickupInfo');
        Route::post('pickupCar', 'OrderController@pickupCar');
        Route::post('returnCar', 'OrderController@returnCar');
        Route::post('orderDesc', 'OrderController@orderDesc');
        Route::get('orderInfo', 'OrderController@orderInfo');
        Route::get('orderLog', 'OrderController@getLog');

        Route::post('user/status/{status}', 'UserController@status');
        //orderindex
        Route::get('storeByCityCode', 'StoreController@storeByCityCode');
        Route::get('car_pattSearchByCom', 'Car_pattController@searchByCom');
        Route::get('searchReturnStore', 'StoreController@searchReturnStore');
        //库存
        Route::get('warehouse_search', 'Warehouse@search');

        //新增订单
        Route::post('createOrder', 'OrderController@store');
        //修改订单信息
        Route::post('editOrder', 'OrderController@update');

        Route::post('cancelOrder', 'OrderController@cancel');
    });
});


//adminend
Route::get('test2', function(){
    $str = encrypt('123456');
    echo $str;
});

Route::get('test', function(){
    $start_time = '2018-01-18 14:00:00';
    $end_time = '2018-01-24 17:00:00';

    $info = new \App\Lib\PriceInfo(1, 1, $start_time, $end_time, 1);
    dd($info->getDiff()->day, $info->getDiff()->h);
    die();
});

Route::post('upload', 'UploadController@index');
Route::delete('upload', 'UploadController@removeUpload');

Route::get('code', 'Admin\CodeController@index');
Route::post('code', 'Admin\CodeController@gettable');
Route::put('code', 'Admin\CodeController@settable');
