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




                    <form action="{{ route('quotations.update', $quotation) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')
                        <label for="total_price">Prezzo Lordo:</label>
                        <input type="number"
                               id="total_price"
                               name="total_price"
                               step="0.01"
                               value={{ $quotation->total_price }}
                               required>




                        <!-- Aggiungi altri campi se necessario -->

                        <button type="submit">Salva</button>
                    </form>

                </div>
            </div>
        </div>
    @endsection
