<?php

namespace App\Http\Requests;

class UpdateAccountRequest extends BaseFormRequest
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
