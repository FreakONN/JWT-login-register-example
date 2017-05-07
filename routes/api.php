<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is phere you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//middleware za provjeru autorizacije
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
*/

Route::get('/user', function (Request $request) {
    //return $request->user();
    return ['name' => 'frantz'];
})->middleware('jwt.auth');

//login 
Route::post('/authenticate', [
	'uses' => 'ApiAuthController@authenticate'
	]);

//register 
Route::post('/register', [
	'uses' => 'ApiAuthController@register'
	]);