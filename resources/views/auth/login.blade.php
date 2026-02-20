<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.login') }} - MovieHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            background: #0a0e27;
            background-image: 
                radial-gradient(at 20% 30%, rgba(251, 113, 133, 0.15) 0px, transparent 50%),
                radial-gradient(at 80% 70%, rgba(249, 115, 22, 0.15) 0px, transparent 50%);
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
        }

        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(251, 113, 133, 0.05) 0%, transparent 50%);
            animation: rotate 30s linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            margin: auto;
        }

        .login-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 2.5rem 2rem;
            box-shadow: 
                0 30px 90px rgba(0, 0, 0, 0.5),
                0 0 100px rgba(251, 113, 133, 0.1);
            transition: all 0.4s ease;
        }

        .login-card:hover {
            box-shadow: 
                0 40px 120px rgba(0, 0, 0, 0.6),
                0 0 120px rgba(251, 113, 133, 0.2);
            transform: translateY(-5px);
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #fb7185 0%, #f97316 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 40px rgba(251, 113, 133, 0.4);
            animation: pulse-glow 3s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { 
                box-shadow: 0 10px 40px rgba(251, 113, 133, 0.4);
                transform: scale(1);
            }
            50% { 
                box-shadow: 0 15px 60px rgba(251, 113, 133, 0.6);
                transform: scale(1.05);
            }
        }

        .brand-title {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #fb7185 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
            filter: drop-shadow(0 0 30px rgba(251, 113, 133, 0.5));
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 0.4rem;
        }

        .login-subtitle {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            color: #cbd5e1;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: #fb7185;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 0.85rem 1.1rem;
            background: rgba(10, 14, 39, 0.6) !important;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #ffffff !important;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            -webkit-text-fill-color: #ffffff !important;
        }
        
        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:hover,
        .form-control:-webkit-autofill:focus,
        .form-control:-webkit-autofill:active {
            -webkit-text-fill-color: #ffffff !important;
            -webkit-box-shadow: 0 0 0px 1000px rgba(10, 14, 39, 0.6) inset !important;
            transition: background-color 5000s ease-in-out 0s;
            color: #ffffff !important;
        }

        .form-control::placeholder {
            color: #64748b !important;
            opacity: 1;
        }

        .form-control:focus {
            outline: none;
            border-color: #fb7185;
            background: rgba(10, 14, 39, 0.8) !important;
            box-shadow: 0 0 0 4px rgba(251, 113, 133, 0.15), 0 0 30px rgba(251, 113, 133, 0.3);
            color: #ffffff !important;
        }

        .form-check {
            margin: 1.25rem 0;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            background: rgba(10, 14, 39, 0.6);
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #fb7185;
            border-color: #fb7185;
        }

        .form-check-label {
            color: #cbd5e1;
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.95rem;
            background: linear-gradient(135deg, #fb7185 0%, #f97316 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(251, 113, 133, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(251, 113, 133, 0.6), 0 0 30px rgba(251, 113, 133, 0.4);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        .divider span {
            background: rgba(15, 23, 42, 0.9);
            padding: 0 1rem;
            position: relative;
            color: #64748b;
            font-size: 0.85rem;
        }

        .language-selector {
            text-align: center;
        }

        .language-selector label {
            color: #94a3b8;
            font-size: 0.85rem;
            margin-right: 0.75rem;
        }

        .language-selector select {
            background: rgba(10, 14, 39, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: #e2e8f0;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        .language-selector select:focus {
            outline: none;
            border-color: #fb7185;
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2.5rem 1.5rem;
            }

            .brand-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .brand-title {
                font-size: 2rem;
            }

            .login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="brand-section">
                <div class="brand-icon">
                    <i class="bi bi-camera-reels-fill"></i>
                </div>
                <h1 class="brand-title">MovieHub</h1>
            </div>

            <div class="login-header">
                <h2 class="login-title">{{ __('messages.welcome_back') }}</h2>
                <p class="login-subtitle">{{ __('messages.signin_subtitle') }}</p>
            </div>

            @if ($errors->any())
                <div class="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ __('auth.failed') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="bi bi-person-fill"></i>
                        {{ __('messages.username') }}
                    </label>
                    <div class="input-wrapper">
                        <input type="text" 
                               id="username" 
                               name="username" 
                               class="form-control @error('username') is-invalid @enderror" 
                               placeholder="aldmic"
                               value="{{ old('username') }}" 
                               required 
                               autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock-fill"></i>
                        {{ __('messages.password') }}
                    </label>
                    <div class="input-wrapper">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="••••••••"
                               required>
                    </div>
                </div>

                <div class="form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="remember" 
                           name="remember">
                    <label class="form-check-label" for="remember">
                        {{ __('messages.remember_me') }}
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    {{ __('messages.login') }}
                </button>
            </form>

            <div class="divider">
                <span>{{ __('messages.or') }}</span>
            </div>

            <div class="language-selector">
                <label for="language">
                    <i class="bi bi-globe2"></i> Language:
                </label>
                <select id="language" onchange="changeLanguage(this.value)">
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="id" {{ app()->getLocale() == 'id' ? 'selected' : '' }}>Indonesia</option>
                </select>
            </div>
        </div>
    </div>

    <script>
        function changeLanguage(lang) {
            window.location.href = '/lang/' + lang;
        }
    </script>
</body>
</html>