@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dettagli Quotazione</div>

                    <div class="card-body">
                        <p><strong>Prezzo Totale:</strong> {{ $quotation->total_price }}</p>
                        <p><strong>Prezzo Tassabile:</strong> {{ $quotation->taxable_price }}</p>
                        <p><strong>Prezzo della Tassa:</strong> {{ $quotation->tax_price }}</p>
                        <!-- Aggiungi altri dettagli della quotazione qui -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
