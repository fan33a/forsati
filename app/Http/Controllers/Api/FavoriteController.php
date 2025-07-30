<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Job;

class FavoriteController extends Controller
{
    public function markFavorite($jobId)
    {
        $user = auth()->user();
        $job = Job::find($jobId);

        if (!$job) {
            return response()->json([
                'status' => 'error',
                'message' => 'الوظيفة غير موجودة'
            ], 404);
        }

        $existingFavorite = Favorite::where('user_id', $user->id)
            ->where('job_id', $jobId)
            ->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'تم إزالة الوظيفة من المفضلة'
            ]);
        }

        Favorite::create([
            'user_id' => $user->id,
            'job_id' => $jobId
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تم إضافة الوظيفة للمفضلة'
        ]);
    }

    public function getFavoriteJobs()
    {
        $user = auth()->user();
        $favorites = Favorite::with(['job.company', 'job.workField', 'job.educationLevel'])
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $favorites
        ]);
    }
}
