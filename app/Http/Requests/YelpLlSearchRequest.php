<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class YelpLlSearchRequest extends Request
{
    public function authorize()
    {
        return True;
    }

    public function rules()
    {
        return [
            'term' => 'required',
            'll' => 'required|regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/',
        ];
    }
}
