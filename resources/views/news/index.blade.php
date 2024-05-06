@extends('layouts.app')

<style>
    #comment-text {
        max-height: 50px;
        overflow-y: auto;
    }

    .card .btn {
        padding: 0.15rem 0.2rem;
        font-size: 0.775rem;
    }

    .custom-card {
        border: 2px solid #a59f9f !important;
        border-radius: 2px !important;
        transition: box-shadow 0.6s ease;
        /* Aggiungi una transizione per un effetto più fluido */
    }

    .custom-card:hover {
        box-shadow: 1px 0px 10px rgba(0, 0, 0, 0.1);
        /* Aggiungi uno shadow su hover */
    }


    .comments-section {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .comment {
        margin-bottom: 15px;
        display: none;
    }

    .comment.active {
        display: block;
    }

    .like-buttons {
        display: flex;
        align-items: center;
    }

    .like-buttons button {
        margin-right: 5px;
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 my-5 ">
                @foreach ($news as $new)
                    <div class="card mb-4 custom-card">
                        <div class="card-body">
                            @if ($new->photo)
                                <img src="{{ asset('storage/photos/public/' . $new->photo) }}"
                                     alt="Photo">
                            @endif


                            <h5 class="card-title">
                                {!! html_entity_decode($new->title) !!}
                            </h5>



                            @if (!empty($new->subtitle))
                                <h6 class="card-subtitle mb-2 text-muted">{{ $new->subtitle }}</h6>
                            @endif
                            <p class="card-text">{{ $new->content }}</p>

                            <p class="card-text">Pubblicato: {{ $new->created_at->diffForHumans() }}</p>
                            @if ($new->user)
                                <p class="card-text">Creato da: {{ $new->user->name }}</p>
                            @endif

                            @if ($new->last_modified_at)
                                <p class="card-text">Ultima modifica: {{ $new->last_modified_at }}</p>
                            @endif

                            <a href="{{ route('news.show', ['slug' => $new->slug]) }}"
                               class="btn-sm btn-success">View Details</a>

                            <a href="{{ route('news.edit', ['id' => $new->id]) }}"
                               class="btn btn-sm btn-primary">Modifica</a>
                            <form action="{{ route('news.destroy', $new->slug) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button class='mt-3'
                                        type="submit">Cancella Notizia</button>
                            </form>


                        </div>
                        <div class="card-footer">
                            <hr>

                            <!-- Form per scrivere un nuovo commento -->
                            <form action="{{ route('comments.store') }}"
                                  method="POST"
                                  class="mb-3">
                                @csrf
                                <input type="hidden"
                                       name="news_id"
                                       value="{{ $new->id }}">
                                <div class="form-group">
                                    <label for="comment-text">Scrivi un Commento</label>
                                    <textarea class="form-control"
                                              id="comment-text"
                                              name="comment-text"
                                              rows="3"></textarea>
                                </div>
                                <button type="submit"
                                        class="btn btn-sm btn-success mt-3">Invia Commento</button>
                            </form>

                            <!-- Visualizzazione diretta dei commenti -->
                            <div class="comments-section">
                                <h6>Commenti ({{ $new->comments->count() }})</h6>
                                <div class="comment active">
                                    @if ($new->comments->count() > 0)
                                        <p class="card-text"
                                           style="background-color: white;">
                                            {{ $new->comments->first()->{"comment-text"} }}
                                        </p>

                                        <div class="like-buttons">
                                            @php $firstComment = $new->comments->first(); @endphp
                                            <!-- Pulsanti Like e Unlike -->
                                            <form action="{{ route('comment.like', ['commentId' => $firstComment->id]) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-primary">Like</button>
                                            </form>
                                            <form action="{{ route('comment.unlike', ['commentId' => $firstComment->id]) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger">Unlike</button>
                                            </form>
                                            <!-- Modal per visualizzare gli utenti che hanno messo Mi Piace -->
                                            <a href="#"
                                               class="btn btn-sm btn-info"
                                               data-bs-toggle="modal"
                                               data-bs-target="#likesModal{{ $firstComment->id }}"
                                               style="background-color: transparent; border: none;">
                                                {{ $firstComment->likes()->count() }} Mi piace
                                            </a>
                                            <!-- Modal per il primo commento -->
                                            <div class="modal fade"
                                                 id="likesModal{{ $firstComment->id }}"
                                                 tabindex="-1"
                                                 aria-labelledby="likesModalLabel{{ $firstComment->id }}"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="likesModalLabel{{ $firstComment->id }}">Utenti che hanno messo Mi Piace</h5>
                                                            <button type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul>
                                                                @foreach ($firstComment->likes as $like)
                                                                    <li>{{ $like->user->name }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if ($new->comments->count() > 1)
                                    <a href="#"
                                       class="show-more-comments">Visualizza altri commenti</a>
                                @endif
                                @foreach ($new->comments->slice(1) as $comment)
                                    <div class="comment">
                                        <p class="card-text"
                                           style="background-color: white;">{{ $comment->{"comment-text"} }}</p>
                                        <div class="like-buttons">
                                            <!-- Pulsanti Like e Unlike -->
                                            <form action="{{ route('comment.like', ['commentId' => $comment->id]) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-primary">Like</button>
                                            </form>
                                            <form action="{{ route('comment.unlike', ['commentId' => $like->id]) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger">Unlike</button>
                                            </form>

                                            <!-- Modal per visualizzare gli utenti che hanno messo Mi Piace -->
                                            <a class=" mb-0"
                                               data-bs-toggle="modal"
                                               data-bs-target="#likesModal{{ $comment->id }}"
                                               style="background-color: transparent; border: none;">
                                                <p class=""> {{ $comment->likes()->count() }} Mi piace</p>
                                            </a>
                                            <!-- Modal per il commento -->
                                            <div class="modal fade"
                                                 id="likesModal{{ $comment->id }}"
                                                 tabindex="-1"
                                                 aria-labelledby="likesModalLabel{{ $comment->id }}"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="likesModalLabel{{ $comment->id }}">Utenti che hanno messo Mi Piace</h5>
                                                            <button type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul>
                                                                @foreach ($comment->likes as $like)
                                                                    <li>{{ $like->user->name }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreLinks = document.querySelectorAll('.show-more-comments');

            showMoreLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const commentsSection = this.closest('.comments-section');
                    commentsSection.querySelectorAll('.comment:not(.active)').forEach(function(comment) {
                        comment.classList.add('active');
                    });
                    this.remove(); // Rimuove il link "Visualizza altri commenti"
                });
            });
        });
    </script>
@endsection
