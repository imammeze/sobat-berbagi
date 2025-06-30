<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserByRole(string $role)
    {
        return User::role($role)->get();
    }

    public function getUserById(string $id)
    {
        return User::find($id);
    }
}
