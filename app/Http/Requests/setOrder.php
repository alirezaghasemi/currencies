<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class setOrder extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'required',
            'currency' => 'required|numeric',
            'transaction_volume' => 'required|numeric',
        ];
    }
}
