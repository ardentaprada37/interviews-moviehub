# MovieHub - Aplikasi Pencarian Film

Aplikasi web untuk mencari film dan menyimpan koleksi film favorit menggunakan OMDb API.

## Fitur Utama

- Login/logout dengan autentikasi
- Pencarian film dengan infinite scroll
- Detail film lengkap (plot, cast, rating, dll)
- Tambah/hapus film favorit
- Ganti bahasa (ID/EN)
- Responsive di semua device
- Lazy loading untuk gambar

## Library yang Dipakai

### Backend
- Laravel 11 - Framework PHP
- Guzzle - HTTP client buat hit API OMDb
- MySQL - Database

### Frontend
- Bootstrap 5.3 - CSS framework
- Vanilla JavaScript - Interaksi dinamis
- Bootstrap Icons - Icons

### Tools
- Composer - Manage dependencies PHP
- NPM - Manage dependencies JS
- Vite - Build tools

## Arsitektur

Aplikasi ini pakai pola **MVC (Model-View-Controller)**:

**Model:**
- User - untuk autentikasi
- FavoriteMovie - data film favorit

**Controller:**
- AuthController - handle login/logout
- MovieController - search & detail film
- FavoriteMovieController - kelola favorit

**Service:**
- OmdbService - komunikasi dengan OMDb API

**View:**
- Blade templates untuk tampilan

Selain MVC, ada beberapa pattern yang diterapin:
- Service Layer - pisahin business logic dari controller
- Middleware - buat auth dan localization
- Dependency Injection - bikin code lebih clean



## Cara Install

1. Clone repo
```bash
git clone <url-repo>
cd moviehub
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```


5. Dapetin API key dari http://www.omdbapi.com/ terus masukin ke `.env`
```
OMDB_API_KEY=your_key
```

6. Migrate & seed
```bash
php artisan migrate --seed
```

7. Build assets
```bash
npm run build
```

8. Jalanin server
```bash
php artisan serve
```

Buka `http://localhost:8000`

## Akun Demo

Username: **aldmic**  
Password: **123abc123**

## Struktur Folder

```
app/
├── Http/Controllers/  - Controller
├── Models/           - Model database  
└── Services/         - Business logic

database/
├── migrations/       - Schema database
└── seeders/         - Data awal

resources/
├── views/           - Tampilan blade
└── lang/            - File bahasa

routes/web.php       - Routing
```

## Keamanan

- CSRF protection
- Password di-hash pakai bcrypt
- Auth middleware untuk protect routes
- Eloquent ORM mencegah SQL injection

---

Dibuat untuk Technical Test Web Developer
