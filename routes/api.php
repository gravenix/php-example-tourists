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

Route::get('user', function (Request $request) {
    return $request->user();
});

//tourists api
//users
Route::get('users', 'AdminController@users')->name('api.users');
Route::post('user', 'AdminController@adduser')->name('api.adduser');
Route::delete('user', 'AdminController@deluser')->name('api.deluser');
Route::post('user/{id}', 'AdminController@updateUser')->where('id', '[0-9]+')->name('api.updateuser');
Route::get('user/getflights/{id?}', 'FlightController@getFlights')->where([
    'id' => '[0-9]*',
])->name('api.getflightusers');

//flights
Route::get('flights', 'FlightController@flights')->name('api.flights');
Route::post('flight/{id}', 'FlightController@updateFlight')->where('id', '[0-9]+')->name('api.updateflight');
Route::post('flight', 'FlightController@addFlight')->name('api.addflight');
Route::delete('flight', 'FlightController@delFlight')->name('api.delflight');
Route::get('flight/getusers/{id}', 'FlightController@getUsers')->where([
    'id' => '[0-9]+',
])->name('api.getuserflights');

//relations
Route::post('toflight/{flight_id}/{user_id?}', 'FlightUserController@addRelation')->where([
    'flight_id' => '[0-9]+',
    'user_id' => '[0-9]*',
])->name('api.addtoflight');
Route::post('delfromflight/{flight_id}/{user_id?}', 'FlightUserController@delRelation')->where([
    'flight_id' => '[0-9]+',
    'user_id' => '[0-9]*',
])->name('api.delfromflight');