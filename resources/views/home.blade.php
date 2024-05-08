@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-8 mb-4 custom-card">
                <div class="card-body">

                    <h3 class="mb-3">Nuova news</>

                        <form action="{{ route('news.store') }}"
                              method="POST"
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
            </div>
        </div>
    </div>
@endsection
