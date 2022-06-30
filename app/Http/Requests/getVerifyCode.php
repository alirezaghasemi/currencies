<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class getVerifyCode extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile' => 'required|numeric|digits:11'
        ];
    }

}
