@extends('layouts.app')

@section('title', 'Fursati - السياسات والشروط')

@section('content')
    <h1 class="page-title">السياسات والشروط</h1>
    
    <div class="policies-container card">
        <div class="policy-content">
            @if(isset($policies) && is_array($policies))
                @foreach($policies as $policy)
                    <h2>{{ $policy->title }}</h2>
                    <p>{{ $policy->content }}</p>
                @endforeach
            @else
                <h2>شروط الاستخدام</h2>
                <p>باستخدامك لمنصة Fursati، فإنك توافق على الالتزام بهذه الشروط والأحكام...</p>
                
                <h2>سياسة الخصوصية</h2>
                <p>نحن نحرص على خصوصيتك. هذه السياسة توضح كيف نجمع ونستخدم المعلومات الخاصة بك...</p>
                
                <h2>سياسة الإلغاء والاسترداد</h2>
                <p>في حال رغبتك في إلغاء حسابك، يمكنك ذلك من خلال صفحة الإعدادات...</p>
            @endif
        </div>
    </div>
@endsection 