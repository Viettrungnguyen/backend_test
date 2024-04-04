<?php

namespace App\Http\Requests;

class DeleteAccountRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:accounts,registerID'
        ];
    }
}
