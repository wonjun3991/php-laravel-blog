<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['email', 'required'],
            'password' => ['string', 'required']
        ];
    }
}
