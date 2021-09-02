<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
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
