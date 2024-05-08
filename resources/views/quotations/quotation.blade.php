@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success"
                                 role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>


                </div>


                <form action="{{ route('quotations.store') }}"
                      method="POST">
                    @csrf

                    <label for="total_price">Prezzo Lordo:</label>
                    <input type="number"
                           id="total_price"
                           name="total_price"
                           step="0.01"
                           required>




                    <!-- Aggiungi altri campi se necessario -->

                    <button type="submit">Salva</button>
                </form>

            </div>
        </div>
    </div>
@endsection
