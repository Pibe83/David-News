@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modifica Notizia') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success"
                                 role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('news.update', ['news' => $news->id]) }}"
                              method="POST"
                              class="mt-5"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title"
                                       class="form-label">{{ __('Title') }}</label>
                                <input type="text"
                                       class="form-control"
                                       id="title"
                                       name="title"
                                       value="{{ old('title', $news->title) }}"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="subtitle"
                                       class="form-label">{{ __('Subtitle') }}</label>
                                <input type="text"
                                       class="form-control"
                                       id="subtitle"
                                       name="subtitle"
                                       value="{{ old('subtitle', $news->subtitle) }}"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="content"
                                       class="form-label">{{ __('Content') }}</label>
                                <textarea class="form-control"
                                          id="content"
                                          name="content"
                                          rows="5"
                                          required>{{ old('content', $news->content) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="photo"
                                       class="form-label">{{ __('Photo') }}</label>
                                <input type="file"
                                       class="form-control"
                                       id="photo"
                                       name="photo">
                                <input type="hidden"
                                       name="current_photo"
                                       value="{{ $news->photo }}">
                            </div>

                            <button type="submit"
                                    class="btn btn-primary">{{ __('Update News') }}</button>
                            <a href="{{ route('news.index') }}"
                               class="btn btn-secondary">{{ __('Back to News') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
