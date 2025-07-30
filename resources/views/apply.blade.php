@extends('layouts.app')

@section('title', 'Fursati - التقديم على الوظيفة')

@section('content')
    <div class="apply-container card">
        <h1 class="page-title">التقديم على الوظيفة</h1>
        <p class="job-applying-for">{{ $job->title ?? 'مطور ويب وجوال' }} - {{ $job->company ?? 'PURE for IT Solutions' }}</p>
        
        <form action="{{ route('apply.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id ?? 1 }}">
            
            <div class="upload-section">
                <h2><i class="fas fa-video"></i> رفع فيديو التقديم</h2>
                <div class="upload-box">
                    <input type="file" id="video-upload" name="video" accept="video/*" hidden required>
                    <label for="video-upload" class="upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>اضغط لرفع الفيديو</span>
                        <small>الحجم الأقصى: 50MB</small>
                    </label>
                    <div class="preview-container" id="video-preview"></div>
                    @error('video')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary submit-btn">إرسال الطلب</button>
        </form>
    </div>
@endsection

@push('scripts')
<script>
document.getElementById('video-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('video-preview');
    
    if (file) {
        const video = document.createElement('video');
        video.src = URL.createObjectURL(file);
        video.controls = true;
        video.style.maxWidth = '100%';
        video.style.marginTop = '10px';
        
        preview.innerHTML = '';
        preview.appendChild(video);
    }
});
</script>
@endpush 