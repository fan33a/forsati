@extends('layouts.app')

@section('title', 'Fursati - الأسئلة الشائعة')

@section('content')
    <h1 class="page-title">الأسئلة الشائعة</h1>
    
    <div class="faq-container">
        @forelse($faqs as $faq)
            <div class="faq-item card">
                <div class="faq-question">
                    <h3>{{ $faq->question }}</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>
        @empty
            <div class="no-faqs">
                <p>لا توجد أسئلة شائعة متاحة حالياً</p>
            </div>
        @endforelse
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