<?php

namespace App\Http\Requests;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdatePasswordRequest extends FormRequest
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
     
            'password' => ['required', 'different:old_password','same:password_confirmation'],
            'password_confirmation' => ['required', 'different:old_password','same:password'],
        ];
    }

    public function messages(): array
    {
        return [
        

            'password.required' => 'Vous devez saisir un nouveau mot de passe.',
            'password.different' => 'Vous devez saisir un mot de passe différent de l\'ancien mot de passe.',
            'password_confirmation.different' => 'Vous devez saisir un mot de passe différent de l\'ancien mot de passe.',
            'password_confirmation.required' => 'Vous devez confirmer votre nouveau mot de passe.',
            'password_confirmation.same' => 'Les mots de passe ne correspondent pas.',
            'password.same' => 'Les mots de passe ne correspondent pas.',
        ];
        
    
}
}
