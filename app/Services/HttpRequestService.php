<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpRequestService
{
    
    public $httpClient;
    
    public function __construct()
    {
        $this->httpClient = Http::acceptJson();
    }

    public function postRequest(string $url, $payload)
    {
        return $this->httpClient->post($url, $payload);
    }
    

}