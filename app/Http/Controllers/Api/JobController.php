<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;

class JobController extends Controller
{
    public function getAllJobs(Request $request)
    {
        $query = Job::with(['company', 'workField', 'educationLevel']);

        if ($request->filled('from_date')) {
            $query->where('from_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->where('to_date', '<=', $request->to_date);
        }

        if ($request->filled('country_of_graduation')) {
            $query->where('country_of_graduation_id', $request->country_of_graduation);
        }

        if ($request->filled('country_of_residence')) {
            $query->where('country_of_residence_id', $request->country_of_residence);
        }

        if ($request->filled('work_field_id')) {
            $query->where('work_field_id', $request->work_field_id);
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('work_place')) {
            $query->where('work_place', 'like', '%' . $request->work_place . '%');
        }

        if ($request->filled('gender_perfrence')) {
            $query->where('gender_preference', $request->gender_perfrence);
        }

        if ($request->filled('education_level_id')) {
            $query->where('education_level_id', $request->education_level_id);
        }

        if ($request->filled('work_experience')) {
            $query->where('work_experience', $request->work_experience);
        }

        if ($request->filled('business_man_id')) {
            $query->where('business_man_id', $request->business_man_id);
        }

        $jobs = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $jobs
        ]);
    }

    public function getJobDetails($id)
    {
        $job = Job::with(['company', 'workField', 'educationLevel'])->find($id);

        if (!$job) {
            return response()->json([
                'status' => 'error',
                'message' => 'الوظيفة غير موجودة'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $job
        ]);
    }
}
