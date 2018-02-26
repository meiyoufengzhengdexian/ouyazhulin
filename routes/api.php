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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware'=>[],
    'prefix'=>'Tuniu',
    'namespace'=>'Api\Tuniu'
], function(){\
    Route::any('City', 'City@getCity');
    Route::any('Store', 'Store@getStore');
    Route::any('CarPatt', 'CarPatt@getCarPatt');
    Route::any('Search', 'Search@search');
    Route::any('Product', 'Product@getProduct');
    Route::any('PreBooking', 'PreBooking@preBooking');
    Route::any('Booking', 'Booking@booking');
    Route::any('PreCancel', 'PreCancel@preCancel');
    Route::any('Cancel', 'Cancel@cancel');
    Route::any('GetOrderStatus', 'getOrderStatus@getOrderStatus');
});