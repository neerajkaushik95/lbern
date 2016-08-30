<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class YelpBusinessRequest extends Request
{
    public function authorize()
    {
        return True;
    }

    public function wantsJson()
    {
        return True;
    }

    public function rules()
    {
        return [
            'business_id'=>'required'
        ];
    }
}
