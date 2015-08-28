<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\NotificationsServiceProvider as Provider;
use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;
use Broadcasters\Providers\ConfigServiceProvider as ConfigServiceProvider;
use Broadcasters\Providers\ChannelServiceProvider as ChannelServiceProvider;

use App\Http\Requests\CreateNotificationsRequest;
use App\Http\Requests\CreateNotificationsConfigRequest;


class NotificationsController extends MyBaseController {
	protected $broadcasterServiceProvider;
	protected $provider;
	protected $configServiceProvider;
	protected $channelServiceProvider;
	function __construct(
		Provider $provider, 
		BroadcasterServiceProvider $broadcasterServiceProvider, 
		ConfigServiceProvider $ConfigServiceProvider, 
		ChannelServiceProvider $channelServiceProvider
	)
	{
		$this->provider = $provider;
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
		$this->configServiceProvider = $ConfigServiceProvider;
		$this->channelServiceProvider = $channelServiceProvider;
	}
	public function index()
	{
		$channels = $this->channelServiceProvider->all();
		return view('admin.notifications.index')->with(compact('channels'));
	}
	public function config()
	{
		$broadcasters = $this->broadcasterServiceProvider->getAll(true);
		$data = [
		'broadcasters'
		];
		return view('admin.notifications.config')->with(compact($data));

	}
	public function configstore($id,CreateNotificationsConfigRequest $request)
	{
		$this->configServiceProvider->create($id,$request,'parse_keys_config');
		return redirect()->route('notificationsConfigList')->withSuccess('Notification Config Created');
	}

	public function manage($channelId)
	{
		$channels = ($this->channelServiceProvider->getAllWithNotificationsAndConfig());
		return ($channels[2]->configs->first());
		$channel = $this->channelServiceProvider->getWithNotifications($channelId);
		return view('admin.notifications.manage')->with(compact('channel'));
	}
	public function save($id,CreateNotificationsRequest $request)
	{
		$this->provider->save($id,$request);
		return redirect()->route('channelNotificationManage',$id)->withSuccess('Notifications saved');
	}
}
