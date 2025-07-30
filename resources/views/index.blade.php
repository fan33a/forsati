@extends('layouts.app')

@section('title', 'Fursati - الوظائف المتاحة')

@section('content')
    <h1 class="page-title">الوظائف المتاحة</h1>
    
    <div class="jobs-grid">
        @foreach($jobs ?? [] as $job)
            <!-- بطاقة الوظيفة -->
            <div class="job-card card">
                <div class="job-header">
                    <h2>{{ $job->title ?? 'مطور ويب وجوال' }}</h2>
                    <p class="company">{{ $job->company ?? 'PURE for IT Solutions' }}</p>
                </div>
                <div class="job-details">
                    <p><i class="fas fa-money-bill-wave"></i> {{ $job->salary ?? '2.5K - 5K د.ك' }}</p>
                    <p><i class="fas fa-briefcase"></i> {{ $job->experience ?? '3 سنوات خبرة' }}</p>
                </div>
                <div class="job-actions">
                    <a href="{{ route('job.details', $job->id ?? 1) }}" class="btn btn-outline">تفاصيل الوظيفة</a>
                    <button class="btn-favorite" data-job-id="{{ $job->id ?? 1 }}">
                        <i class="far fa-star"></i>
                    </button>
                </div>
            </div>
        @endforeach

        @if(empty($jobs))
            <!-- بطاقة الوظيفة 1 -->
            <div class="job-card card">
                <div class="job-header">
                    <h2>مطور ويب وجوال</h2>
                    <p class="company">PURE for IT Solutions</p>
                </div>
                <div class="job-details">
                    <p><i class="fas fa-money-bill-wave"></i> 2.5K - 5K د.ك</p>
                    <p><i class="fas fa-briefcase"></i> 3 سنوات خبرة</p>
                </div>
                <div class="job-actions">
                    <a href="{{ route('job.details', 1) }}" class="btn btn-outline">تفاصيل الوظيفة</a>
                    <button class="btn-favorite" data-job-id="1">
                        <i class="far fa-star"></i>
                    </button>
                </div>
            </div>

            <!-- بطاقة الوظيفة 2 -->
            <div class="job-card card">
                <div class="job-header">
                    <h2>مهندس برمجيات</h2>
                    <p class="company">Tech Solutions Co.</p>
                </div>
                <div class="job-details">
                    <p><i class="fas fa-money-bill-wave"></i> 15K - 20K ر.س</p>
                    <p><i class="fas fa-briefcase"></i> 5 سنوات خبرة</p>
                </div>
                <div class="job-actions">
                    <a href="{{ route('job.details', 2) }}" class="btn btn-outline">تفاصيل الوظيفة</a>
                    <button class="btn-favorite" data-job-id="2">
                        <i class="far fa-star"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>
@endsection 