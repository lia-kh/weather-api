<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowWeatherRequest;
use App\Models\City;
use App\Models\Temperature;
use App\Repositories\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RakibDevs\Weather\Weather;


class TemperatureController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $city;
    public function __construct(City $city)
    {
        $this->city = new Repository($city);
    }

    /**
     * @param ShowWeatherRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
   public function showWeather(ShowWeatherRequest $request):JsonResponse
   {
       $weather = $request->whenHas('name', function ($input) use ($request) {
           $wt=new Weather();
           return $wt->getCurrentByCity($request->input('name'));
       }, function () use ($request) {
           $wt=new Weather();
           return $wt->getCurrentByCord($request->input('lat'), $request->input('lon'));
       });
       return response()->json($weather);

   }
}
