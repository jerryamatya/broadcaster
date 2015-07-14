<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\BroadcasterServiceProvider as Provider;
use Broadcasters\Providers\ServicesServiceProvider as ServicesServiceProvider;

use App\Http\Requests\CreateBroadcastersRequest;
use App\Http\Requests\UpdateBroadcastersRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateConfigRequest;


class BroadcasterController extends MyBaseController {


	protected 	$broadcaster,
				$servicesServiceProvider;

	public function __construct(Provider $broadcaster, ServicesServiceProvider $servicesServiceProvider)
	{
		$this->broadcaster = $broadcaster;
		$this->servicesServiceProvider = $servicesServiceProvider;
	}

	public function index()
	{
		$broadcasters = $this->broadcaster->getAllWithUsers();
		return view('admin.broadcaster.index')->with('broadcasters',$broadcasters);
	}
	public function create()
	{
		$services = $this->servicesServiceProvider->getList();
		return view('admin.broadcaster.create')->with(compact('services'));
	}
	public function store(CreateBroadcastersRequest $request)
	{
		$this->broadcaster->save($request);
		return \Redirect::route('broadcasterList')->withSuccess("Broadcaster Created");		
	}

	public function edit($id)
	{
		$services = $this->servicesServiceProvider->getList();		
		$broadcaster = $this->broadcaster->getByIdWithServices($id);
		return view('admin/broadcaster/edit',compact('broadcaster','services'));	
	}

	public function update($id, UpdateBroadcastersRequest $request)
	{
		$this->broadcaster->update($request, $id);

		return \Redirect::route('broadcasterList')->withSuccess("Broadcaster Updated");
	}

	public function getAccount($id)
	{
		$broadcaster = $this->broadcaster->getWithUser($id);
		return view('admin.broadcaster.account')->withBroadcaster($broadcaster);
	}

	public function storeAccount($id, CreateUserRequest $request)
	{
		$this->broadcaster->createUser($id, $request);
		return redirect(route('broadcasterList'))->withSuccess('Account Created');
	}
	public function updateAccount($id, UpdateUserRequest $request)
	{
		$this->broadcaster->updateUser($id, $request);
		return redirect(route('broadcasterList'))->withSuccess('Account Updated');

	}
	public function getConfig($id)
	{
		$broadcaster = $this->broadcaster->getWithConfig($id);
		if($broadcaster->count() && $broadcaster->config)
			return view('admin.broadcaster.updateconfig')->with(compact('broadcaster'));
		return view('admin.broadcaster.createconfig')->with(compact('broadcaster'));
	}
	public function storeConfig($id, CreateConfigRequest $request)
	{
		$this->broadcaster->createConfig($id, $request);
		return redirect(route('broadcasterList'))->withSuccess('Config Created');
	}
	public function updateConfig($configid, CreateConfigRequest $request)
	{
		$this->broadcaster->updateConfig($configid, $request);
		return redirect(route('broadcasterList'))->withSuccess('Config Updated');

	}	

}
