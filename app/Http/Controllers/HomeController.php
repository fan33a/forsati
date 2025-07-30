<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jobs = [
            (object)[
                'id' => 1,
                'title' => 'مطور ويب وجوال',
                'company' => 'PURE for IT Solutions',
                'salary' => '2.5K - 5K د.ك',
                'experience' => '3 سنوات خبرة'
            ],
            (object)[
                'id' => 2,
                'title' => 'مهندس برمجيات',
                'company' => 'Tech Solutions Co.',
                'salary' => '15K - 20K ر.س',
                'experience' => '5 سنوات خبرة'
            ]
        ];

        return view('index', compact('jobs'));
    }

    public function jobDetails($id)
    {
        $job = (object)[
            'id' => $id,
            'title' => 'مطور ويب وجوال',
            'company' => 'PURE for IT Solutions',
            'location' => 'الكويت',
            'salary' => '2.5K - 5K د.ك / شهر',
            'experience' => '3 سنوات خبرة',
            'skills' => ['Java', 'JavaScript', 'Bootstrap', 'PHP'],
            'nationality' => 'الكويت، فلسطين، الهند',
            'gender' => 'الكل'
        ];

        return view('job-details', compact('job'));
    }

    public function favorites()
    {
        $favorites = [
            (object)[
                'job' => (object)[
                    'id' => 1,
                    'title' => 'مطور ويب وجوال',
                    'company' => 'PURE for IT Solutions',
                    'salary' => '2.5K - 5K د.ك',
                    'experience' => '3 سنوات خبرة'
                ]
            ]
        ];

        return view('favorites', compact('favorites'));
    }

    public function apply($id)
    {
        $job = (object)[
            'id' => $id,
            'title' => 'مطور ويب وجوال',
            'company' => 'PURE for IT Solutions'
        ];

        return view('apply', compact('job'));
    }

    public function storeApplication(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mov,wmv|max:51200', // 50MB max
            'job_id' => 'required|integer'
        ]);


        return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح!');
    }

    public function faqs()
    {
        $faqs = [
            (object)[
                'question' => 'ما هو Fursati؟',
                'answer' => 'Fursati هو منصة للوظائف تساعد الباحثين عن عمل في العثور على فرص عمل مناسبة وتساعد الشركات في العثور على مواهب مميزة.'
            ],
            (object)[
                'question' => 'كيف يمكنني التقديم على الوظائف؟',
                'answer' => 'يمكنك التقديم على الوظائف من خلال النقر على زر "تقديم على الوظيفة" في صفحة تفاصيل الوظيفة ورفع الفيديو المطلوب.'
            ]
        ];

        return view('faqs', compact('faqs'));
    }

    public function policies()
    {
        $policies = [
            (object)[
                'title' => 'شروط الاستخدام',
                'content' => 'باستخدامك لمنصة Fursati، فإنك توافق على الالتزام بهذه الشروط والأحكام...'
            ],
            (object)[
                'title' => 'سياسة الخصوصية',
                'content' => 'نحن نحرص على خصوصيتك. هذه السياسة توضح كيف نجمع ونستخدم المعلومات الخاصة بك...'
            ],
            (object)[
                'title' => 'سياسة الإلغاء والاسترداد',
                'content' => 'في حال رغبتك في إلغاء حسابك، يمكنك ذلك من خلال صفحة الإعدادات...'
            ]
        ];

        return view('policies', compact('policies'));
    }

    public function settings()
    {
        $settings = (object)[
            'language' => 'ar',
            'notifications' => true
        ];

        return view('settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'language' => 'required|in:ar,en',
            'notifications' => 'boolean'
        ]);


        return redirect()->back()->with('success', 'تم حفظ الإعدادات بنجاح!');
    }

        public function logout()
    {
        return redirect('/');
    }
}