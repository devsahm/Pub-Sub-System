<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriberController extends Controller
{
    public function __invoke(Request $request)
    {
        Log::info($request->all());
        //ALL IMPLEMENTATION SHOULD HAPPEN HERE
    }
    
}
