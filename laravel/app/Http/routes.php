<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
\Event::listen('illuminate.query',function($sql){
});

Route::get('/', ['as'=>'home',function(){
}]);

Route::get('test', ['as'=>'home',function(){
	return $data = unserialize(file_get_contents("test.txt"));
}]);


Route::get('admin/login', ['as'=>'adminLogin','uses'=>'Auth\AuthController@getAdminLogin']);
Route::post('admin/login', ['as'=>'postAdminLogin','uses'=>'Auth\AuthController@postAdminLogin']);

Route::group(['prefix'=>'admin','before'=>'csrf','middleware'=>'auth'], function()
{

	Route::get('/', ['as'=>'adminHome','uses'=>'admin\AdminController@index']);
	Route::get('broadcaster', ['as'=>'broadcasterList','uses'=>'admin\BroadcasterController@index']);
	Route::get('broadcaster/create', ['as'=>'broadcasterNew','uses'=>'admin\BroadcasterController@create']);
	Route::post('broadcaster/store', ['as'=>'broadcasterStore','uses'=>'admin\BroadcasterController@store']);
	Route::get('broadcaster/{id}/edit', ['as'=>'broadcasterEdit','uses'=>'admin\BroadcasterController@edit']);
	Route::post('broadcaster/{id}/update', ['as'=>'broadcasterUpdate','uses'=>'admin\BroadcasterController@update']);
	Route::get('broadcaster/{id}/account', ['as'=>'broadcasterAccount','uses'=>'admin\BroadcasterController@getAccount']);
	Route::post('broadcaster/{id}/account/store', ['as'=>'broadcasterAccountStore','uses'=>'admin\BroadcasterController@storeAccount']);
	Route::post('broadcaster/{id}/account/update', ['as'=>'broadcasterAccountUpdate','uses'=>'admin\BroadcasterController@updateAccount']);

	Route::get('broadcaster/{id}/config', ['as'=>'broadcasterConfig','uses'=>'admin\BroadcasterController@getConfig']);
	Route::post('broadcaster/{id}/config/store', ['as'=>'broadcasterConfigStore','uses'=>'admin\BroadcasterController@storeConfig']);
	Route::post('broadcaster/{configid}/config/update', ['as'=>'broadcasterConfigUpdate','uses'=>'admin\BroadcasterController@updateConfig']);



	Route::group(['prefix'=>'services'], function(){
		Route::get('channel', ['as'=>'channelList','uses'=>'admin\ChannelController@index']);
		Route::get('channel/create', ['as'=>'channelNew','uses'=>'admin\ChannelController@create']);
		Route::get('channel/{id}', ['as'=>'channelShow','uses'=>'admin\ChannelController@show']);
		Route::get('channel/{id}/edit', ['as'=>'channelEdit','uses'=>'admin\ChannelController@edit']);
		Route::post('channel/store', ['as'=>'channelStore','uses'=>'admin\ChannelController@store']);
		Route::post('channel/{id}/update', ['as'=>'channelUpdate','uses'=>'admin\ChannelController@update']);
		Route::get('channel/{id}/epg/manage', ['as'=>'channelEpgManage','uses'=>'admin\EpgController@manage']);
		Route::get('channel/{id}/epg/create', ['as'=>'channelEpgCreate','uses'=>'admin\EpgController@create']);
		Route::post('channel/{id}/epg/store', ['as'=>'channelEpgStore','uses'=>'admin\EpgController@store']);
		Route::post('epg/{id}/save', ['as'=>'epgUpdate','uses'=>'admin\EpgController@update']);

		Route::get('vod', ['as'=>'vodList','uses'=>'admin\VodController@index']);
		Route::get('vod/create', ['as'=>'vodNew','uses'=>'admin\VodController@create']);
		Route::post('vod/store', ['as'=>'vodStore','uses'=>'admin\VodController@store']);
		Route::get('vod/{id}/edit', ['as'=>'vodEdit','uses'=>'admin\VodController@edit']);
		Route::post('vod/{id}/update', ['as'=>'vodUpdate','uses'=>'admin\VodController@update']);
		Route::post('vod/{id}/delete', ['as'=>'vodDelete','uses'=>'admin\VodController@delete']);

		Route::get('newsapp', ['as'=>'newsappList','uses'=>'admin\NewsappController@index']);
		Route::get('newsapp/create', ['as'=>'newsappNew','uses'=>'admin\NewsappController@create']);
		Route::get('newsapp/{id}/edit', ['as'=>'newsappEdit','uses'=>'admin\NewsappController@edit']);
		Route::post('newsapp/store', ['as'=>'newsappStore','uses'=>'admin\NewsappController@store']);
		Route::post('newsapp/{id}/update', ['as'=>'newsappUpdate','uses'=>'admin\NewsappController@update']);
		Route::get('newsapp/{id}/managesources', ['as'=>'newsappManageSources','uses'=>'admin\NewsappController@manageSources']);
		Route::post('newsapp/{id}/savesources', ['as'=>'newsappSaveSources','uses'=>'admin\NewsappController@saveSources']);
		Route::get('newsapp/{id}/changestatus', ['as'=>'newsappChangeStatus','uses'=>'admin\NewsappController@changeStatus']);
		Route::get('newsapp/{id}/delete', ['as'=>'newsappDelete','uses'=>'admin\NewsappController@delete']);

		Route::get('channel/{id}/config', ['as'=>'channelConfig','uses'=>'admin\ChannelController@getConfig']);
		Route::post('channel/{id}/config/store', ['as'=>'channelConfigStore','uses'=>'admin\ChannelController@storeConfig']);
		Route::post('channel/{configid}/config/update', ['as'=>'channelConfigUpdate','uses'=>'admin\ChannelController@updateConfig']);
	});
});


