<?php
namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface EventRepositoryInterface
 */
interface EventRepositoryInterface
{
    /**
     * Returns all published Events from the database
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Returns published Events from the database which the current page has subscribed to (based on topic)
     *
     * @return Collection
     */
    public function allMessagesForCurrentPage(string $currentUrl);
}
