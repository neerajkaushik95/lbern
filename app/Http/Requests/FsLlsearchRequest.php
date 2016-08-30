<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FsLlsearchRequest extends Request
{
    public function authorize()
    {
        return True;
    }

    public function wantsJson()
    {
        return true;
    }

    public function rules()
    {
        return [
            'll' => 'required|regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/',
        ];
    }
}
