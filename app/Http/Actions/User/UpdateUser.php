<?php

namespace App\Http\Actions\User;

use App\Models\User;
use BalajiDharma\LaravelAdminCore\Data\User\UserData;
use Illuminate\Support\Facades\Hash;

class UpdateUser
{
    public function handle(UserData $data, User $user): User
    {
        $user->update([
            'firstname' => $data->firstname,
            'lastname' => $data->lastname,
            'login' => $data->login,
            'email' => $data->email,
        ]);

        // if ($data->password) {
        //     $user->update([
        //         'password' => Hash::make($data->password),
        //     ]);
        // }

        $roles = $data->roles ?? [];
        $user->syncRoles($roles);

        return $user;
    }
}
