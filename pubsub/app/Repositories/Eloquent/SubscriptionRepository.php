<?php
namespace App\Repositories\Eloquent;

use App\Subscription;
use App\Repositories\SubscriptionRepositoryInterface;
use Illuminate\Support\Collection;

class SubscriptionRepository extends BaseRepository implements SubscriptionRepositoryInterface
{
    /**
     * EventRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Subscription $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
