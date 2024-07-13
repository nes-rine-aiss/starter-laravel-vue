<?php

namespace App\Http\Requests\User;
use BalajiDharma\LaravelAdminCore\Data\User\UserData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:users,login,'.$this->user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id],
            // 'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function getUserData(): UserData
    {
        return UserData::from($this);
    }
}
