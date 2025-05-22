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

        $countries = [
            'New York' => 'United States of America',
            'Tokyo' => 'Japan',
            $city => ($city === 'London' ? 'United Kingdom' : $city)
        ];
        $countryData = [];

        foreach ($countries as $cityName => $countryName) {
            $response = Http::get('https://restcountries.com/v3.1/name/' . urlencode($countryName));
            if ($response->successful() && !empty($response->json())) {
                $data = $response->json()[0];
                $countryData[$cityName] = [
                    'country' => $data['name']['common'],
                    'capital' => isset($data['capital']) ? $data['capital'][0] : 'N/A',
                    'population' => $data['population'] ?? 'N/A',
                    'flag' => $data['flags']['png'] ?? null,
                ];
            } else {
                $countryData[$cityName] = null;
            }
        }
        return view('weather', compact('weatherData', 'countryData'));
    }
}
