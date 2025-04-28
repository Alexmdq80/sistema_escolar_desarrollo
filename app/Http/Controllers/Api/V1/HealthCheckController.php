<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthCheckController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function check()
    {
        return response()->json(['status' => 'ok']);
    }
}
