<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class ResponseHelper
{
    
  /**
     * @param string|array $response
     * @param int          $status
     * @return Response
     */
    public static function build($response, $status)
    {
        return response()->json($response, $status);
    }


      /**
     * @param string|array $response
     * @param int          $status
     * @return Response
     */
    public static function success($response, $status = 200)
    {
        $buildableResponse = ['status' => 'success', 'data' => $response];
        return static::build($buildableResponse, $status);
    }

    /**
     * @param string|array $response
     * @param int          $status
     * @return Response
     */
    public static function error($response, $status = 400)
    {
        $response = (array) $response;
        $response = Arr::flatten($response);
        $response = $response[0] ?? 'Error occured, try again later';
        return static::build(['status'  => 'error', 'message' => $response], $status);
    }

}