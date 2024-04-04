<?php

namespace App\Http\Requests;

class SerialPasoRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|string|max:128',
            'app_env' => 'required|integer|in:0,1,2',
            'contract_server' => 'required|integer|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'app_env.in' => 'The app_env must be one of AWS, K5, or T2.',
            'contract_server.in' => 'The contract_server must be either app1 or app2.',
        ];
    }
}
