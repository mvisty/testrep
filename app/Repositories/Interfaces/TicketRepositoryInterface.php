<?php

namespace App\Repositories\Interfaces;

use App\Models\Ticket;

/**
 * Interface TicketRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface TicketRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Ticket $model
     * @return bool
     */
    public function save(Ticket $model) : bool;
}