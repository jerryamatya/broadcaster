<?php namespace App\Http\Controllers\broadcaster;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\VodServiceProvider as Service;
use App\Http\Requests\CreateVodRequest;
use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;

class VodController extends MyBaseController {

	protected $service,$broadcasterServiceProvider;

	public function __construct(
		Service $service,
		BroadcasterServiceProvider $broadcasterServiceProvider
		)
	{
		$this->service = $service;
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
	}

	public function index()
	{
		$vod =  $this->service->getByBroadcaster();
		return view('broadcaster/vod/index')->with(compact('vod'));
	}
	public function edit($id)
	{
		$vod = $this->service->getWithBroadcaster($id);
		return view('broadcaster.vod.edit')->with(compact('vod'));
	}
	public function update($id, CreateVodRequest $request)
	{
		$this->service->bupdate($id, $request);
		return redirect()->route('bvodList')->withSuccess("Vod Updated");

	}
	public function delete($id)
	{
		$this->service->delete($id);
		return redirect()->route('bvodList')->withSuccess("Vod Deleted");

	}
}
