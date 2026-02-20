# Movie Search Application

Aplikasi web untuk mencari dan mengelola film favorit menggunakan Laravel 12 dan OMDb API.

## Demo URL
```
http://localhost:8000
```

## Fitur Aplikasi

### 1. Authentication
- Login dengan kredensial yang telah ditentukan
- Username: `aldmic`
- Password: `123abc123`
- Session management dengan auto redirect

### 2. Movie Search & List
- Pencarian film menggunakan OMDb API
- Infinite scroll untuk load more movies
- Lazy loading untuk gambar poster
- Tampilan grid responsive

### 3. Movie Detail
- Informasi lengkap film (Plot, Director, Actors, Ratings, dll)
- Add/Remove dari favorites
- Responsive design

### 4. Favorite Movies
- Simpan film favorit ke database
- Lihat daftar film favorit
- Hapus film dari favorit
- Persistent storage

### 5. Multi-Language Support
- English (EN) - Default
- Indonesia (ID)
- Language switcher di navbar

## Tech Stack

### Backend
- **Laravel 12** - PHP Framework
- **MySQL** - Database
- **Eloquent ORM** - Database management

### Frontend
- **Bootstrap 5.3** - CSS Framework
- **Bootstrap Icons** - Icon library
- **Vanilla JavaScript** - Infinite scroll & AJAX
- **Intersection Observer API** - Lazy loading images

### External API
- **OMDb API** - Movie database API
  - API Key: `72af6cc3`
  - Base URL: `http://www.omdbapi.com/`

## Architecture & Design Patterns

### MVC Pattern
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php          # Authentication logic
│   │   ├── MovieController.php         # Movie listing & detail
│   │   └── FavoriteMovieController.php # Favorite management
│   └── Middleware/
│       └── SetLocale.php               # Language switching
├── Models/
│   ├── User.php                        # User model
│   └── FavoriteMovie.php               # Favorite movie model
└── Services/
    └── OmdbService.php                 # API integration service
```

### Service Layer Pattern
- `OmdbService` - Abstraksi untuk komunikasi dengan OMDb API
- Dependency Injection di controllers
- Separation of concerns

### Database Schema

#### users
- id
- username (unique)
- name
- email
- password
- timestamps

#### favorite_movies
- id
- user_id (foreign key)
- imdb_id
- title
- year
- poster
- plot
- timestamps
- unique constraint (user_id, imdb_id)

## Libraries & Dependencies

### PHP (Composer)
```json
{
    "laravel/framework": "^12.0",
    "laravel/tinker": "^2.10.1"
}
```

### JavaScript (NPM)
```json
{
    "vite": "^6.0.0",
    "axios": "^1.7.4",
    "laravel-vite-plugin": "^1.1.1"
}
```

### Frontend Libraries (CDN)
- Bootstrap 5.3.0
- Bootstrap Icons 1.11.0

## Installation & Setup

### Requirements
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Database

### Steps

1. **Clone/Setup Project**
```bash
cd project-directory
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Configuration**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=interview
DB_USERNAME=root
DB_PASSWORD=

OMDB_API_KEY=72af6cc3
OMDB_API_URL=http://www.omdbapi.com/
```

5. **Run Migration & Seeder**
```bash
php artisan migrate:fresh --seed
```

6. **Build Assets**
```bash
npm run build
```

7. **Run Application**
```bash
php artisan serve
```

8. **Access Application**
```
http://localhost:8000
```

## Features Implementation

### 1. Infinite Scroll
Menggunakan vanilla JavaScript dengan window scroll event listener:
- Detect scroll position
- Auto load next page when near bottom
- Loading indicator
- Prevent duplicate requests

### 2. Lazy Loading Images
Menggunakan Intersection Observer API:
- Images load only when visible in viewport
- Smooth fade-in transition
- Placeholder background during load
- Better performance

### 3. Multi-Language
- Session-based locale storage
- Middleware untuk set locale
- Translation files (lang/en & lang/id)
- Language switcher component

### 4. Security
- CSRF Protection
- Authentication middleware
- Password hashing (bcrypt)
- SQL injection protection (Eloquent ORM)
- XSS protection (Blade templating)

## API Integration

### OMDb API Endpoints Used

1. **Search Movies**
```
GET http://www.omdbapi.com/?apikey={key}&s={search}&page={page}
```

2. **Get Movie Details**
```
GET http://www.omdbapi.com/?apikey={key}&i={imdbID}&plot=full
```

### Response Handling
- Success: Display data
- Error: Show user-friendly message
- Empty state: Custom placeholder

## UI/UX Features

### Design Elements
- Gradient background
- Card hover effects
- Smooth transitions
- Responsive grid layout
- Loading states
- Empty states
- Success/Error notifications

### Responsiveness
- Mobile-first approach
- Bootstrap grid system
- Responsive images
- Touch-friendly buttons

## Testing

### Manual Testing Checklist

1. **Authentication**
- [x] Login with correct credentials
- [x] Login with wrong credentials shows error
- [x] Protected routes redirect to login
- [x] Logout functionality

2. **Movie Search**
- [x] Search movies by keyword
- [x] Infinite scroll loads more results
- [x] Lazy loading images work
- [x] Empty state when no results

3. **Movie Detail**
- [x] Display full movie information
- [x] Add to favorites works
- [x] Remove from favorites works

4. **Favorites**
- [x] List all favorite movies
- [x] Remove from favorites
- [x] Empty state when no favorites
- [x] Navigate to movie details

5. **Multi-Language**
- [x] Switch between EN/ID
- [x] Session persists language choice
- [x] All static text translated

## Code Quality

### Best Practices
- Clean code without comments
- Consistent naming conventions
- DRY principle
- SOLID principles
- RESTful routing
- Proper error handling

### File Organization
- Separation of concerns
- Logical folder structure
- Reusable components
- Service abstraction

## Performance Optimization

1. **Frontend**
- Lazy loading images
- Debounced scroll events
- Minimal DOM manipulation
- CSS transitions instead of JS animations

2. **Backend**
- Eloquent eager loading ready
- Database indexing (unique constraints)
- Session-based locale (no DB query)

## Screenshots

### Login Page
- Clean, centered design
- Language switcher
- Form validation

### Movies List
- Grid layout
- Search functionality
- Infinite scroll
- Add to favorites button

### Movie Detail
- Full movie information
- Large poster image
- Ratings display
- Back navigation

### Favorites
- Saved movies grid
- Remove functionality
- Empty state message

## Future Enhancements

1. Advanced search filters (year, genre, type)
2. User registration system
3. Movie ratings/reviews
4. Share favorites with friends
5. Watchlist feature
6. Export favorites to PDF
7. Dark mode toggle
8. Progressive Web App (PWA)

## License
MIT License

## Credits
- Movie data provided by [OMDb API](http://www.omdbapi.com/)
- Icons by [Bootstrap Icons](https://icons.getbootstrap.com/)
- CSS Framework by [Bootstrap](https://getbootstrap.com/)
