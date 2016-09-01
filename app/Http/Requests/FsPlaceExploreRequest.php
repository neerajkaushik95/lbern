<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FsPlaceExploreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'll' => 'required',
            'section' => 'required'
        ];
    }
}
