@extends('layouts.app')

@section('title', __('messages.movies'))

@push('styles')
<style>
.hero-section {
    text-align: center;
    margin-bottom: 3rem;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 900;
    background: linear-gradient(135deg, #fb7185 0%, #f97316 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
    letter-spacing: -1px;
    filter: drop-shadow(0 0 30px rgba(251, 113, 133, 0.5));
}

.hero-subtitle {
    color: #cbd5e1;
    font-size: 1.25rem;
    font-weight: 400;
    max-width: 600px;
    margin: 0 auto;
}

.search-form {
    max-width: 800px;
    margin: 0 auto;
}

.search-wrapper {
    position: relative;
    display: flex;
    gap: 1rem;
}

.search-icon {
    position: absolute;
    left: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    font-size: 1.2rem;
    z-index: 10;
}

.search-input {
    flex: 1;
    padding: 1.25rem 1.5rem 1.25rem 3.5rem !important;
    border-radius: 20px !important;
    border: 2px solid rgba(255, 255, 255, 0.1);
    font-size: 1rem;
    background: rgba(15, 23, 42, 0.6) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    color: #ffffff !important;
    -webkit-text-fill-color: #ffffff !important;
}

.search-input::placeholder {
    color: #64748b !important;
    opacity: 1;
}

.search-input:focus {
    border-color: #fb7185;
    box-shadow: 0 0 0 0.25rem rgba(251, 113, 133, 0.2), 0 0 30px rgba(251, 113, 133, 0.3);
    background: rgba(15, 23, 42, 0.8) !important;
    color: #ffffff !important;
}

.search-input:-webkit-autofill,
.search-input:-webkit-autofill:hover,
.search-input:-webkit-autofill:focus,
.search-input:-webkit-autofill:active {
    -webkit-text-fill-color: #ffffff !important;
    -webkit-box-shadow: 0 0 0px 1000px rgba(15, 23, 42, 0.6) inset !important;
    transition: background-color 5000s ease-in-out 0s;
    color: #ffffff !important;
}

.search-btn {
    padding: 1rem 2.5rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 1rem;
}

.movie-card {
    margin-bottom: 2rem;
}

.movie-card .card {
    height: 100%;
    border-radius: 20px;
    overflow: hidden;
}

.movie-card .card-img-top {
    height: 450px;
    object-fit: cover;
    background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%);
}

.movie-card .card-body {
    padding: 1.5rem;
}

.movie-card .card-title {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #f1f5f9;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.movie-card .card-text {
    font-size: 0.9rem;
    color: #94a3b8;
}

