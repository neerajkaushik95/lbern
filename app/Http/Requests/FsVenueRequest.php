<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FsVenueRequest extends Request
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
            'venue_id' => 'required'
        ];
    }
}
