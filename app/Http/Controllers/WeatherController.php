<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherAPIService;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherAPIService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function show(Request $request)
    {
        $city = $request->input('city', null);
        $days = $request->input('days', 3);
        $weather = null;

        if ($city) {
            $weather = $this->weatherService->getWeatherForecast($city, $days);
        }

        $defaultCities = ['Rome', 'Milan', 'Naples', 'Turin', 'Palermo'];

        return view('weather.show', compact('weather', 'defaultCities', 'days'));
    }
}
