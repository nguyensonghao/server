<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	echo 'This is admin Mazii';
});

Route::get('demo', function () {
	return View::make('demo');
});

// Excute import database sqlite to elasticsearch
Route::controller('import', 'ImportElasticController');

Route::get('import-example', 'ImportElasticController@importExample');

Route::get('import-jaen', 'ImportElasticController@importJaen');

Route::get('import-kanji', 'ImportElasticController@importKanji');

// Search
Route::controller('search', 'SearchController');

Route::post('api/example/{key}', 'SearchController@searchExample');

Route::post('api/kanji/{key}/{numberRecord}', 'SearchController@searchKanji');

Route::post('api/word/{key}', 'SearchController@searchJaen');

Route::get('test', 'SearchController@test');