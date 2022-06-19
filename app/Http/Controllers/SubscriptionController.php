<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{
    public $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function __invoke(CreateSubscriptionRequest $request, $topic )
    {
        try {
        $this->subscriptionService->subscribe($topic, $request->url);
        return ResponseHelper::success("subscription created successfully",201);
        } catch (\Throwable $th) {
         return ResponseHelper::error( $th->getMessage());
        }
    }

}
