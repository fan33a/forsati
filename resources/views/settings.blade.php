@extends('layouts.app')

@section('title', 'Fursati - الإعدادات')

@section('content')
    <h1 class="page-title">الإعدادات</h1>
    
    <div class="settings-container card">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="setting-item">
                <h3><i class="fas fa-language"></i> اللغة</h3>
                <div class="language-options">
                    <button type="button" class="language-btn active" data-lang="ar">العربية</button>
                    <button type="button" class="language-btn" data-lang="en">English</button>
                    <input type="hidden" name="language" id="language-input" value="ar">
                </div>
            </div>
            
            <div class="setting-item">
                <h3><i class="fas fa-briefcase"></i> مجالات العمل المتاحة</h3>
                <div class="work-fields-list">
                    @foreach($workFields as $workField)
                        <span class="field-tag">{{ $workField->name }}</span>
                    @endforeach
                </div>
            </div>
            
            <div class="setting-item">
                <h3><i class="fas fa-graduation-cap"></i> المستويات التعليمية</h3>
                <div class="education-levels-list">
                    @foreach($educationLevels as $level)
                        <span class="level-tag">{{ $level->level_name }}</span>
                    @endforeach
                </div>
            </div>
            
            <div class="setting-item">
                <h3><i class="fas fa-bell"></i> الإشعارات</h3>
                <label class="switch">
                    <input type="checkbox" name="notifications" checked>
                    <span class="slider round"></span>
                </label>
            </div>
            
            <div class="setting-item">
                <h3><i class="fas fa-question-circle"></i> المساعدة</h3>
                <a href="{{ route('faqs') }}" class="btn btn-outline">الأسئلة الشائعة</a>
                <a href="{{ route('policies') }}" class="btn btn-outline">الشروط والسياسات</a>
            </div>
            
            <div class="logout-section">
                <button type="submit" class="btn btn-primary">حفظ الإعدادات</button>
                <button type="button" class="btn btn-outline logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
// Language selection
document.querySelectorAll('.language-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.language-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('language-input').value = this.dataset.lang;
    });
});

// Logout function
function logout() {
    if (confirm('هل أنت متأكد من تسجيل الخروج؟')) {
        window.location.href = '{{ route("logout") }}';
    }
}
</script>
@endpush 