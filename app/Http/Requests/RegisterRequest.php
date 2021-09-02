<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')
            ],
            'password' => ['required', 'string']
        ];
    }
}
