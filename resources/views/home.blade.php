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

                    <form action="{{ route('news.store') }}"
                          method="POST"
                          class="mt-5"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title"
                                   class="form-label">{{ __('Title') }}</label>
                            <input type="text"
                                   class="form-control"
                                   id="title"
                                   name="title"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="subtitle"
                                   class="form-label">{{ __('Subtitle') }}</label>
                            <input type="text"
                                   class="form-control"
                                   id="subtitle"
                                   name="subtitle"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="content"
                                   class="form-label">{{ __('Content') }}</label>
                            <textarea class="form-control"
                                      id="content"
                                      name="content"
                                      rows="5"
                                      required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="photo"
                                   class="form-label">{{ __('Photo') }}</label>
                            <input type="file"
                                   class="form-control"
                                   id="photo"
                                   name="photo"> <!-- Aggiunto campo di input di tipo file per il caricamento dell'immagine -->
                        </div>

                        <button type="submit"
                                class="btn btn-primary">{{ __('Create News') }}</button>
                        <a href="{{ route('news.index') }}"
                           class="btn btn-secondary">{{ __('Back to News') }}</a>
                    </form>
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
