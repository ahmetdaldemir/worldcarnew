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



Route::get('locations', 'Api\ApiController@locations');
Route::get('version', 'Api\ApiController@version');
Route::get('deals', 'Api\ApiController@deals');
Route::get('history', 'Api\ApiController@history');
Route::get('notifications', 'Api\ApiController@notifications');
Route::get('getsupplierocation', 'Api\ApiController@getsupplierocation');
Route::get('datas', 'Api\ApiController@datas'); //  Ekstralar
Route::get('cars', 'Api\ApiController@cars'); //  Araçlar
Route::get('languages', 'Api\ApiController@languages'); //  Diller
Route::post('login', 'Api\LoginController@customerLogin'); //  Diller


Route::get('feedbacksave', 'Api\FeedBackController@store');
Route::get('feedbackget', 'Api\FeedBackController@index');


Route::get('search', 'Api\SearchController@index');



//Supplier

Route::post('supplier-login', 'Api\SupplierController@login');
Route::group(['prefix' => '/supplier','middleware' => ['cors']], function () {
    Route::get('reservations', 'Api\ReservationController@index');
    Route::get('datas', 'Api\ReservationController@datas');
    Route::get('getDropLocation', 'Api\ReservationController@getDropLocation');
    Route::post('getCars', 'Api\ReservationController@getCars');
    Route::get('getCustomer', 'Api\ReservationController@getCustomer');
});



Route::post('person-login', 'Api\LoginController@login')->name('person-login');
Route::get('plates', 'Api\ApiController@plates')->middleware('auth:sanctum');;
Route::get('citys', 'Api\ApiController@citys')->middleware('auth:sanctum');;
Route::post('operation', 'Api\OperationController@index')->middleware('auth:sanctum');;
Route::post('operationSave', 'Api\OperationController@save')->middleware('auth:sanctum');;


