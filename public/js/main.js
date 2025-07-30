document.addEventListener('DOMContentLoaded', function() {
    // تبديل المفضلة
    const favoriteButtons = document.querySelectorAll('.btn-favorite');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            if (this.classList.contains('active')) {
                icon.classList.replace('far', 'fas');
                // هنا يمكنك إضافة كود لحفظ الوظيفة في المفضلة
            } else {
                icon.classList.replace('fas', 'far');
                // هنا يمكنك إضافة كود لإزالة الوظيفة من المفضلة
            }
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
            // هنا يمكنك إضافة كود تسجيل الخروج
            alert('تم تسجيل الخروج بنجاح');
            window.location.href = 'index.html';
        });
    }
});