<?php namespace App\Http\Controllers\admin;

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
		return view('admin.epg.manage')->with(compact('epg','channelId'));
	}
	public function create($channelId)
	{
		return view('admin.epg.create')->with('channelId',$channelId);
	}

	public function store($channelId, CreateEpgRequest $request)
	{
		$this->service->create($channelId, $request);
		return \Redirect::route('channelEpgManage',$channelId)->withSuccess("New epg created");
	}
	public function update($id, CreateEpgRequest $request)
	{
		$this->service->save($id, $request);
		return \Redirect::route('channelList')->withSuccess("Epg for this channel updated");
	}
}
