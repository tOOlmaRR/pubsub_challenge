<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Repositories\EventRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class EventController extends Controller
{

    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * EventController constructor
     */
    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Publish API endpoint, used to publish a message to a specified topic
     *
     * @param Request $request
     * @param string $topic
     * @return EventResource
     */
    public function publish(Request $request, string $topic) : EventResource
    {
        $request->validate([
            'message' => 'required',
        ]);

        $event = $this->eventRepository->create([
            'topic' => $topic,
            'message' => $request['message'],
        ]);

        return new EventResource($event);
    }

    /**
     * This returns the view associated to the Event page which display all messages that the current page is subscribed to
     *
     * @param Request $request
     * @return View
     */
    public function view(Request $request) : View
    {
        $currentUrl = $request->fullUrl();

        // treat 127.0.0.1 as localhost to standardize the request URLs
        $currentUrl = str_contains($currentUrl, '127.0.0.1') ? str_replace('127.0.0.1', 'localhost', $currentUrl) : $currentUrl;

        // get messages for current URL from data source
        $messages = $this->eventRepository->allMessagesForCurrentPage($currentUrl);

        if (is_null($messages)) {
            $messages = new Collection();
        }

        return view('event')->with([
            'messages' => $messages
        ]);
    }
}
