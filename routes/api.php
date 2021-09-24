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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getPerspectivas/{id}','PerspectiveController@getPerspectivas')->name('getPerspectivas');
Route::get('getPerspectivasEmpresa/{id}','PerspectiveController@getPerspectivasEmpresa')->name('getPerspectivasEmpresa');
Route::get('getPerspectivasOrden/{id}/{id2}','PerspectiveController@getPerspectivasOrden')->name('getPerspectivasOrden');
Route::post('storePerspectiva','PerspectiveController@storePerspectiva')->name('storePerspectiva');



Route::get('getObjectives/{id}/{id2}/{id3}','ObjectiveController@getObjectives')->name('getObjectives');
Route::post('storeObjective','ObjectiveController@storeObjective')->name('storeObjective');
//Route::delete('deleteObjective','ObjectiveController@deleteObjective')->name('deleteObjective');
Route::get('getObjetivos/{id}/{id2}','ObjectiveController@getObjetivos')->name('getObjetivos');

//Historial routes

Route::get('getStrategicMaps/{id}/{id2}','historialStrategicMapController@index')->name('getStrategicMaps');
Route::post('storeStrategicMap','historialStrategicMapController@store')->name('storeStrategicMap');


Route::resource('frequencies', 'FrequencyAPIController');

Route::resource('indicators', 'IndicatorAPIController');


Route::resource('data_fuentes', 'dataFuenteAPIController');