//broadcaster
	Route::get('broadcaster/register', ['as'=>'registerBroadcaster','uses'=>'Auth\AuthController@getRegister']);
	Route::post('broadcaster/register', ['as'=>'postRegisterBroadcaster','uses'=>'Auth\AuthController@postRegister']);
	Route::get('broadcaster/login', ['as'=>'broadcasterLogin','uses'=>'Auth\AuthController@getLogin']);
	Route::post('broadcaster/login', ['as'=>'postLoginBroadcaster','uses'=>'Auth\AuthController@postLogin']);
Route::group(['prefix'=>'broadcaster','middleware'=>['authBroadcaster','authBroadcasterResource']], function()
{
	Route::get('/', ['as'=>'broadcasterHome','uses'=>'broadcaster\HomeController@index']);
	Route::get('profile', ['as'=>'broadcasterProfile','uses'=>'broadcaster\ProfileController@get']);
	Route::post('profile', ['as'=>'broadcasterProfileUpdate','uses'=>'broadcaster\ProfileController@update']);

	Route::group(['prefix'=>'services','before'=>'csrf'], function(){
		Route::get('news', ['as'=>'newsList','uses'=>'broadcaster\NewsblogController@index']);
		Route::get('news/create', ['as'=>'newsNew','uses'=>'broadcaster\NewsblogController@create']);
		Route::get('news/{id}', ['as'=>'newsShow','uses'=>'broadcaster\NewsblogController@show']);
		Route::get('news/{id}/edit', ['as'=>'newsEdit','uses'=>'broadcaster\NewsblogController@edit']);
		Route::post('news/store', ['as'=>'newsStore','uses'=>'broadcaster\NewsblogController@store']);
		Route::post('news/{id}/update', ['as'=>'newsUpdate','uses'=>'broadcaster\NewsblogController@update']);		
		Route::post('news/{id}/delete', ['as'=>'newsDelete','uses'=>'broadcaster\NewsblogController@delete']);

		Route::get('channel', ['as'=>'bchannelList','uses'=>'broadcaster\ChannelController@index']);
		Route::get('channel/{id}', ['as'=>'bchannelShow','uses'=>'broadcaster\ChannelController@show']);
		Route::get('channel/{id}/edit', ['as'=>'bchannelEdit','uses'=>'broadcaster\ChannelController@edit']);
		Route::post('channel/store', ['as'=>'bchannelStore','uses'=>'broadcaster\ChannelController@store']);
		Route::post('channel/{id}/update', ['as'=>'bchannelUpdate','uses'=>'broadcaster\ChannelController@update']);
		Route::get('channel/{id}/epg/manage', ['as'=>'bchannelEpgManage','uses'=>'broadcaster\EpgController@manage']);
		Route::get('channel/{id}/epg/create', ['as'=>'bchannelEpgCreate','uses'=>'broadcaster\EpgController@create']);
		Route::post('channel/{id}/epg/store', ['as'=>'bchannelEpgStore','uses'=>'broadcaster\EpgController@store']);
		Route::post('epg/{id}/save', ['as'=>'bepgUpdate','uses'=>'broadcaster\EpgController@update']);

		Route::get('vod', ['as'=>'bvodList','uses'=>'broadcaster\VodController@index']);
		Route::get('vod/{id}/edit', ['as'=>'bvodEdit','uses'=>'broadcaster\VodController@edit']);
		Route::post('vod/{id}/update', ['as'=>'bvodUpdate','uses'=>'broadcaster\VodController@update']);

		
	});

});

Route::get('auth/logout', ['as'=>'logout','uses'=>'Auth\AuthController@getLogout']);


//Route for api
Route::group(['prefix'=>'api/v1'],function(){
	Route::get('broadcasters/{id}/channels','api\v1\LiveTvController@getBroadcasterChannels');
	Route::get('broadcasters/{id}/services','api\v1\BroadcastersController@services');
	Route::get('broadcasters/{id}/newsappapisources','api\v1\BroadcastersController@newsappsources');
	Route::get('channels/{id}','api\v1\LiveTvController@view');
	Route::get('channels/{id}/epgprograms','api\v1\EpgController@getByChannel');
	
	Route::get('epg/{id}','api\v1\EpgController@getByChannel');
	
	Route::get('broadcasters/{id}/news/{limit}','api\v1\NewsBlogController@getBroadcasterNews');
	Route::get('broadcasters/{id}/services/vod','api\v1\VodController@getBroadcasterVod');

	Route::get('broadcasters/{id}/data','api\v1\BroadcastersController@getData');

});

//test changes 1
