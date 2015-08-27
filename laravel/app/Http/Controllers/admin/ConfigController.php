<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\ConfigServiceProvider as Provider;
use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;
use Broadcasters\Providers\ConfigServiceProvider as ConfigServiceProvider;
use Broadcasters\Providers\ChannelServiceProvider as ChannelServiceProvider;

use App\Http\Requests\CreateNotificationsRequest;
use App\Http\Requests\CreateChannelConfigRequest;


class ConfigController extends MyBaseController {
	protected $broadcasterServiceProvider;
	protected $provider;
	protected $channelServiceProvider;
	function __construct(
		Provider $provider, 
		BroadcasterServiceProvider $broadcasterServiceProvider, 
		ConfigServiceProvider $configServiceProvider,
		ChannelServiceProvider $channelServiceProvider
		) 
	{
		$this->provider = $provider;
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
		$this->configServiceProvider = $configServiceProvider;
		$this->channelServiceProvider = $channelServiceProvider;
	}
	public function channelconfig($id)
	{
		$channel = $this->channelServiceProvider->getById($id);
		$config = $this->provider->getByChannel($id);
		$configindexes = [
		'apiConfig'=>'channel_external_api',
		'parseKeysConfig'=>'channel_parse_keys'
		];
		$apiLabels = ["categories"=>"categories","category_news"=>"Category News","single_news"=>"Single News","epg"=>"EPG",'recent_news'=>"Recent News"];
		$parseKeysLabels = ["appKey"=>"Application Key","restKey"=>"Rest Key","masterKey"=>"Master Key",];
		$data = ['channel','apiLabels','parseKeysLabels'];
		foreach($configindexes as $k=>$v):
			$$k = $config->filter(function($obj) use ($v)
			{
				return $obj->key == $v;
			})->first();
		array_push($data, $k);
		endforeach;
		return view('admin.config.index')->with(compact($data));
	}
	public function channelconfigstore($id, CreateChannelConfigRequest $request){
		$this->provider->storeForChannel($id,$request);
		return redirect()->route('channelConfig',$id)->withSuccess('Config for channel saved');
	}

	public function config()
	{
		$broadcasters = $this->broadcasterServiceProvider->getAll(true);
		$data = [
		'broadcasters'
		];
		return view('admin.notifications.config')->with(compact($data));

	}
	public function store($id,CreateNotificationsConfigRequest $request)
	{
		$this->configServiceProvider->create($id,$request,'parse_keys_config');
		return redirect()->route('notificationsConfigList')->withSuccess('Notification Config Created');
	}
}
