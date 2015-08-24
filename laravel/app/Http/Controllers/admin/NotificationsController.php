<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\NotificationsServiceProvider as Provider;
use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;
use Broadcasters\Providers\ConfigServiceProvider as ConfigServiceProvider;

use App\Http\Requests\CreateNotificationsRequest;
use App\Http\Requests\CreateNotificationsConfigRequest;


class NotificationsController extends MyBaseController {
	protected $broadcasterServiceProvider;
	protected $provider;
	protected $configServiceProvider;
	function __construct(Provider $provider, BroadcasterServiceProvider $broadcasterServiceProvider, ConfigServiceProvider $ConfigServiceProvider) {
		$this->provider = $provider;
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
		$this->configServiceProvider = $ConfigServiceProvider;
	}
	public function index()
	{
		//$broadcasters = $this->broadcasterServiceProvider->get(true);
		$configs = $this->configServiceProvider->getByKey('parse_keys_config');
		$data = [
			'broadcasters'
		];
		return view('admin.notifications.manage')->with(compact($data));
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
}
