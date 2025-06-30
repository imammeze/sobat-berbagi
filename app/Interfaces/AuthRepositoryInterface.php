<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function login(array $credentials);
    public function register(array $credentials);
    public function logout();
    public function updatePassword(array $credentials);
}
