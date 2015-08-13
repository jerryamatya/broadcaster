<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\NotificationsServiceProvider as Provider;
use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;

use App\Http\Requests\CreateNotificationsRequest;
use App\Http\Requests\CreateNotificationsConfigRequest;


class NotificationsController extends MyBaseController {
	protected $broadcasterServiceProvider;
	protected $provider;
	function __construct(Provider $provider, BroadcasterServiceProvider $broadcasterServiceProvider) {
		$this->provider = $provider;
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
	}
	public function index()
	{
		$broadcasters = $this->broadcasterServiceProvider->getAll(true);
				//dd($broadcasters);

		//dd($broadcasters->lists('display_name','id'));
		$data = [
			'broadcasters'
		];
		return view('admin.notifications.index')->with(compact($data));
	}
	public function config()
	{
		$broadcasters = $this->broadcasterServiceProvider->getAll(true);
		$data = [
			'broadcasters'
		];
		return view('admin.notifications.config')->with(compact($data));

	}
	public function configstore(CreateNotificationsConfigRequest $request)
	{

	}
}
