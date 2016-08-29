<?php

Route::get('/', function () {
    return view('welcome');
});
//Api Routes
//Route::get('test', 'TestController@testIndex');
Route::group(['prefix'=>'api', 'as' => 'api.'], function(){
    Route::post('search', 'Api\ApiController@postDetails');

});
