<?php

namespace Tests\Feature;

use App\Jobs\PublishSubscriptionJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PublishingEventToTopicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_topic_publishing_cannot_be_done_with_an_empty_body()
    // {
    //     $response = $this->postJson('/publish/task');
    //     $response->assertStatus(200);
    // }

    public function test_topic_publishing_can_be_done()
    {
        Bus::fake();
        
        $topic = "task";
        $payload = [
            "message" => "Hello Chief"
        ];

        $response = $this->postJson("/publish/{$topic}", $payload);
        Bus::assertDispatched(PublishSubscriptionJob::class, function($job){
            return $job;
        });
        $response->assertStatus(200);
    }

    
}