.movie-card .btn {
    font-weight: 600;
    font-size: 0.9rem;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-state i {
    font-size: 5rem;
    color: #475569;
    margin-bottom: 1.5rem;
}

.empty-state p {
    font-size: 1.2rem;
    color: #94a3b8;
}

#loadingIndicator {
    padding: 3rem 0;
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="hero-section mb-5">
                <h1 class="hero-title">
                    {{ __('messages.movies') }}
                </h1>
                <p class="hero-subtitle">{{ __('messages.movies_subtitle') }}</p>
            </div>
            <form id="searchForm" class="search-form">
                <div class="search-wrapper">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" 
                           class="form-control search-input" 
                           name="search" 
                           id="searchInput"
                           placeholder="{{ __('messages.search_movies') }}" 
                           value="{{ $search }}">
                    <button class="btn btn-primary search-btn" type="submit">
                        <i class="bi bi-search"></i> {{ __('messages.search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="moviesContainer" class="row g-4">
        @if($movies && isset($movies['Search']))
            @foreach($movies['Search'] as $movie)
            <div class="col-lg-3 col-md-4 col-sm-6 movie-card">
                <div class="card h-100">
                    <img data-src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450?text=No+Image' }}" 
                         class="card-img-top lazy-image" 
                         alt="{{ $movie['Title'] }}"
                         style="height: 400px; object-fit: cover; background: #f0f0f0;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie['Title'] }}</h5>
                        <p class="card-text text-muted">{{ $movie['Year'] }}</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('movies.show', $movie['imdbID']) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i> {{ __('messages.view_details') }}
                            </a>
                            <button class="btn btn-outline-danger btn-sm add-favorite" 
                                    data-id="{{ $movie['imdbID'] }}"
                                    data-title="{{ $movie['Title'] }}"
                                    data-year="{{ $movie['Year'] }}"
                                    data-poster="{{ $movie['Poster'] }}">
                                <i class="bi bi-heart"></i> {{ __('messages.add_to_favorites') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @elseif($movies === null)
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-search"></i>
                    <p>{{ __('messages.search_to_find_movies') }}</p>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-film"></i>
                    <p>{{ __('messages.no_movies_found') }}</p>
                </div>
            </div>
        @endif
    </div>

    <div id="loadingIndicator" class="text-center py-4" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">{{ __('messages.loading') }}</span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentPage = 1;
let currentSearch = '{{ $search }}';
let isLoading = false;
let hasMore = {{ isset($movies['Search']) ? 'true' : 'false' }};

document.addEventListener('DOMContentLoaded', function() {
    lazyLoadImages();
    
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        currentSearch = document.getElementById('searchInput').value;
        currentPage = 1;
        window.location.href = '{{ route('movies.index') }}?search=' + currentSearch;
    });

    window.addEventListener('scroll', function() {
        if (isLoading || !hasMore) return;
        
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500) {
            loadMoreMovies();
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-favorite')) {
            e.preventDefault();
            const btn = e.target.closest('.add-favorite');
            addToFavorites({
                imdb_id: btn.dataset.id,
                title: btn.dataset.title,
                year: btn.dataset.year,
                poster: btn.dataset.poster,
                plot: ''
            });
        }
    });
});

function lazyLoadImages() {
    const images = document.querySelectorAll('.lazy-image');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

function loadMoreMovies() {
    if (isLoading) return;
    
    isLoading = true;
    currentPage++;
    document.getElementById('loadingIndicator').style.display = 'block';

    fetch(`{{ route('movies.index') }}?search=${currentSearch}&page=${currentPage}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.Search) {
            appendMovies(data.Search);
        } else {
            hasMore = false;
        }
        document.getElementById('loadingIndicator').style.display = 'none';
        isLoading = false;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loadingIndicator').style.display = 'none';
        isLoading = false;
    });
}

function appendMovies(movies) {
    const container = document.getElementById('moviesContainer');
    
    movies.forEach(movie => {
        const col = document.createElement('div');
        col.className = 'col-md-3 mb-4';
        col.innerHTML = `
            <div class="card h-100 shadow-sm movie-card">
                <img data-src="${movie.Poster != 'N/A' ? movie.Poster : 'https://via.placeholder.com/300x450?text=No+Image'}" 
                     class="card-img-top lazy-image" 
                     alt="${movie.Title}"
                     style="height: 400px; object-fit: cover; background: #f0f0f0;">
                <div class="card-body">
                    <h5 class="card-title">${movie.Title}</h5>
                    <p class="card-text text-muted">${movie.Year}</p>
                    <div class="d-grid gap-2">
                        <a href="/movies/${movie.imdbID}" class="btn btn-primary btn-sm">
                            <i class="bi bi-eye"></i> {{ __('messages.view_details') }}
                        </a>
                        <button class="btn btn-outline-danger btn-sm add-favorite" 
                                data-id="${movie.imdbID}"
                                data-title="${movie.Title}"
                                data-year="${movie.Year}"
                                data-poster="${movie.Poster}">
                            <i class="bi bi-heart"></i> {{ __('messages.add_to_favorites') }}
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(col);
    });
    
    lazyLoadImages();
}

function addToFavorites(movieData) {
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
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endpush
