<?php

namespace App\Jobs;

use App\Services\HttpRequestService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $subscriberUrls, $body;

    public function __construct(array $subscriberUrls, $body)
    {
        $this->subscriberUrls = $subscriberUrls;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(HttpRequestService $httpClient)
    {
       foreach ($this->subscriberUrls as $url) {
           $httpClient->postRequest($url, $this->body);
       } 
    }
}
