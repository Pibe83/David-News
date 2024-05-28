@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1>Quotations</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Total Price</th>
                            <th>Taxable Price</th>
                            <th>Tax Price</th>
                            <th>Editable</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotations as $quotation)
                            <tr>
                                <td>{{ $quotation->id }}</td>
                                <td>{{ $quotation->total_price }}</td>
                                <td>{{ $quotation->taxable_price }}</td>
                                <td>{{ $quotation->tax_price }}</td>
                                <td>{{ $quotation->is_editable ? 'Yes' : 'No' }}</td>
                                <td>
                                    @if (optional(auth()->user())->is_admin)
                                        <a href="{{ route('quotations.edit', $quotation) }}"
                                           class="btn btn-link"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('quotations.destroy', $quotation) }}"
                                              method="POST"
                                              style="display: inline;"
                                              onsubmit="return confirm('Are you sure you want to delete this quotation?')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-link"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    @endif
                                    <button class="btn btn-link"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $quotation->id }}"
                                            aria-expanded="false"
                                            aria-controls="collapse{{ $quotation->id }}"><i class="fa-solid fa-history"></i> History</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div id="collapse{{ $quotation->id }}"
                                         class="accordion-collapse collapse"
                                         aria-labelledby="heading{{ $quotation->id }}"
                                         data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <h6 class="fw-bold">Storico delle Modifiche per la Quotazione {{ $quotation->id }}</h6>
                                            <ul>

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Azione</th>
                                                            <th>Utente</th>
                                                            <th>Data</th>
                                                            <th>Valore</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($quotation->history as $change)
                                                            <tr>
                                                                <td>{{ $change->action }}</td>
                                                                <td>{{ $change->user->name }}</td>
                                                                <td>{{ $change->created_at }}</td>
                                                                <td>{{ $change->modified_value }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        <form action="{{ route('quotations.search') }}"
                              method="GET">
                            <input type="text"
                                   name="city"
                                   placeholder="Inserisci il nome della città"
                                   required>
                            <button type="submit">Cerca</button>
                        </form>

                        @if ($weatherData)
                            <div class="weather-container">

                                <h2>Meteo per {{ $weatherDataLocation['name'] }}, {{ $weatherDataLocation['country'] }}</h2>
                                <div class="weather-details">
                                    <div>
                                        <p><strong>Temperatura:</strong> {{ $weatherData['current']['temp_c'] }}°C</p>
                                        <p><strong>Condizione:</strong> {{ $weatherData['current']['condition']['text'] }}</p>

                                    </div>
                                    <div>
                                        <img src="https:{{ $weatherData['current']['condition']['icon'] }}"
                                             alt="{{ $weatherData['current']['condition']['text'] }}">
                                    </div>
                                </div>
                                <p><strong>Ultimo aggiornamento:</strong> {{ $weatherData['current']['last_updated'] }}</p>
                            </div>
                        @else
                            <p>Impossibile ottenere i dati meteo.</p>
                        @endif

                        @if ($weatherData)
                            <h2>Meteo attuale a {{ $city }}</h2>
                            <p>Temperatura: {{ $weatherData['current']['temp_c'] }}°C</p>
                            <p>Condizioni: {{ $weatherData['current']['condition']['text'] }}</p>

                            {{-- Visualizza le previsioni per i prossimi giorni --}}
                            <h2>Previsioni meteo per i prossimi giorni</h2>
                            @foreach ($weatherData['forecast']['forecastday'] as $forecast)
                                <div>
                                    <h3>{{ \Carbon\Carbon::parse($forecast['date'])->format('d/m/Y') }}</h3>
                                    <p>Temperatura massima: {{ $forecast['day']['maxtemp_c'] }}°C</p>
                                    <p>Temperatura minima: {{ $forecast['day']['mintemp_c'] }}°C</p>
                                    <p>Condizioni: {{ $forecast['day']['condition']['text'] }}</p>
                                </div>
                            @endforeach
                        @else
                            <p>Non è stato possibile recuperare i dati meteo.</p>
                        @endif








            </div>
            </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
