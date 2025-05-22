<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather & Country Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-6">Weather & Country Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($weatherData as $city => $weather)
                <div class="bg-gray p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-2">{{ $city }}</h2>
                    <h3 class="text-lg font-medium mt-4">Weather</h3>
                    @if ($weather)
                        <p class="text-lg">Temperature: {{ $weather['temperature'] }}°C</p>
                        <p class="text-lg">Description: {{ ucfirst($weather['description']) }}</p>
                        <p class="text-lg">Humidity: {{ $weather['humidity'] }}</p>
                    @else
                        <p class="text-red-500 text-base">Unable to fetch weather data for {{ $city }}.</p>
                    @endif

                    <h3 class="text-lg font-medium mt-4">Country Info</h3>
                    @if (isset($countryData[$city]) && $countryData[$city])
                        <p class="text-base">Country: {{ $countryData[$city]['country'] }}</p>
                        <p class="text-base">Capital: {{ $countryData[$city]['capital'] }}</p>
                        <p class="text-base">Population: {{ number_format($countryData[$city]['population']) }}</p>
                        @if ($countryData[$city]['flag'])
                            <img src="{{ $countryData[$city]['flag'] }}" alt="Flag" class="mx-auto h-12 mt-2">
                        @else
                            <p class="text-gray-500 text-base">No flag available</p>
                        @endif
                    @else
                        <p class="text-red-500 text-base">Unable to fetch country data for
                            {{ $countries[$city] ?? $city }}.</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
