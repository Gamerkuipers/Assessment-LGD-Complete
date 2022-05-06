<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255',
            'surname' => 'required|max:255',
            'initials' => 'required|max:255',
            'postal_code' => 'required',
            'house_number' => 'required',
            'email' => 'required|unique:users,email|max:255',
            'phone_number' => 'required|max:255',
            'password' => ['required','max:255', Password::defaults()],
            'confirm_password' => 'required|same:password',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $firstname = $this->request->get('first_name');
            $initials = $this->request->get('initials');
            // check initials
            if(strtoupper(substr($firstname,0,1)) != strtoupper(substr($initials,0,1)))
            {
                $validator->errors()->add('initials','The first initials does not match your first name');
            }

            dd($validator)
            ;
        });
    }
}
