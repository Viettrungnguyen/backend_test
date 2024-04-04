<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'login' => 'required|string|max:20',
            'password' => 'required|string|max:40',
            'phone' => 'nullable|string|max:20',
        ];
    }
}

