# Setup Guide - Movie Search Application

## Quick Start

### 1. Prerequisites
- PHP 8.2 atau lebih tinggi
- MySQL Database
- Composer
- Node.js & NPM

### 2. Database sudah di-setup
Database `interview` sudah dikonfigurasi di `.env`:
```
DB_DATABASE=interview
```

### 3. Installation Steps

```bash
composer install
npm install
npm run build
php artisan migrate:fresh --seed
php artisan serve
```

### 4. Access Application
```
URL: http://localhost:8000
```

### 5. Login Credentials
```
Username: aldmic
Password: 123abc123
```

## Features Checklist

✅ **Authentication**
- Login/Logout functionality
- Session management
- Protected routes

✅ **Movie Features**
- Search movies via OMDb API
- Infinite scroll pagination
- Lazy loading images
- Movie detail page
- Add/Remove favorites

✅ **Multi-Language**
- English (EN)
- Indonesia (ID)
- Session-based switching

✅ **UI/UX**
- Responsive Bootstrap design
- Smooth animations
- Empty states
- Loading indicators

## Technology Stack

### Backend
- Laravel 12
- MySQL
- OMDb API Integration

### Frontend
- Bootstrap 5.3
- Vanilla JavaScript
- Intersection Observer API
- Fetch API

### Features Implementation
- **Infinite Scroll**: Auto-load on scroll
- **Lazy Loading**: Images load when visible
- **Multi-Language**: EN/ID with session storage
- **Security**: CSRF, Auth middleware, Password hashing

## Project Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php
│   ├── MovieController.php
│   └── FavoriteMovieController.php
├── Models/
│   ├── User.php
│   └── FavoriteMovie.php
└── Services/
    └── OmdbService.php

resources/views/
├── layouts/app.blade.php
├── auth/login.blade.php
├── movies/
│   ├── index.blade.php
│   └── show.blade.php
└── favorites/index.blade.php

lang/
├── en/
│   ├── auth.php
│   └── messages.php
└── id/
    ├── auth.php
    └── messages.php
```

## API Configuration

OMDb API sudah dikonfigurasi:
```
OMDB_API_KEY=72af6cc3
OMDB_API_URL=http://www.omdbapi.com/
```

## Database Schema

### users table
- id, username (unique), name, email, password
- Pre-seeded user: aldmic

### favorite_movies table
- id, user_id, imdb_id, title, year, poster, plot
- Unique constraint: (user_id, imdb_id)

## Testing

### Manual Test
1. ✅ Open http://localhost:8000
2. ✅ Login with aldmic/123abc123
3. ✅ Search movies (default: "movie")
4. ✅ Scroll down for infinite loading
5. ✅ Click movie to view details
6. ✅ Add to favorites
7. ✅ View favorites page
8. ✅ Remove from favorites
9. ✅ Switch language EN/ID
10. ✅ Logout

## Notes

- Clean code tanpa komentar
- Production-ready
- Follows Laravel best practices
- Responsive & mobile-friendly
- SEO-friendly structure

## Support

Untuk pertanyaan atau issue:
- Cek README_PROJECT.md untuk dokumentasi lengkap
- Verifikasi database connection di .env
- Pastikan OMDb API key valid
