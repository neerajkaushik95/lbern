<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stevenmaguire\Yelp\Client as Yelp;
use App\Http\Requests\YelpLlSearchRequest;
use FoursquareApi;
use App\Http\Requests\FsLlsearchRequest;
use App\Http\Requests\YelpBusinessRequest;
use App\Http\Requests\FsVenueRequest;

class ApiController extends Controller
{
    private $yelpClient;
    private $fsClient;
    public function __construct()
    {
        $this->yelpClient = new Yelp(array(
            'consumerKey' => 'rkG0rNS063_L0AhTQMjVuA',
            'consumerSecret' => '0UKWcwzXGnepWZa-Zkh842IinfA',
            'token' => 'gaqlWupY3xhqfQEvy6n0wuAJe8Qo304N',
            'tokenSecret' => 'ZS_QKtu4fhUh9BkKeiSEYrv6rlY',
            'apiHost' => 'api.yelp.com' // Optional, default 'api.yelp.com'
        ));
        $this->fsClient = new FoursquareApi("RKZM3JHGF0NMY3JE01NYPAYAMQSRMAPJ5MU3GR4QGEH3WON4", "0Q0BKJ5BFZZK5MUN4JJHQHAQEBLRQROJNRYGJ4IXUXGKOLGH");
    }

    //get call for returning yelp data | @params : term , ll
    public function yelpLlSearchGet(YelpLlSearchRequest $request)
    {
        $results =  $this->yelpClient->search(array('term' => $request->get('term'), 'll' => $request->get('ll')));
        return response()->json($results);
    }

    //get call for yelp data by business id : @params : business id.
    public function yelpBusinessGet(YelpBusinessRequest $request)
    {
        $results = $this->yelpClient->getBusiness($request->get('business_id'));
        return response()->json($results);
    }

    //get call for searching foursquare data | @params: ll
    public function fsLlSearchGet(FsLlsearchRequest $request)
    {
        $endpoint = "venues/search";
        $response = json_decode($this->fsClient->GetPublic($endpoint,['ll' => $request->get('ll')]),true);
        return response()->json($response);
    }

    //get call for foursquare venue Details | @params : venue_id
    public function fsLlVenueGet(FsVenueRequest $request)
    {
        $response = json_decode($this->fsClient->GetPublic('venues/'.$request->get("venue_id")),true);
        return response()->json($response);
    }

    //get call for foursquare famous places : @params : ll
    public function placesGet(FsLlsearchRequest $request)
    {
        $response = json_decode($this->fsClient->GetPublic('venues/explore', ['ll' => $request->get('ll')]),True);
        $items = $response['response']['groups'][0]['items'];
        foreach($items as $item){
            $venue = $item['venue'];
            if(isset($venue['hours'])){
                $hour = $venue['hours'];
            }
            $venues[] = ['id' => $venue['id'],'name'=>$venue['name'], 'contact'=>$venue['contact'],
            'lat'=>$venue['location']['lat'], 'lng'=> $venue['location']['lng'], 'address'=>$venue['location']['formattedAddress'],
            'fs_stats'=>$venue['stats'], 'rating'=>$venue['rating'], 'hours' => $hour];
        }
        return response()->json($venues);
    }

}
