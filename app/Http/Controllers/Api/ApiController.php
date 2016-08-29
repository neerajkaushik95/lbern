<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Stevenmaguire\Yelp\Client as Yelp;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ApiController extends Controller
{
    private $client;
    public function __construct()
    {
        /*$this->client = new YelpClient(array(
            'consumerKey' => 'rkG0rNS063_L0AhTQMjVuA',
            'consumerSecret' => '0UKWcwzXGnepWZa-Zkh842IinfA',
            'token' => 'gaqlWupY3xhqfQEvy6n0wuAJe8Qo304N',
            'tokenSecret' => 'ZS_QKtu4fhUh9BkKeiSEYrv6rlY',
            'apiHost' => 'http://api.yelp.com/v2/' // Optional, default 'api.yelp.com'
        ));*/
    }
    //get call for returning yelp data | @params : term , ll
    public function postDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'term' => 'required',
            'll' => 'required|regex:/^(\-?\d+(\.\d+)?),\s*(\-?\d+(\.\d+)?)$/',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $client = new Yelp(array(
            'consumerKey' => 'rkG0rNS063_L0AhTQMjVuA',
            'consumerSecret' => '0UKWcwzXGnepWZa-Zkh842IinfA',
            'token' => 'gaqlWupY3xhqfQEvy6n0wuAJe8Qo304N',
            'tokenSecret' => 'ZS_QKtu4fhUh9BkKeiSEYrv6rlY',
            'apiHost' => 'api.yelp.com' // Optional, default 'api.yelp.com'
        ));
        $results =  $client->search(array('term' => $request->get('term'), 'll' => $request->get('ll')));
        return response()->json($results);
    }
}
