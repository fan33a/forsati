@extends('layouts.app')

@section('title', 'Fursati - الوظائف المفضلة')

@section('content')
    <h1 class="page-title">الوظائف المفضلة</h1>
    
    <div class="jobs-grid">
        @foreach($favorites ?? [] as $favorite)
            <!-- بطاقة الوظيفة المفضلة -->
            <div class="job-card card">
                <div class="job-header">
                    <h2>{{ $favorite->job->title ?? 'مطور ويب وجوال' }}</h2>
                    <p class="company">{{ $favorite->job->company ?? 'PURE for IT Solutions' }}</p>
                </div>
                <div class="job-details">
                    <p><i class="fas fa-money-bill-wave"></i> {{ $favorite->job->salary ?? '2.5K - 5K د.ك' }}</p>
                    <p><i class="fas fa-briefcase"></i> {{ $favorite->job->experience ?? '3 سنوات خبرة' }}</p>
                </div>
                <div class="job-actions">
                    <a href="{{ route('job.details', $favorite->job->id ?? 1) }}" class="btn btn-outline">تفاصيل الوظيفة</a>
                    <button class="btn-favorite active" data-job-id="{{ $favorite->job->id ?? 1 }}">
                        <i class="fas fa-star"></i>
                    </button>
                </div>
            </div>
        @endforeach

        @if(empty($favorites))
            <!-- بطاقة الوظيفة المفضلة 1 -->
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
                    <button class="btn-favorite active" data-job-id="1">
                        <i class="fas fa-star"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>
@endsection 