<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'login' => 'sometimes|string|max:20',
            'password' => 'sometimes|string|max:40',
            'phone' => 'nullable|string|max:20',
        ];
    }
}
