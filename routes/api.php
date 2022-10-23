<?php

use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\HistoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\WeatherController;

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

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controller\Api\v1'], function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/get-weather', [WeatherController::class, 'showWeather']);

    Route::get('/cities', [CityController::class, 'index']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('five-days', [WeatherController::class, 'showFiveDaysWeather']);
        Route::get('show-history', [HistoryController::class, 'index']);
        Route::post('add-history', [HistoryController::class, 'add']);
        Route::post('remove-history', [HistoryController::class, 'delete']);




    });
});



