<?php

namespace App\Services\User;

use App\Models\UserModel;
use App\Repositories\UserRepository;
use App\Services\Interfaces\UserServiceInterface;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService implements UserServiceInterface
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserService constructor.
     */
    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * @param UserModel $model
     * @return User
     */
    public function build(UserModel $model)
    {
        $userModel = new User();

        return $userModel->build($model);
    }

    /**
     * @return array
     */
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

    /**
     * @param int $perPage
     * @param array $orderParams
     * @return array
     */
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

    /**
     * @param int $id
     * @return User|null
     */
    public function getById(int $id)
    {
        $user = $this->repository->getById($id);

        if (empty($user))
            return null;

        return $this->build($user);
    }

    /**
     * @param array $data
     * @return User
     */
    public function make(array $data)
    {
        return (new User())->make($data);
    }
}