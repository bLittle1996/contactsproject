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

Route::group(['prefix' => 'contacts', 'middleware' => 'auth:api', 'namespace' => 'API'], function () {
	Route::get('/',		'ContactController@index'); //index for all
	Route::get('/{contact}',	'ContactController@show'); //show for one
	Route::post('/',	'ContactController@store'); //store to store!
	Route::patch('/{contact}',	'ContactController@update'); //patch to update some things
	Route::put('/{contact}', 	'ContactController@update'); //put to update all thing!
	Route::delete('/{contact}',	'ContactController@destroy'); //destroy to delete!
});
