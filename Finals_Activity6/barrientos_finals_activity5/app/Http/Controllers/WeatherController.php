<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request, $city = 'London')
    {
        $cities = ['Tokyo', 'New York', $city];
        $apiKey = env('OPENWEATHER_API_KEY');
        $weatherData = [];

        foreach ($cities as $cityName) {
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $cityName,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                $weatherData[$cityName] = [
                    'temperature' => $response->json()['main']['temp'],
                    'description' => $response->json()['weather'][0]['description'],
                    'humidity' => $response->json()['main']['humidity'],
                ];
            } else {
                $weatherData[$cityName] = null;
            }
        }
        return view('weather', compact('weatherData'));
    }
}
