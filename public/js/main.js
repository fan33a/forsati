document.addEventListener('DOMContentLoaded', function() {
    // التحقق من حالة تسجيل الدخول عند تحميل الصفحة
    checkAuthStatus();
    
    // تبديل المفضلة
    const favoriteButtons = document.querySelectorAll('.btn-favorite');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const jobId = this.getAttribute('data-job-id');
            const icon = this.querySelector('i');
            
            // التحقق من تسجيل الدخول
            if (!getAuthToken()) {
                showAlert('يجب تسجيل الدخول أولاً', 'error');
                showLoginModal();
                return;
            }
            
            // إظهار حالة التحميل
            this.disabled = true;
            icon.className = 'fas fa-spinner fa-spin';
            
            // إرسال طلب إلى API
            fetch(`/ar/api/job-seeker/jobs/${jobId}/mark-favorite`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Authorization': `Bearer ${getAuthToken()}`
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.classList.toggle('active');
                    if (this.classList.contains('active')) {
                        icon.className = 'fas fa-star';
                        showAlert('تم إضافة الوظيفة للمفضلة', 'success');
                    } else {
                        icon.className = 'far fa-star';
                        showAlert('تم إزالة الوظيفة من المفضلة', 'success');
                    }
                } else {
                    showAlert(data.message || 'حدث خطأ ما', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('حدث خطأ في الاتصال', 'error');
                // إعادة الحالة الأصلية
                if (this.classList.contains('active')) {
                    icon.className = 'fas fa-star';
                } else {
                    icon.className = 'far fa-star';
                }
            })
            .finally(() => {
                this.disabled = false;
            });
        });
    });

    // عرض/إخفاء إجابات الأسئلة الشائعة
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            const icon = this.querySelector('i');
            
            answer.classList.toggle('show');
            icon.classList.toggle('rotate');
            
            if (answer.classList.contains('show')) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                answer.style.maxHeight = '0';
            }
        });
    });

    // معاينة الفيديو قبل الرفع
    const videoUpload = document.getElementById('video-upload');
    if (videoUpload) {
        videoUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('video-preview');
            
            if (file) {
                const videoURL = URL.createObjectURL(file);
                preview.innerHTML = `
                    <video controls>
                        <source src="${videoURL}" type="${file.type}">
                        متصفحك لا يدعم تشغيل الفيديو
                    </video>
                    <button class="btn-remove-video"><i class="fas fa-times"></i></button>
                `;
                
                // إزالة الفيديو
                preview.querySelector('.btn-remove-video').addEventListener('click', function() {
                    preview.innerHTML = '';
                    videoUpload.value = '';
                });
            }
        });
    }

    // تبديل اللغة
    const languageButtons = document.querySelectorAll('.language-btn');
    languageButtons.forEach(button => {
        button.addEventListener('click', function() {
            languageButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            // هنا يمكنك إضافة كود لتغيير اللغة
        });
    });

    // تسجيل الخروج
    const logoutBtn = document.querySelector('.logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            if (confirm('هل أنت متأكد من تسجيل الخروج؟')) {
                fetch('/ar/api/logout', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'Authorization': `Bearer ${getAuthToken()}`
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        localStorage.removeItem('auth_token');
                        window.location.href = '/';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    localStorage.removeItem('auth_token');
                    window.location.href = '/';
                });
            }
        });
    }

    // نموذج تسجيل الدخول
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            fetch('/ar/api/login', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ email, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    localStorage.setItem('auth_token', data.token);
                    localStorage.setItem('user_data', JSON.stringify(data.user));
                    updateAuthUI();
                    showAlert('تم تسجيل الدخول بنجاح', 'success');
                    closeLoginModal();
                } else {
                    showAlert(data.message || 'فشل تسجيل الدخول', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('حدث خطأ في الاتصال', 'error');
            });
        });
    }

    // نموذج تسجيل الحساب
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const fullName = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const passwordConfirm = document.getElementById('registerPasswordConfirm').value;
            
            if (password !== passwordConfirm) {
                showAlert('كلمات المرور غير متطابقة', 'error');
                return;
            }
            
            fetch('/ar/api/register', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ 
                    full_name: fullName, 
                    email, 
                    password, 
                    password_confirmation: passwordConfirm 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    localStorage.setItem('auth_token', data.token);
                    localStorage.setItem('user_data', JSON.stringify(data.user));
                    updateAuthUI();
                    showAlert('تم إنشاء الحساب بنجاح', 'success');
                    closeRegisterModal();
                } else {
                    showAlert(data.message || '{{ __("messages.error") }}', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('حدث خطأ في الاتصال', 'error');
            });
        });
    }
});

