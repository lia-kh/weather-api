<?php

use App\Http\Controllers\Api\V1\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TemperatureController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//api/v1

Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controller\Api\v1'],function (){
//    Route::apiResource('get-weather',CityController::class);
    Route::post('get-weather',[TemperatureController::class,'showWeather']);
});
