<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        $messages = Event::all();
        return view('event')->with([
            'messages' => $messages
        ]);
    }
}
