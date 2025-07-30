<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;

class ApplicationController extends Controller
{
    public function applyForJob(Request $request, $jobId)
    {
        $request->validate([
            'vedio' => 'required|file|mimes:mp4,avi,mov,wmv|max:51200'
        ]);

        $user = auth()->user();
        $job = Job::find($jobId);

        if (!$job) {
            return response()->json([
                'status' => 'error',
                'message' => 'الوظيفة غير موجودة'
            ], 404);
        }

        $existingApplication = Application::where('user_id', $user->id)
            ->where('job_id', $jobId)
            ->first();

        if ($existingApplication) {
            return response()->json([
                'status' => 'error',
                'message' => 'لقد تقدمت على هذه الوظيفة مسبقاً'
            ], 400);
        }

        $videoPath = $request->file('vedio')->store('applications', 'public');

        Application::create([
            'user_id' => $user->id,
            'job_id' => $jobId,
            'video_path' => $videoPath
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم التقديم على الوظيفة بنجاح'
        ]);
    }
}
