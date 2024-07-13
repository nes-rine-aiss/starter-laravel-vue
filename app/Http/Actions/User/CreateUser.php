<?php

namespace App\Http\Actions\User;

use App\Models\User;
use BalajiDharma\LaravelAdminCore\Data\User\UserData;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    public function handle(UserData $data): User
    {
        $user = User::create([
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'login' => $data->login,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);

        $roles = $data->roles ?? [];
        $user->assignRole($roles);

        return $user;
    }
}
