<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

class TestController extends Controller
{
    public function testIndex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'term' => 'required',
            'll' => 'required|regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        echo 'ok';
    }
}
