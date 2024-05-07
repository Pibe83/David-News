@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('News Details') }}</div>

                    <div class="card-body">
                        <div class="mb-4">
                            <h2>
                                {!! $news->title !!}
                            </h2>

                            @if (!empty($news->subtitle))
                                <h4>{{ $news->subtitle }}</h4>
                            @endif

                            <p>
                                {{ $news->content }}å
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('news.index') }}"
           class="btn btn-secondary mt-5">
            {{ __('Back to News') }}
        </a>
    </div>
@endsection
