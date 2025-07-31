@extends('layouts.app')

@section('title', 'Fursati - الوظائف المفضلة')

@section('content')
    <div class="favorites-page">
        <h1 class="page-title">الوظائف المفضلة</h1>
        
        <div class="jobs-grid" id="favoritesContainer">
            <!-- سيتم تحميل الوظائف المفضلة هنا عبر JavaScript -->
            <div class="loading-state">
                <i class="fas fa-spinner fa-spin"></i>
                <p>جاري تحميل الوظائف المفضلة...</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadFavoriteJobsPage();
});

function loadFavoriteJobsPage() {
    const token = getAuthToken();
    if (!token) {
        showLoginPrompt();
        return;
    }
    
    fetch('/ar/api/job-seeker/favorite-jobs', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('favoritesContainer');
        
        if (data.status === 'success' && data.data.length > 0) {
            container.innerHTML = '';
            data.data.forEach(favorite => {
                const jobCard = createJobCard(favorite.job);
                container.appendChild(jobCard);
            });
        } else {
            showEmptyState();
        }
    })
    .catch(error => {
        console.error('Error loading favorites:', error);
        showErrorState();
    });
}

function createJobCard(job) {
    const card = document.createElement('div');
    card.className = 'job-card card';
    card.innerHTML = `
        <div class="job-header">
            <h2>${job.title}</h2>
            <p class="company">${job.company ? job.company.name : 'شركة غير محددة'}</p>
        </div>
        <div class="job-details">
            <p><i class="fas fa-money-bill-wave"></i> ${job.salary_range}</p>
            <p><i class="fas fa-briefcase"></i> ${job.work_experience} سنوات خبرة</p>
            <p><i class="fas fa-map-marker-alt"></i> ${job.work_place}</p>
        </div>
        <div class="job-actions">
            <a href="/job-details/${job.id}" class="btn btn-outline">تفاصيل الوظيفة</a>
            <button class="btn-favorite active favorites-page-btn" data-job-id="${job.id}" onclick="toggleFavorite(${job.id}, this)" style="display: inline-block !important;">
                <i class="fas fa-star"></i>
            </button>
        </div>
    `;
    return card;
}

function toggleFavorite(jobId, button) {
    const token = getAuthToken();
    if (!token) {
        showAlert('يجب تسجيل الدخول أولاً', 'error');
        return;
    }
    
    // إظهار حالة التحميل
    button.disabled = true;
    const icon = button.querySelector('i');
    const originalIconClass = icon.className;
    icon.className = 'fas fa-spinner fa-spin';
    
    fetch(`/ar/api/job-seeker/jobs/${jobId}/mark-favorite`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // إزالة البطاقة من الصفحة
            const jobCard = button.closest('.job-card');
            if (jobCard) {
                jobCard.style.opacity = '0.5';
                setTimeout(() => {
                    jobCard.remove();
                    
                    // التحقق من وجود بطاقات أخرى
                    const remainingCards = document.querySelectorAll('.job-card');
                    if (remainingCards.length === 0) {
                        showEmptyState();
                    }
                }, 300);
            }
            
            showAlert('تم إزالة الوظيفة من المفضلة', 'success');
        } else {
            showAlert(data.message || 'حدث خطأ ما', 'error');
            // إعادة الحالة الأصلية
            icon.className = originalIconClass;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('حدث خطأ في الاتصال', 'error');
        // إعادة الحالة الأصلية
        icon.className = originalIconClass;
    })
    .finally(() => {
        button.disabled = false;
    });
}

function showEmptyState() {
    const container = document.getElementById('favoritesContainer');
    container.innerHTML = `
        <div class="no-favorites">
            <div class="empty-state">
                <i class="fas fa-star"></i>
                <h3>لا توجد وظائف مفضلة</h3>
                <p>لم تقم بإضافة أي وظائف للمفضلة بعد</p>
                <a href="/" class="btn btn-primary">تصفح الوظائف</a>
            </div>
        </div>
    `;
}

function showLoginPrompt() {
    const container = document.getElementById('favoritesContainer');
    container.innerHTML = `
        <div class="no-favorites">
            <div class="empty-state">
                <i class="fas fa-lock"></i>
                <h3>يجب تسجيل الدخول</h3>
                <p>يجب تسجيل الدخول لعرض الوظائف المفضلة</p>
                <button class="btn btn-primary" onclick="showLoginModal()">تسجيل دخول</button>
            </div>
        </div>
    `;
}

function showErrorState() {
    const container = document.getElementById('favoritesContainer');
    container.innerHTML = `
        <div class="no-favorites">
            <div class="empty-state">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>حدث خطأ</h3>
                <p>حدث خطأ أثناء تحميل الوظائف المفضلة</p>
                <button class="btn btn-primary" onclick="loadFavoriteJobsPage()">إعادة المحاولة</button>
            </div>
        </div>
    `;
}
</script>
@endpush 