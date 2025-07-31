<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;
use App\Models\Faq;
use App\Models\Policy;
use App\Models\WorkField;
use App\Models\EducationLevel;

class HomeController extends Controller
{
    public function index()
    {
        $jobs = Job::with('company')->latest()->take(10)->get();
        
        return view('index', compact('jobs'));
    }

    public function jobDetails($id)
    {
        $job = Job::with(['company', 'workField', 'educationLevel'])->findOrFail($id);
        
        return view('job-details', compact('job'));
    }

    public function favorites()
    {
        $favorites = collect(); // Placeholder for now since we don't have user authentication in web routes
        
        return view('favorites', compact('favorites'));
    }

    public function apply($id)
    {
        $job = Job::with('company')->findOrFail($id);
        
        return view('apply', compact('job'));
    }

    public function storeApplication(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mov,wmv|max:51200', // 50MB max
            'job_id' => 'required|integer|exists:jobs,id'
        ]);

        // This would be handled by the API controller in a real scenario
        return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح!');
    }

    public function faqs()
    {
        $faqs = Faq::all();
        
        return view('faqs', compact('faqs'));
    }

    public function policies()
    {
        $policies = Policy::all();
        
        return view('policies', compact('policies'));
    }

    public function settings()
    {
        $workFields = WorkField::all();
        $educationLevels = EducationLevel::all();
        
        return view('settings', compact('workFields', 'educationLevels'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'language' => 'required|in:ar,en',
            'notifications' => 'boolean'
        ]);

        // This would update user settings in a real scenario
        return redirect()->back()->with('success', 'تم حفظ الإعدادات بنجاح!');
    }

    public function logout()
    {
        return redirect('/');
    }
}