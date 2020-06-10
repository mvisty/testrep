<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getById(int $id)
    {
        return User::where('id', $id)->first();
    }

    public function getPaginated(int $perPage = 15, array $orderParams = [])
    {
        return User::orderBy(
            isset($orderParams['field']) ? $orderParams['field'] : 'id',
            isset($orderParams['direction']) ? $orderParams['direction'] : 'desc'
        )->paginate($perPage);
    }

    public function save(User $model) : bool
    {
        return $model->save();
    }
}