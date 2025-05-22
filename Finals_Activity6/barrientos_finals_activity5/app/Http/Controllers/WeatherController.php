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
        $countryData = [];

        foreach ($cities as $cityName) {
            $weatherResponse = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $cityName,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            if ($weatherResponse->successful()) {
                $weatherJson = $weatherResponse->json();
                $weatherData[$cityName] = [
                    'temperature' => $weatherJson['main']['temp'],
                    'description' => $weatherJson['weather'][0]['description'],
                    'humidity' => $weatherJson['main']['humidity'],
                ];

                $countryCode = $weatherJson['sys']['country'] ?? null;

                if ($countryCode) {
                    $countryResponse = Http::get('https://restcountries.com/v3.1/alpha/' . $countryCode);

                    if ($countryResponse->successful() && !empty($countryResponse->json())) {
                        $countryJson = $countryResponse->json()[0];
                        $countryData[$cityName] = [
                            'country' => $countryJson['name']['common'],
                            'capital' => isset($countryJson['capital']) ? $countryJson['capital'][0] : 'N/A',
                            'population' => $countryJson['population'] ?? 'N/A',
                            'flag' => $countryJson['flags']['png'] ?? null,
                        ];
                    } else {
                        $countryData[$cityName] = null;
                    }
                } else {
                    $countryData[$cityName] = null;
                }
            } else {
                $weatherData[$cityName] = null;
                $countryData[$cityName] = null;
            }
        }

        return view('weather', compact('weatherData', 'countryData'));
    }
}
