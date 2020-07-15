<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @param Request $request
     * @param string $topic
     * @return SubscriptionResource
     */
    public function publish(Request $request, string $topic)
    {
        dd("Publish");
    }
}
