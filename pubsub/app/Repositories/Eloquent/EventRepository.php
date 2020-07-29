<?php
namespace App\Repositories\Eloquent;

use App\Event;
use App\Repositories\EventRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    /**
     * EventRepository constructor
     *
     * @param User $model
     */
    public function __construct(Event $model)
    {
        parent::__construct($model);
    }

    /**
     * Returns all published Events from the database
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Returns published Events from the database which the current page has subscribed to (based on topic)
     *
     * @return Collection
     */
    public function allMessagesForCurrentPage(string $currentUrl): Collection
    {
        $messages = DB::table('events')
        ->where('subscriptions.url', $currentUrl)
        ->leftJoin('subscriptions', 'events.topic', '=', 'subscriptions.topic')
        ->select('events.topic', 'events.message')
        ->get();

        return $messages;
    }
}
