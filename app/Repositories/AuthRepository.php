<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function register(array $credentials)
    {
        $credentials['password'] = Hash::make($credentials['password']);

        return User::create($credentials);
    }

    public function logout()
    {
        return Auth::logout();
    }


    public function updatePassword(array $credentials)
    {
        return Auth::user()->update([
            'password' => Hash::make($credentials['password'])
        ]);
    }
}
