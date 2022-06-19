<?php

namespace App\Services;

use App\Jobs\PublishSubscriptionJob;
use Illuminate\Support\Facades\Redis;

class PublisherService
{
    public $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function publish(string $topic,  $requestBody)
    {
     
        try {
           $subscribers = $this->redis->lRange($topic, 0, -1);    
           PublishSubscriptionJob::dispatch($subscribers, $requestBody);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}