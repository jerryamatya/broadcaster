<<<<<<< HEAD
<?php namespace App\Http\Controllers\broadcaster;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\EpgServiceProvider as Service;
use App\Http\Requests\CreateEpgRequest;

class EpgController extends MyBaseController {

	protected $service;
	public function __construct(Service $service)
	{
		$this->service = $service;
	}


	public function manage($channelId)
	{
		$epg = $this->service->getChannelEpg($channelId);
		return view('broadcaster.epg.manage')->with(compact('epg','channelId'));
	}
	public function create($channelId)
	{
		return view('broadcaster.epg.create')->with('channelId',$channelId);
	}

	public function store($channelId, CreateEpgRequest $request)
	{
		$this->service->create($channelId, $request);
		return \Redirect::route('bchannelEpgManage',$channelId)->withSuccess("New epg created");
	}
	public function update($id, CreateEpgRequest $request)
	{
		$this->service->save($id, $request);
		return \Redirect::route('bchannelList')->withSuccess("Epg updated");
	}
}
=======
<?php namespace App\Http\Controllers\broadcaster;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\EpgServiceProvider as Service;
use App\Http\Requests\CreateEpgRequest;

class EpgController extends MyBaseController {

	protected $service;
	public function __construct(Service $service)
	{
		$this->service = $service;
	}


	public function manage($channelId)
	{
		$epg = $this->service->getChannelEpg($channelId);
		return view('broadcaster.epg.manage')->with(compact('epg','channelId'));
	}
	public function create($channelId)
	{
		return view('broadcaster.epg.create')->with('channelId',$channelId);
	}

	public function store($channelId, CreateEpgRequest $request)
	{
		$this->service->create($channelId, $request);
		return \Redirect::route('bchannelEpgManage',$channelId)->withSuccess("New epg created");
	}
	public function update($id, CreateEpgRequest $request)
	{
		$this->service->save($id, $request);
		return \Redirect::route('bchannelList')->withSuccess("Epg updated");
	}
}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
