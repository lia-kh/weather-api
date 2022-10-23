<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Show7DaysWeatherController;
use App\Http\Requests\ShowWeatherRequest;
use App\Models\City;
use App\Models\Information;
use App\Models\User;
use App\Repositories\Repository;
use Carbon\Traits\Date;
use DateTime;
use DateTimeZone;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RakibDevs\Weather\Weather;
use RakibDevs\Weather\WeatherClient;


class WeatherController extends Controller
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
    public function showWeather(ShowWeatherRequest $request): JsonResponse
    {
        $city = $request->has('name')
            ? City::where('name', $request->input('name'))->firstOrFail()
            : City::where('lat', $request->input('lat'))->where('lon', $request->input('lon'))->firstOrFail();

        $information = $city->informations()->where('date', now()->format('Y-m-d'))->first();

        if (!$information) {
            $wt = new Weather();
            $dat = $wt->getCurrentByCity($city->name);

            $information = Information::create([
                'date' => date('Y-m-d', strtotime($dat->dt) - $dat->timezone),
                'temp' => $dat->weather,
                'city_id' => $city->id,
            ]);
        }

        return response()->json($information);
    }

    /**
     * @param ShowWeatherRequest $request
     * @return JsonResponse
     */
    public function showFiveDaysWeather(ShowWeatherRequest $request): JsonResponse
    {
        $city = $request->has('name')
            ? City::where('name', $request->input('name'))->firstOrFail()
            : City::where('lat', $request->input('lat'))->where('lon', $request->input('lon'))->firstOrFail();

        $informations = $city->informations()->whereBetween(
            'date',
            [now()->addDays(1)->format('Y-m-d'), now()->addDays(6)->format('Y-m-d')])
            ->get();

        if ($informations->count() != 5) {
            $wt = new Weather();
            $weather = $wt->get3HourlyByCity($city->name);

            $list = $weather->list;
            $remapped = [];
            foreach ($list as $dat) {
                $dat->dt = date('Y-m-d', strtotime($dat->dt) - $weather->city->timezone);
                $remapped[$dat->dt] = $dat;
            }
            $informations = [];
            foreach ($remapped as $city_weather) {
                $informations[] = Information::firstOrCreate([
                    'date' => $city_weather->dt
                ], [
                    'temp' => $city_weather->weather,
                    'city_id' => $city->id
                ]);
            }
        }

        return response()->json($informations);
    }
}
