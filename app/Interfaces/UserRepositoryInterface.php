<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserByRole(string $role);
    public function getUserById(string $id);
}
