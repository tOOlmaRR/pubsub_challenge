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
    public function view() : View
    {
        if ( (! empty($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https') ||
            (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ||
            (! empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') ) {
            $scheme = 'https://';
        } else {
            $scheme = 'http://';
        }

        $currentUrl = $scheme . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $messages = DB::table('events')
        ->where('subscriptions.url', $currentUrl)
        ->leftJoin('subscriptions', 'events.topic', '=', 'subscriptions.topic')
        ->select('subscriptions.url', 'events.topic', 'events.message')
        ->get();

        return view('event')->with([
            'messages' => $messages
        ]);
    }
}
