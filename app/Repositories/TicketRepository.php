<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\StaticParams\TicketStaticParam;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TicketRepository implements TicketRepositoryInterface
{
    public function getAll() : Collection
    {
        return Ticket::all();
    }

    public function getById(int $id) : Ticket
    {
        return Ticket::where('id', $id)->first();
    }

    public function getPaginated(int $perPage = 10, array $orderParams = []) : LengthAwarePaginator
    {
        return Ticket::orderBy(
            isset($orderParams['field']) ? $orderParams['field'] : TicketStaticParam::DEFAULT_ORDER_FIELD,
            isset($orderParams['direction']) ? $orderParams['direction'] : TicketStaticParam::DEFAULT_ORDER_DIRECTION
        )->paginate($perPage);
    }

    public function save(Ticket $model) : bool
    {
        return $model->save();
    }
}