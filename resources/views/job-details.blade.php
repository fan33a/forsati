@extends('layouts.app')

@section('title', 'Fursati - تفاصيل الوظيفة')

@section('content')
    <div class="job-details card">
        <h1 class="job-title">{{ $job->title ?? 'مطور ويب وجوال' }}</h1>
        <p class="company-name"><i class="fas fa-building"></i> {{ $job->company ?? 'PURE for IT Solutions' }}</p>
        
        <div class="details-section">
            <h2><i class="fas fa-info-circle"></i> معلومات الوظيفة</h2>
            <div class="details-grid">
                <div class="detail-item">
                    <i class="fas fa-globe"></i>
                    <span>{{ $job->location ?? 'الكويت' }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>{{ $job->salary ?? '2.5K - 5K د.ك / شهر' }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-briefcase"></i>
                    <span>{{ $job->experience ?? '3 سنوات خبرة' }}</span>
                </div>
            </div>
        </div>
        
        <div class="details-section">
            <h2><i class="fas fa-tools"></i> المهارات المطلوبة</h2>
            <div class="skills-tags">
                @if(isset($job->skills) && is_array($job->skills))
                    @foreach($job->skills as $skill)
                        <span class="skill-tag">{{ $skill }}</span>
                    @endforeach
                @else
                    <span class="skill-tag">Java</span>
                    <span class="skill-tag">JavaScript</span>
                    <span class="skill-tag">Bootstrap</span>
                    <span class="skill-tag">PHP</span>
                @endif
            </div>
        </div>
        
        <div class="details-section">
            <h2><i class="fas fa-user-tie"></i> متطلبات المرشح</h2>
            <div class="requirements">
                <p><strong>الجنسية:</strong> {{ $job->nationality ?? 'الكويت، فلسطين، الهند' }}</p>
                <p><strong>الجنس:</strong> {{ $job->gender ?? 'الكل' }}</p>
            </div>
        </div>
        
        <div class="apply-section">
            <a href="{{ route('apply', $job->id ?? 1) }}" class="btn btn-primary">تقديم على الوظيفة</a>
        </div>
    </div>
@endsection 