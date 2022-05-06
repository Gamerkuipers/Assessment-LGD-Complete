<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;
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
            /**
             * Initial and firstName Validation
             * check if the first initial matches the first letter of first name
             */
            $firstname = $this->request->get('first_name');
            $initials = $this->request->get('initials');

            if(substr_compare($firstname,substr($initials,0,1),0,1))
            {
                $validator->errors()->add('initials','The first initials does not match your first name');
            }

            /**
             * Postal code and House Number Validation
             * check the postal and house number with the spickle api
             */
            $response = Http::spikkl()->get('',[
                'key' => env('spikkl_key'),
                'postal_code' => $this->request->get('postal_code'),
                'street_number' => $this->request->get('house_number')
            ])->json();

            if ($response['status'] != "ok")
            {
                $error_msg = 'Invalid combination with %s';
                $validator->errors()->add('postal_code',sprintf($error_msg,'"House Number"'));
                $validator->errors()->add('house_number',sprintf($error_msg,'"Postal Code"'));
            } else {
                $this->request->set('spikkl_data', $response['results'][0]);
            }
        });
    }
}
