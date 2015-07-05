<<<<<<< HEAD
<?php namespace App\Http\Controllers\admin;

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
		$vods =  $this->service->getAllWithBroadcaster();
		return view('admin/vod/index')->with(compact('vods'));
	}
	public function create()
	{
		$broadcasters = $this->broadcasterServiceProvider->getList();
		return view('admin/vod/create')->with(compact('broadcasters'));
	}

	public function store(CreateVodRequest $request)
	{
		$this->service->save($request);

		return redirect()->route('vodList')->withSuccess('Vod Created');
	}
	public function edit($id)
	{
		$vod = $this->service->getWithBroadcaster($id);
		$broadcasters = $this->broadcasterServiceProvider->getList();
		return view('admin.vod.edit')->with(compact('vod','broadcasters'));
	}
	public function update($id, CreateVodRequest $request)
	{
		$this->service->update($id, $request);
		return redirect()->route('vodList')->withSuccess("Vod Updated");

	}
	public function delete($id)
	{
		$this->service->delete($id);
		return redirect()->route('vodList')->withSuccess("Vod Deleted");

	}
}
=======
<?php namespace App\Http\Controllers\admin;

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
		$vods =  $this->service->getAllWithBroadcaster();
		return view('admin/vod/index')->with(compact('vods'));
	}
	public function create()
	{
		$broadcasters = $this->broadcasterServiceProvider->getList();
		return view('admin/vod/create')->with(compact('broadcasters'));
	}

	public function store(CreateVodRequest $request)
	{
		$this->service->save($request);

		return redirect()->route('vodList')->withSuccess('Vod Created');
	}
	public function edit($id)
	{
		$vod = $this->service->getWithBroadcaster($id);
		$broadcasters = $this->broadcasterServiceProvider->getList();
		return view('admin.vod.edit')->with(compact('vod','broadcasters'));
	}
	public function update($id, CreateVodRequest $request)
	{
		$this->service->update($id, $request);
		return redirect()->route('vodList')->withSuccess("Vod Updated");

	}
	public function delete($id)
	{
		$this->service->delete($id);
		return redirect()->route('vodList')->withSuccess("Vod Deleted");

	}
}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
