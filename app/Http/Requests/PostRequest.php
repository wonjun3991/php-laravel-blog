<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'user_id' => ['required', 'int']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id
        ]);
    }
}