// دالة للتحقق من حالة تسجيل الدخول
function checkAuthStatus() {
    const token = getAuthToken();
    if (token) {
        // التحقق من صحة الـ token
        fetch('/ar/api/user', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        })
        .then(response => {
            if (response.ok) return response.json();
            throw new Error('Invalid token');
        })
        .then(data => {
            if (data.status === 'success') {
                localStorage.setItem('user_data', JSON.stringify(data.user));
                updateAuthUI();
                loadFavoriteJobs();
            } else {
                throw new Error('Invalid token');
            }
        })
        .catch(error => {
            console.error('Auth check failed:', error);
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user_data');
            updateAuthUI();
        });
    } else {
        updateAuthUI();
    }
}

// دالة لتحديث واجهة المستخدم حسب حالة تسجيل الدخول
function updateAuthUI() {
    const authButtons = document.querySelector('.auth-buttons');
    const token = getAuthToken();
    const userData = JSON.parse(localStorage.getItem('user_data') || '{}');
    
    if (token && userData.full_name) {
        // المستخدم مسجل دخول
        authButtons.innerHTML = `
            <span class="user-welcome">مرحباً، ${userData.full_name}</span>
            <button class="btn btn-outline" onclick="logout()">تسجيل خروج</button>
        `;
        
        // إظهار أزرار المفضلة
        document.querySelectorAll('.btn-favorite').forEach(btn => {
            btn.style.display = 'inline-block';
        });
    } else {
        // المستخدم غير مسجل دخول
        authButtons.innerHTML = `
            <button class="btn btn-outline" onclick="showLoginModal()">تسجيل دخول</button>
            <button class="btn btn-primary" onclick="showRegisterModal()">تسجيل حساب</button>
        `;
        
        // إخفاء أزرار المفضلة
        document.querySelectorAll('.btn-favorite').forEach(btn => {
            btn.style.display = 'none';
        });
    }
}

// دالة لتحميل الوظائف المفضلة
function loadFavoriteJobs() {
    const token = getAuthToken();
    if (!token) return;
    
    fetch('/ar/api/job-seeker/favorite-jobs', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // تحديث أزرار المفضلة
            data.data.forEach(favorite => {
                const favoriteBtn = document.querySelector(`[data-job-id="${favorite.job_id}"]`);
                if (favoriteBtn) {
                    favoriteBtn.classList.add('active');
                    const icon = favoriteBtn.querySelector('i');
                    icon.className = 'fas fa-star';
                }
            });
        }
    })
    .catch(error => {
        console.error('Error loading favorites:', error);
    });
}

// دالة تسجيل الخروج
function logout() {
    if (confirm('{{ __("messages.confirm_logout") }}')) {
        fetch('/ar/api/logout', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Authorization': `Bearer ${getAuthToken()}`
            }
        })
        .then(response => response.json())
        .then(data => {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user_data');
            updateAuthUI();
            showAlert('{{ __("messages.success") }}', 'success');
        })
        .catch(error => {
            console.error('Error:', error);
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user_data');
            updateAuthUI();
        });
    }
}

// دوال Modal
function showLoginModal() {
    document.getElementById('loginModal').style.display = 'block';
}

function closeLoginModal() {
    document.getElementById('loginModal').style.display = 'none';
}

function showRegisterModal() {
    document.getElementById('registerModal').style.display = 'block';
}

function closeRegisterModal() {
    document.getElementById('registerModal').style.display = 'none';
}

// إغلاق Modal عند النقر خارجه
window.onclick = function(event) {
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    
    if (event.target === loginModal) {
        closeLoginModal();
    }
    if (event.target === registerModal) {
        closeRegisterModal();
    }
}

// دالة للحصول على token المصادقة
function getAuthToken() {
    return localStorage.getItem('auth_token') || '';
}

// دالة لعرض التنبيهات
function showAlert(message, type = 'info') {
    // إزالة أي تنبيهات سابقة
    const existingAlerts = document.querySelectorAll('.alert');
    existingAlerts.forEach(alert => alert.remove());
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    
    // إضافة الرسالة
    const messageSpan = document.createElement('span');
    messageSpan.textContent = message;
    alertDiv.appendChild(messageSpan);
    
    // إضافة زر إغلاق
    const closeBtn = document.createElement('button');
    closeBtn.innerHTML = '&times;';
    closeBtn.className = 'alert-close';
    closeBtn.onclick = () => {
        alertDiv.style.transform = 'translateX(400px)';
        setTimeout(() => alertDiv.remove(), 300);
    };
    alertDiv.appendChild(closeBtn);
    
    // إضافة التنبيه للصفحة
    document.body.appendChild(alertDiv);
    
    // إظهار التنبيه مع انيميشن
    setTimeout(() => {
        alertDiv.classList.add('show');
    }, 10);
    
    // إزالة التنبيه تلقائياً بعد 4 ثواني
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.style.transform = 'translateX(400px)';
            setTimeout(() => alertDiv.remove(), 300);
        }
    }, 4000);
}

// دالة تغيير اللغة
function switchLanguage(language) {
    fetch('/switch-language', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            language: language
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showAlert(data.message, 'success');
            // إعادة تحميل الصفحة لتطبيق اللغة الجديدة
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showAlert(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('حدث خطأ أثناء تغيير اللغة', 'error');
    });
}