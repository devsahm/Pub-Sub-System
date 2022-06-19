<?php

namespace App\Http\Controllers;

class ResponseController extends Controller
{

    public function jsonResponse(array $data, int $statusCode = 200)
    {
        return response()->json($data,$statusCode);
    }

}
