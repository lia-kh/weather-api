<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowWeatherRequest;
use App\Models\Temperature;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    /**
     * @param ShowWeatherRequest $request
     * @return void
     */
   public function showWeather(ShowWeatherRequest $request)
   {
       

   }
}
