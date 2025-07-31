@extends('layouts.app')

@section('title', 'Fursati - السياسات والشروط')

@section('content')
    <h1 class="page-title">السياسات والشروط</h1>
    
    <div class="policies-container">
        @forelse($policies as $policy)
            <div class="policy-item card">
                <h2>{{ $policy->title }}</h2>
                <div class="policy-content">
                    <p>{{ $policy->body }}</p>
                </div>
            </div>
        @empty
            <div class="no-policies">
                <p>لا توجد سياسات متاحة حالياً</p>
            </div>
        @endforelse
    </div>
@endsection 