<?php

namespace App\Services\Ticket;

use App\Facades\UserFacade;
use App\Models\Ticket as TicketModel;
use App\Repositories\TicketRepository;

/**
 * Class Ticket
 * @package App\Services\Ticket
 */
class Ticket
{
    /**
     * @var
     */
    private $model;

    /**
     * @var TicketRepository
     */
    private $repository;

    /**
     * Ticket constructor.
     */
    public function __construct()
    {
        $this->repository = new TicketRepository();
    }

    /**
     * @param TicketModel $model
     * @return $this
     */
    public function build(TicketModel $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function make(array $data)
    {
        $this->model = (new TicketModel($data));

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fill(array $data)
    {
        $this->model->fill($data);

        return $this;
    }

    /**
     * @return $this
     */
    public function save()
    {
        $this->repository->save($this->getModel());

        return $this;
    }

    /**
     * @return bool
     */
    public function delete() : bool
    {
        return $this->model->delete();
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->model->id;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->model->title;
    }

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->model->description;
    }

    /**
     * @return mixed
     */
    public function getDeadlineAt()
    {
        return $this->model->deadline_at;
    }

    /**
     * @return mixed
     */
    public function getFinishedAt()
    {
        return $this->model->finished_at;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        $user = $this->model->user()->first();

        return UserFacade::build($user);
    }

    /**
     * @return bool
     */
    public function getFinished() : bool
    {
        return (bool) $this->model->finished;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->model->title = $title;

        return $this;
    }

    /**
     * @param string $deadlineAt
     * @return $this
     */
    public function setDeadlineAt(string $deadlineAt)
    {
        $this->model->deadline_at = $deadlineAt;

        return $this;
    }

    /**
     * @param string $finishedAt
     * @return $this
     */
    public function setFinishedAt(string $finishedAt)
    {
        $this->setFinished(true);
        $this->model->finished_at = $finishedAt;

        return $this;
    }

    /**
     * @param bool $finished
     * @return $this
     */
    public function setFinished(bool $finished)
    {
        $this->model->finished = $finished;

        return $this;
    }

    /**
     * Is ticket expire soon
     *
     * @return bool
     */
    public function isExpire()
    {
        if ($this->getFinished()) {
            return false;
        }

        if (!$this->getDeadlineAt()) {
            return false;
        }

        return strtotime($this->getDeadlineAt()) < strtotime(now());
    }

    /**
     * Is ticket already expired
     *
     * @return bool
     */
    public function isExpired()
    {
        if (!$this->getDeadlineAt()) {
            return false;
        }

        if (!$this->getFinishedAt()) {
            return false;
        }

        return !$this->getFinished() && strtotime($this->getDeadlineAt()) > strtotime($this->getFinishedAt());
    }
}