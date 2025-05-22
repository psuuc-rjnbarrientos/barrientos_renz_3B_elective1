</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-6">Weather Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($weatherData as $city => $data)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-2">{{ $city }}</h2>
                    @if ($data)
                        <p class="text-lg">Temperature: {{ $data['temperature'] }}°C</p>
                        <p class="text-lg">Description: {{ ucfirst($data['description']) }}</p>
                        <p class="text-lg">Humidity: {{ $data['humidity'] }}</p>
                    @else
                        <p class="text-red-500">Unable to fetch weather data for {{ $city }}.</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
