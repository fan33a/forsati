@extends('layouts.app')

@section('title', 'Fursati - الوظائف المتاحة')

@section('content')
    <h1 class="page-title">الوظائف المتاحة</h1>
    
    <div class="jobs-grid">
        @forelse($jobs as $job)
            <!-- بطاقة الوظيفة -->
            <div class="job-card card">
                <div class="job-header">
                    <h2>{{ $job->title }}</h2>
                    <p class="company">{{ $job->company->name ?? 'شركة غير محددة' }}</p>
                </div>
                <div class="job-details">
                    <p><i class="fas fa-money-bill-wave"></i> {{ $job->salary_range }}</p>
                    <p><i class="fas fa-briefcase"></i> {{ $job->work_experience }} سنوات خبرة</p>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $job->work_place }}</p>
                </div>
                <div class="job-actions">
                    <a href="{{ route('job.details', $job->id) }}" class="btn btn-outline">تفاصيل الوظيفة</a>
                    <button class="btn-favorite" data-job-id="{{ $job->id }}">
                        <i class="far fa-star"></i>
                    </button>
                </div>
            </div>
        @empty
            <div class="no-jobs">
                <p>لا توجد وظائف متاحة حالياً</p>
            </div>
        @endforelse
    </div>
@endsection 