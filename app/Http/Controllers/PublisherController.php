<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Services\PublisherService;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
   public $publisherService;

   public function __construct(PublisherService $publisherService)
   {
       $this->publisherService = $publisherService;
   }


   public function __invoke(Request $request, $topic)
   {
       try {
          $this->publisherService->publish($topic, $request->getContent()); 
          return ResponseHelper::success("publish was successful");
       } catch (\Throwable $th) {
           return ResponseHelper::error($th->getMessage());
       }
   }

}
