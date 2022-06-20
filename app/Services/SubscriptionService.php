<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class SubscriptionService
{
    public $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }


    public function subscribe(string $topic, string $url)
    {
        try {
        
           if (!$this->isExist($topic)) {
               return $this->createSubscription($topic, $url);
              }

              $subscribers = $this->redis->lRange($topic, 0, -1);
              if (!in_array($url, $subscribers)) {
                return $this->createSubscription($topic, $url);
              }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function isExist($key) : bool
    {
        return $this->redis->exists($key);
    }

    public function createSubscription(string $topic, string $url)
    {
       $this->redis->rPush($topic, $url);
       return true;
    }

}