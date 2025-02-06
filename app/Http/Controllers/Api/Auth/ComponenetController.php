<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Officers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ComponenetController extends BaseController
{
    public function officersList(): JsonResponse
    {
        $officers = Officers::where('status', 1)->get();

        return response()->json([
            'success' => true,
            'data' => $officers
        ]);
    }
}
