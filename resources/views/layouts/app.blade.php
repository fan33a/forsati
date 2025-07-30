<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fursati')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>
    <!-- شريط التنقل العلوي -->
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}">Fursati</a>
            </div>
            <div class="nav-links">
                <a href="{{ route('favorites') }}" class="{{ request()->routeIs('favorites') ? 'active' : '' }}">
                    <i class="far fa-bookmark"></i> المفضلة
                </a>
                <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> الإعدادات
                </a>
            </div>
        </div>
    </nav>

    <!-- محتوى الصفحة -->
    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html> 