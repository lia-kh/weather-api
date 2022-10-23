<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HistoryRequest;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class HistoryController extends Controller
{
    /**
     * Return all cities
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Auth::user()->cities);
    }

    /**
     * Add one city in History
     * @param HistoryRequest $request
     * @return JsonResponse
     */
    public function add(HistoryRequest $request)
    {
        $city = City::firstWhere('name', $request->input('name'));
        if (Auth::user()->cities()->count() < 10) {
            Auth::user()->cities()->sync($city, false);
            return response()->json([
                'status_code' => 200,
                'message' => 'City added successfully!'
            ]);
        }else{
            return response()->json([
                'status_code' => 400,
                'message' => 'History is full!'
            ], 400);
        }

    }

    /**
     * Delete one city from History
     * @param HistoryRequest $request
     * @return void
     */
    public function delete(HistoryRequest $request)
    {
        $city = City::firstWhere('name', $request->input('name'));
        Auth::user()->cities()->detach($city);
    }
}
