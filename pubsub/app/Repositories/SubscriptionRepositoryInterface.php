<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface SubscriptionRepositoryInterface
 */
interface SubscriptionRepositoryInterface
{
    /**
     * Returns all Subscriptions
     *
     * @return Collection
     */
    public function all(): Collection;
}
