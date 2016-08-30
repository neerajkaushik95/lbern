<?php

Route::get('/', function () {
    return view('welcome');
});
//Api Routes
//Route::get('test', 'TestController@testIndex');
Route::group(['prefix'=>'api', 'as' => 'api.'], function(){
    Route::get('yelp-search', 'Api\ApiController@yelpLlSearchGet');
    Route::get('yelp-business', 'Api\ApiController@yelpBusinessGet');
    Route::get('fs-search', 'Api\ApiController@fsLlSearchGet');
    Route::get('fs-venue', 'Api\ApiController@fsLlVenueGet');
    Route::get('places', 'Api\ApiController@placesGet');
});

Route::auth();

Route::get('/home', 'HomeController@index');
