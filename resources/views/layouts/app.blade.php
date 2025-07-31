<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> الرئيسية
                </a>
                <a href="{{ route('favorites') }}" class="{{ request()->routeIs('favorites') ? 'active' : '' }}">
                    <i class="far fa-bookmark"></i> المفضلة
                </a>
                <a href="{{ route('faqs') }}" class="{{ request()->routeIs('faqs') ? 'active' : '' }}">
                    <i class="fas fa-question-circle"></i> الأسئلة الشائعة
                </a>
                <a href="{{ route('policies') }}" class="{{ request()->routeIs('policies') ? 'active' : '' }}">
                    <i class="fas fa-file-contract"></i> السياسات
                </a>
                <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> الإعدادات
                </a>
                <div class="auth-buttons">
                    <button class="btn btn-outline" onclick="showLoginModal()">تسجيل دخول</button>
                    <button class="btn btn-primary" onclick="showRegisterModal()">تسجيل حساب</button>
                </div>
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

    <!-- Modal تسجيل دخول -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLoginModal()">&times;</span>
            <h2>تسجيل دخول</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label for="loginEmail">البريد الإلكتروني</label>
                    <input type="email" id="loginEmail" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">كلمة المرور</label>
                    <input type="password" id="loginPassword" required>
                </div>
                <button type="submit" class="btn btn-primary">تسجيل دخول</button>
            </form>
        </div>
    </div>

    <!-- Modal تسجيل حساب -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeRegisterModal()">&times;</span>
            <h2>تسجيل حساب جديد</h2>
            <form id="registerForm">
                <div class="form-group">
                    <label for="registerName">الاسم الكامل</label>
                    <input type="text" id="registerName" required>
                </div>
                <div class="form-group">
                    <label for="registerEmail">البريد الإلكتروني</label>
                    <input type="email" id="registerEmail" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword">كلمة المرور</label>
                    <input type="password" id="registerPassword" required>
                </div>
                <div class="form-group">
                    <label for="registerPasswordConfirm">تأكيد كلمة المرور</label>
                    <input type="password" id="registerPasswordConfirm" required>
                </div>
                <button type="submit" class="btn btn-primary">تسجيل حساب</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html> 