<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    public function create($credentials)
    {
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);
        return $user;
    }
}