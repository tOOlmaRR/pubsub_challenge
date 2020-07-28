<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Repositories\SubscriptionRepositoryInterface;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;

    /**
     * SubscriptionRepository constructor
     */
    public function __construct(SubscriptionRepositoryInterface $subscription1Repository)
    {
        $this->subscriptionRepository = $subscription1Repository;
    }

    /**
     * Subscribe API endpoint, used to subscribe a page to messages under a specified topic
     *
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

        $subscription = $this->subscriptionRepository->create([
            'topic' => $topic,
            'url' => $request['url'],
        ]);

        return new SubscriptionResource($subscription);
    }
}
