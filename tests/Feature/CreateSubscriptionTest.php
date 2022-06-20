<?php

namespace Tests\Feature;

use App\Services\SubscriptionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Redis;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateSubscriptionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_subscription_cannot_be_created_with_empty_body()
    {
        $topic = "topic";
        $response = $this->postJson("/subscribe/{$topic}", []);
        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The url field is required",
            "errors" => [
                "url" => [
                    "The url field is required"
                ]
            ]

        ]);
    }

    public function test_subscription_cannot_be_created_with_empty_url_value()
    {
        $topic = "topic";
        $response = $this->postJson("/subscribe/{$topic}", [
            'url' => ''
        ]);
        
        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The url field is required",
            "errors" => [
                "url" => [
                    "The url field is required"
                ]
            ]

        ]);
       
    }


    public function test_subscription_cannot_be_created_with_invalid_url()
    {
        $topic = "topic";
        $response = $this->postJson("/subscribe/{$topic}", [
            'url' => '127.0.0.1:8001/event'
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The provided url is not valid",
            "errors" => [
                "url" => [
                    "The provided url is not valid"
                ]
            ]
        ]);

    }

    public function test_subscription_can_be_created()
    {
        $topic = "topic";
        $response = $this->postJson("/subscribe/{$topic}", [
            'url' => 'http://127.0.0.1:8000/events'
        ]);  

        $this->mock(SubscriptionService::class, function (MockInterface $mock) use ($topic) {
            $mock->shouldReceive('subscribe')
            ->with($topic, "http://127.0.0.1:8000/events")
            ->andReturn(true);
        });
        
        $response->assertStatus(201); 
        $response->assertJson([
                "status" => "success",
                "data" =>  "subscription created successfully" 
        ]);
    }
}
