<?php

namespace App\Services\User;

use App\Models\User as UserModel;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * @package App\Services\User
 */
class User
{
    /**
     * @var
     */
    private $model;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * @param UserModel $model
     * @return User
     */
    public function build(UserModel $model) : User
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param array $data
     * @return User
     */
    public function make(array $data) : User
    {
        $this->model = (new UserModel($data));

        return $this;
    }

    /**
     * @param array $data
     * @return User
     */
    public function fill(array $data) : User
    {
        $this->model->fill($data);

        return $this;
    }

    /**
     * @return User
     */
    public function save() : User
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
     * @return UserModel
     */
    public function getModel() : UserModel
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
    public function getName() : string
    {
        return $this->model->name;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->model->email;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->model->password;
    }

    /**
     * @return array
     */
    public function getTickets() : array
    {
        $tickets = $this->model->tickets()->get();

        $result = [];
        foreach ($tickets as $ticket) {

            array_push ($result, TicketFacade::build($ticket));
        }

        return [
            'model' => $tickets,
            'data' => $result
        ];
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name) : User
    {
        $this->model->name = $name;

        return $this;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email) : User
    {
        $this->model->email = $email;

        return $this;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password) : User
    {
        $this->model->password = Hash::make($password);

        return $this;
    }
}