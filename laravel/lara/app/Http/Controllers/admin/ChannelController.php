<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\ChannelServiceProvider as Provider;
use Broadcasters\Providers\CountryServiceProvider as CountryServiceProvider;
use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;
use App\Http\Requests\CreateChannelRequest;
use App\Http\Requests\CreateConfigRequest;



class ChannelController extends MyBaseController {

	protected $channel, $countryServiceProider, $broadcasterServiceProvider;
	public function __construct(
								Provider $channel,
								CountryServiceProvider $countryServiceProvider,
								BroadcasterServiceProvider $broadcasterServiceProvider
								)
	{
		$this->channel = $channel;
		$this->countryServiceProvider = $countryServiceProvider;
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
	}


	public function index()
	{
		$data = $this->channel->getAll();
		return view('admin.channel.index')->with($data);
	}
	public function show($id)
	{
		$countries = $this->countryServiceProvider->getList();
		$broadcasters = $this->broadcasterServiceProvider->getList();
		$channel = $this->channel->getByIdWithData($id);
		return view('admin/channel/view',compact('channel','countries','broadcasters'));	
	}
	public function create()
	{
		$countries = $this->countryServiceProvider->getList();
		$broadcasters = $this->broadcasterServiceProvider->getList();

		return view('admin/channel/create',compact('countries','broadcasters'));
	}
	public function store(CreateChannelRequest $request)
	{
		$this->channel->save($request);
		return \Redirect::route('channelList')->withSuccess("New Channel added");

	}

	public function edit($id)
	{
		$countries = $this->countryServiceProvider->getList();
		$broadcasters = $this->broadcasterServiceProvider->getList();

		$channel = $this->channel->getById($id);
		return view('admin/channel/edit',compact('channel','countries','broadcasters'));	
	}
	public function update($id, CreateChannelRequest $request)
	{
		$this->channel->update($request, $id);
		return \Redirect::route('channelList')->withSuccess("Channel Updated");

	}

	public function getConfig($id)
	{
		$channel = $this->channel->getWithConfig($id);
		if($channel->count() && $channel->config)
			return view('admin.channel.updateconfig')->with(compact('channel'));
		return view('admin.channel.createconfig')->with(compact('channel'));
	}	
	public function storeConfig($id, CreateConfigRequest $request)
	{
		$this->channel->createConfig($id, $request);
		return redirect(route('channelList'))->withSuccess('Config Created');
	}
	public function updateConfig($configid, CreateConfigRequest $request)
	{
		$this->channel->updateConfig($configid, $request);
		return redirect(route('channelList'))->withSuccess('Config Updated');

	}		

}
