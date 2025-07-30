<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function getAllFaqs()
    {
        $faqs = Faq::all();

        return response()->json([
            'status' => 'success',
            'data' => $faqs
        ]);
    }
}
