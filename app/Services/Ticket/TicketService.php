<?php

namespace App\Services\Ticket;

use App\Models\Ticket as TicketModel;
use App\Repositories\TicketRepository;

class TicketService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new TicketRepository();
    }

    public function build(TicketModel $model)
    {
        $ticket = new Ticket();

        return $ticket->build($model);
    }

    public function getAll()
    {
        $models = $this->repository->getAll();

        if (empty($models))
            return [];

        $result = [];
        foreach ($models as $model)
        {
            array_push($result, $this->build($model));
        }

        return $result;
    }

    public function getPaginated(int $perPage = 15, array $orderParams = [])
    {
        $models = $this->repository->getPaginated($perPage, $orderParams);

        if (empty($models))
            return [];

        $result = [];
        foreach ($models as $model)
        {
            array_push($result, $this->build($model));
        }

        return [
            'data' => $result,
            'model' => $models
        ];
    }

    public function getById(int $id)
    {
        $agregator = $this->repository->getById($id);

        if (empty($agregator))
            return null;

        return $this->build($agregator);
    }

    public function make(array $data)
    {
        return (new Ticket())->make($data);
    }
}