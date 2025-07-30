<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Policy;

class PolicyController extends Controller
{
    public function getAllPolicies()
    {
        $policies = Policy::all();

        return response()->json([
            'status' => 'success',
            'data' => $policies
        ]);
    }
}
