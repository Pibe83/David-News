<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class WeatherAPIService
{
    protected $apiKey;

    protected $client;

    public function __construct()
    {
        $this->apiKey = config('services.weatherapi.key');
        $this->client = new Client(['base_uri' => 'https://api.weatherapi.com/v1/']);
    }

    public function getCurrentWeather($city)
    {
        $cacheKey = 'weather_' . $city;
        $cachedWeather = Cache::get($cacheKey);

        if ($cachedWeather) {
            return $cachedWeather;
        }

        $response = $this->client->get('current.json', [
            'query' => [
                'key' => $this->apiKey,
                'q' => $city,
            ],
        ]);

        $weatherData = json_decode($response->getBody()->getContents(), true);
        Cache::put($cacheKey, $weatherData, now()->addHours(1));

        return $weatherData;
    }

    public function getWeatherForecast($city, $days)
    {
        $cacheKey = 'weather_forecast_' . $city . '_' . $days;
        $cachedForecast = Cache::get($cacheKey);

        if ($cachedForecast) {
            return $cachedForecast;
        }

        $response = $this->client->get('forecast.json', [
            'query' => [
                'key' => $this->apiKey,
                'q' => $city,
                'days' => $days,
            ],
        ]);

        $forecastData = json_decode($response->getBody()->getContents(), true);
        Cache::put($cacheKey, $forecastData, now()->addHours(1));

        return $forecastData;
    }
}
