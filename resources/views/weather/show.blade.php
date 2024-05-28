<!DOCTYPE html>
<html>

<head>
    <title>Meteo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6dd5fa, #2980b9);
            color: #333;
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: #fff;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input[type="text"],
        .search-bar select,
        .search-bar button {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .search-bar input[type="text"],
        .search-bar select {
            width: 200px;
        }

        .search-bar button {
            background-color: #2980b9;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-bar button:hover {
            background-color: #1f6e9f;
        }

        .city-list {
            margin-bottom: 20px;
        }

        .city-list a {
            margin-right: 10px;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #2980b9;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .city-list a:hover {
            background-color: #1f6e9f;
        }

        .forecast-day {
            margin-top: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 15px;
        }

        .forecast-day h3 {
            margin: 0 0 10px;
        }

        .forecast-day p {
            margin: 5px 0;
        }

        .forecast-day img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <h1>Meteo</h1>

    <div class="search-bar">
        <form method="GET"
              action="{{ route('weather') }}">
            <input type="text"
                   name="city"
                   placeholder="Cerca una città"
                   value="{{ request('city') }}">
            <select name="days">
                @for ($i = 1; $i <= 14; $i++)
                    <option value="{{ $i }}"
                            {{ request('days') == $i ? 'selected' : '' }}>
                        {{ $i }} {{ Str::plural('giorno', $i) }}
                    </option>
                @endfor
            </select>
            <button type="submit">Cerca</button>
        </form>
    </div>

    <div class="city-list">
        @foreach ($defaultCities as $defaultCity)
            <a href="{{ route('weather', ['city' => $defaultCity, 'days' => $days]) }}">{{ $defaultCity }}</a>
        @endforeach
    </div>

    @if ($weather)
        <h2>Meteo per {{ $weather['location']['name'] }}</h2>
        @foreach ($weather['forecast']['forecastday'] as $forecast)
            <div class="forecast-day">
                <h3>{{ $forecast['date'] }}</h3>
                <p>Temperatura media: {{ $forecast['day']['avgtemp_c'] }}°C</p>
                <p>Condizione: {{ $forecast['day']['condition']['text'] }}</p>
                <img src="{{ $forecast['day']['condition']['icon'] }}"
                     alt="{{ $forecast['day']['condition']['text'] }}">
            </div>
        @endforeach
    @endif
</body>

</html>
