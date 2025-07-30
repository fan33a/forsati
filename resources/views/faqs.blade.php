@extends('layouts.app')

@section('title', 'Fursati - الأسئلة الشائعة')

@section('content')
    <h1 class="page-title">الأسئلة الشائعة</h1>
    
    <div class="faq-container">
        @foreach($faqs ?? [] as $faq)
            <div class="faq-item card">
                <div class="faq-question">
                    <h3>{{ $faq->question }}</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>
        @endforeach

        @if(empty($faqs))
            <div class="faq-item card">
                <div class="faq-question">
                    <h3>ما هو Fursati؟</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Fursati هو منصة للوظائف تساعد الباحثين عن عمل في العثور على فرص عمل مناسبة وتساعد الشركات في العثور على مواهب مميزة.</p>
                </div>
            </div>
            
            <div class="faq-item card">
                <div class="faq-question">
                    <h3>كيف يمكنني التقديم على الوظائف؟</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>يمكنك التقديم على الوظائف من خلال النقر على زر "تقديم على الوظيفة" في صفحة تفاصيل الوظيفة ورفع الفيديو المطلوب.</p>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', function() {
        const answer = this.nextElementSibling;
        const icon = this.querySelector('i');
        
        if (answer.style.display === 'block') {
            answer.style.display = 'none';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        } else {
            answer.style.display = 'block';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
    });
});
</script>
@endpush 