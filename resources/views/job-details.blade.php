@extends('layouts.app')

@section('title', 'Fursati - تفاصيل الوظيفة')

@section('content')
    <div class="job-details card">
        <h1 class="job-title">{{ $job->title }}</h1>
        <p class="company-name"><i class="fas fa-building"></i> {{ $job->company->name ?? 'شركة غير محددة' }}</p>
        
        <div class="details-section">
            <h2><i class="fas fa-info-circle"></i> معلومات الوظيفة</h2>
            <div class="details-grid">
                <div class="detail-item">
                    <i class="fas fa-globe"></i>
                    <span>{{ $job->work_place }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>{{ $job->salary_range }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-briefcase"></i>
                    <span>{{ $job->work_experience }} سنوات خبرة</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-calendar"></i>
                    <span>من {{ $job->from_date }} إلى {{ $job->to_date }}</span>
                </div>
            </div>
        </div>
        
        <div class="details-section">
            <h2><i class="fas fa-file-alt"></i> وصف الوظيفة</h2>
            <div class="job-description">
                <p>{{ $job->description }}</p>
            </div>
        </div>
        
        <div class="details-section">
            <h2><i class="fas fa-tools"></i> تفاصيل إضافية</h2>
            <div class="requirements">
                <p><strong>مجال العمل:</strong> {{ $job->workField->name ?? 'غير محدد' }}</p>
                <p><strong>المستوى التعليمي:</strong> {{ $job->educationLevel->level_name ?? 'غير محدد' }}</p>
                <p><strong>تفضيل الجنس:</strong> 
                    @if($job->gender_preference == 'male')
                        ذكور
                    @elseif($job->gender_preference == 'female')
                        إناث
                    @else
                        الكل
                    @endif
                </p>
            </div>
        </div>
        
        <div class="apply-section">
            <a href="{{ route('apply', $job->id) }}" class="btn btn-primary">تقديم على الوظيفة</a>
        </div>
    </div>
@endsection 