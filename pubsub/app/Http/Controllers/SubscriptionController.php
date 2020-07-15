<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * @param Request $request
     * @param string $topic
     * @return SubscriptionResource
     */
    public function add(Request $request, string $topic) : SubscriptionResource
    {
        $request->validate([
            'url' => 'required',
        ]);

        // TODO: Validate that the url/topic combination is unique

        $subscription = Subscription::create([
            'topic' => $topic,
            'url' => $request['url'],
        ]);
        return new SubscriptionResource($subscription);
    }
}
