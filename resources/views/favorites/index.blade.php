@extends('layouts.app')

@section('title', __('messages.my_favorites'))

@push('styles')
<style>
.favorites-header {
    text-align: center;
    margin-bottom: 3rem;
}

.favorites-title {
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

.favorites-subtitle {
    color: #cbd5e1;
    font-size: 1.25rem;
    font-weight: 400;
    max-width: 600px;
    margin: 0 auto;
}

.favorite-card {
    margin-bottom: 2rem;
}

.favorite-card .card {
    height: 100%;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
}

.favorite-card .card-img-top {
    height: 450px;
    object-fit: cover;
}

.favorite-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: linear-gradient(135deg, #fb7185 0%, #f97316 100%);
    backdrop-filter: blur(10px);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 15px;
    font-weight: 600;
    font-size: 0.85rem;
    z-index: 10;
    box-shadow: 0 0 20px rgba(251, 113, 133, 0.6);
}

.empty-favorites {
    text-align: center;
    padding: 5rem 2rem;
    background: rgba(15, 23, 42, 0.4);
    border: 2px dashed rgba(255, 255, 255, 0.1);
    border-radius: 20px;
}

.empty-favorites i {
    font-size: 6rem;
    color: #475569;
    margin-bottom: 2rem;
}

.empty-favorites h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #f1f5f9;
    margin-bottom: 1rem;
}

.empty-favorites p {
    font-size: 1.1rem;
    color: #94a3b8;
    margin-bottom: 2rem;
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="favorites-header">
        <h1 class="favorites-title">
            <i class="bi bi-heart-fill"></i> {{ __('messages.my_favorites') }}
        </h1>
        <p class="favorites-subtitle">{{ __('messages.favorites_subtitle') }}</p>
    </div>

    @if($favorites->isEmpty())
        <div class="empty-favorites">
            <i class="bi bi-heart"></i>
            <h3>{{ __('messages.no_favorites') }}</h3>
            <p>{{ __('messages.favorites_subtitle') }}</p>
            <a href="{{ route('movies.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-film me-2"></i> {{ __('messages.movies') }}
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($favorites as $favorite)
            <div class="col-lg-3 col-md-4 col-sm-6 favorite-card">
                <div class="card h-100">
                    <span class="favorite-badge">
                        <i class="bi bi-heart-fill me-1"></i> Favorite
                    </span>
                    <img src="{{ $favorite->poster != 'N/A' && $favorite->poster ? $favorite->poster : 'https://via.placeholder.com/300x450?text=No+Image' }}" 
                         class="card-img-top" 
                         alt="{{ $favorite->title }}"
                         style="height: 400px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #f1f5f9;">{{ $favorite->title }}</h5>
                        <p class="card-text" style="color: #94a3b8;">{{ $favorite->year }}</p>
                        @if($favorite->plot)
                        <p class="card-text small" style="color: #64748b;">{{ Str::limit($favorite->plot, 100) }}</p>
                        @endif
                        <div class="d-grid gap-2">
                            <a href="{{ route('movies.show', $favorite->imdb_id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i> {{ __('messages.view_details') }}
                            </a>
                            <form action="{{ route('favorites.destroy', $favorite->imdb_id) }}" method="POST" class="remove-favorite-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="bi bi-trash"></i> {{ __('messages.remove_from_favorites') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.remove-favorite-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (confirm('{{ __('messages.remove_from_favorites') }}?')) {
                fetch(this.action, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
</script>
@endpush
