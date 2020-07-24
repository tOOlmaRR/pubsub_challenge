<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Resources\EventResource;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * @param Request $request
     * @param string $topic
     * @return EventResource
     */
    public function publish(Request $request, string $topic) : EventResource
    {
        // dd("Publish");

        $request->validate([
            'message' => 'required',
        ]);

        $event = Event::create([
            'topic' => $topic,
            'message' => $request['message'],
        ]);

        return new EventResource($event);
    }

    /**
     *  @return View
     */
    public function view(Request $request) : View
    {
        $currentUrl = $request->fullUrl();

        // treat 127.0.0.1 as localhost to standardize the request URLs
        $currentUrl = str_contains($currentUrl, '127.0.0.1') ? str_replace('127.0.0.1', 'localhost', $currentUrl) : $currentUrl;

        $messages = DB::table('events')
        ->where('subscriptions.url', $currentUrl)
        ->leftJoin('subscriptions', 'events.topic', '=', 'subscriptions.topic')
        ->select('events.topic', 'events.message')
        ->get();

        return view('event')->with([
            'messages' => $messages
        ]);
    }
}
