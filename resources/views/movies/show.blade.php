@extends('layouts.app')

@section('title', $movie['Title'] ?? __('messages.movie_detail'))

@push('styles')
<style>
.detail-container {
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 30px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    margin-bottom: 2rem;
}

.poster-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%);
}

.poster-container:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 70px rgba(0, 0, 0, 0.8), 0 0 50px rgba(251, 113, 133, 0.4);
}

.poster-container img {
    width: 100%;
    display: block;
}

.poster-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
    padding: 2rem 1.5rem 1.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.poster-container:hover .poster-overlay {
    opacity: 1;
}

.movie-title {
    font-size: 2.8rem;
    font-weight: 800;
    background: linear-gradient(135deg, #fb7185 0%, #f97316 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    filter: drop-shadow(0 0 30px rgba(251, 113, 133, 0.5));
}

.badge {
    padding: 0.6rem 1.2rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.95rem;
    margin-right: 0.75rem;
    margin-bottom: 0.75rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.info-section {
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: all 0.3s ease;
}

.info-section:hover {
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.6), 0 0 30px rgba(251, 113, 133, 0.2);
    transform: translateY(-3px);
    border-color: rgba(251, 113, 133, 0.3);
}

.info-section h5 {
    font-weight: 800;
    font-size: 1.4rem;
    color: #f1f5f9;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #fb7185;
}

.info-section h5 i {
    color: #fb7185;
    font-size: 1.5rem;
    filter: drop-shadow(0 0 10px rgba(251, 113, 133, 0.6));
}

.info-item {
    padding: 1.25rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
    border-radius: 10px;
}

.info-item:hover {
    background: rgba(251, 113, 133, 0.05);
    padding-left: 1.5rem;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item strong {
    color: #fb7185;
    font-weight: 700;
    display: inline-block;
    min-width: 120px;
}

.info-item {
    color: #cbd5e1;
}

.plot-text {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #cbd5e1;
    text-align: justify;
}

.rating-card {
    background: linear-gradient(135deg, #fb7185 0%, #f97316 100%);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 8px 25px rgba(251, 113, 133, 0.4);
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.rating-card:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 15px 40px rgba(251, 113, 133, 0.6), 0 0 40px rgba(251, 113, 133, 0.5);
}

.rating-value {
    font-size: 2.2rem;
    font-weight: 900;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.rating-source {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.9);
    margin-top: 0.75rem;
    font-weight: 600;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 1.5rem;
}

.action-buttons .btn {
    flex: 1;
    min-width: 180px;
    padding: 1rem 2rem;
    font-size: 1.05rem;
    font-weight: 700;
}
</style>
@endpush

@section('content')
<div class="container">
    @if(isset($movie['Error']))
        <div class="alert alert-danger">{{ $movie['Error'] }}</div>
        <a href="{{ route('movies.index') }}" class="btn btn-primary">{{ __('messages.back_to_list') }}</a>
    @else
    <div class="detail-container">
        <div class="row mb-5">
            <div class="col-lg-4 col-md-5 mb-4 mb-md-0">
                <div class="poster-container">
                    <img src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450?text=No+Image' }}" 
                         alt="{{ $movie['Title'] }}">
                    <div class="poster-overlay">
                        <p class="text-white mb-0">{{ $movie['Year'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <h1 class="movie-title">{{ $movie['Title'] }}</h1>
                <div class="mb-4">
                    @if(isset($movie['imdbRating']) && $movie['imdbRating'] != 'N/A')
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-star-fill"></i> {{ $movie['imdbRating'] }}/10 IMDb
                    </span>
                    @endif
                    <span class="badge bg-primary">
                        <i class="bi bi-calendar"></i> {{ $movie['Year'] }}
                    </span>
                    @if(isset($movie['Rated']) && $movie['Rated'] != 'N/A')
                    <span class="badge bg-info">
                        <i class="bi bi-ticket-perforated"></i> {{ $movie['Rated'] }}
                    </span>
                    @endif
                    @if(isset($movie['Runtime']) && $movie['Runtime'] != 'N/A')
                    <span class="badge bg-success">
                        <i class="bi bi-clock"></i> {{ $movie['Runtime'] }}
                    </span>
                    @endif
                </div>

                <div class="action-buttons">
                    @if($isFavorite)
                    <form action="{{ route('favorites.destroy', $movie['imdbID']) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-heart-fill"></i> {{ __('messages.remove_from_favorites') }}
                        </button>
                    </form>
                    @else
                    <button class="btn btn-outline-danger add-favorite-detail" 
                            data-id="{{ $movie['imdbID'] }}"
                            data-title="{{ $movie['Title'] }}"
                            data-year="{{ $movie['Year'] }}"
                            data-poster="{{ $movie['Poster'] }}"
                            data-plot="{{ $movie['Plot'] ?? '' }}">
                        <i class="bi bi-heart"></i> {{ __('messages.add_to_favorites') }}
                    </button>
                    @endif
                    <a href="{{ route('movies.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> {{ __('messages.back_to_list') }}
                    </a>
                </div>
            </div>

        </div>
    </div>

    @if(isset($movie['Plot']) && $movie['Plot'] != 'N/A')
    <div class="info-section">
        <h5><i class="bi bi-book"></i> {{ __('messages.plot') }}</h5>
        <p class="plot-text mb-0">{{ $movie['Plot'] }}</p>
    </div>
    @endif

    <div class="info-section">
        <h5><i class="bi bi-info-circle"></i> {{ __('messages.movie_information') }}</h5>
        <div class="row">
            @if(isset($movie['Genre']) && $movie['Genre'] != 'N/A')
            <div class="col-md-6 info-item">
                <strong><i class="bi bi-film me-2"></i>{{ __('messages.genre') }}:</strong> {{ $movie['Genre'] }}
            </div>
            @endif

            @if(isset($movie['Director']) && $movie['Director'] != 'N/A')
            <div class="col-md-6 info-item">
                <strong><i class="bi bi-camera-reels me-2"></i>{{ __('messages.director') }}:</strong> {{ $movie['Director'] }}
            </div>
            @endif

                    @if(isset($movie['Writer']) && $movie['Writer'] != 'N/A')
                    <div class="col-md-6 info-item">
                        <strong>{{ __('messages.writer') }}:</strong> {{ $movie['Writer'] }}
                    </div>
                    @endif

                    @if(isset($movie['Actors']) && $movie['Actors'] != 'N/A')
                    <div class="col-12 info-item">
                        <strong>{{ __('messages.actors') }}:</strong> {{ $movie['Actors'] }}
                    </div>
                    @endif

                    @if(isset($movie['Language']) && $movie['Language'] != 'N/A')
                    <div class="col-md-6 info-item">
                        <strong>{{ __('messages.language') }}:</strong> {{ $movie['Language'] }}
                    </div>
                    @endif

                    @if(isset($movie['Country']) && $movie['Country'] != 'N/A')
                    <div class="col-md-6 info-item">
                        <strong>{{ __('messages.country') }}:</strong> {{ $movie['Country'] }}
                    </div>
                    @endif

                    @if(isset($movie['Released']) && $movie['Released'] != 'N/A')
                    <div class="col-md-6 info-item">
                        <strong>{{ __('messages.released') }}:</strong> {{ $movie['Released'] }}
                    </div>
                    @endif

                    @if(isset($movie['Awards']) && $movie['Awards'] != 'N/A')
                    <div class="col-12 info-item">
                        <strong>{{ __('messages.awards') }}:</strong> {{ $movie['Awards'] }}
                    </div>
                    @endif
                </div>
            </div>

            @if(isset($movie['Ratings']) && is_array($movie['Ratings']) && count($movie['Ratings']) > 0)
            <div class="info-section">
                <h5><i class="bi bi-star-fill"></i> {{ __('messages.ratings') }}</h5>
                <div class="row g-3">
                    @foreach($movie['Ratings'] as $rating)
                    <div class="col-md-4">
                        <div class="rating-card">
                            <div class="rating-source">{{ $rating['Source'] }}</div>
                            <div class="rating-value">{{ $rating['Value'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addBtn = document.querySelector('.add-favorite-detail');
    if (addBtn) {
        addBtn.addEventListener('click', function() {
            const movieData = {
                imdb_id: this.dataset.id,
                title: this.dataset.title,
                year: this.dataset.year,
                poster: this.dataset.poster,
                plot: this.dataset.plot
            };

            fetch('{{ route('favorites.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(movieData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
</script>
@endpush
