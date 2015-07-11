<?php namespace App\Http\Controllers\broadcaster;

use App\Http\Controllers\MyBaseController as MyBaseController;

use Broadcasters\Providers\ChannelServiceProvider as Provider;
use Broadcasters\Providers\CountryServiceProvider as CountryServiceProvider;
use Broadcasters\Providers\BroadcasterServiceProvider as BroadcasterServiceProvider;
use App\Http\Requests\CreateChannelRequest;


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
		$channels = $this->channel->getBroadcasterChannels();
				$countries = $this->countryServiceProvider->getList();

		return view('broadcaster.channel.index')->with(compact('channels','countries'));
	}
	public function show($id)
	{
		$countries = $this->countryServiceProvider->getList();
		$broadcasters = $this->broadcasterServiceProvider->getList();
		$channel = $this->channel->getByIdWithData($id);
		return view('broadcaster/channel/view',compact('channel','countries','broadcasters'));	
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
		return view('broadcaster/channel/edit',compact('channel','countries','broadcasters'));	
	}
	public function update($id, CreateChannelRequest $request)
	{
		$this->channel->bupdate($request, $id);
		return \Redirect::route('bchannelList')->withSuccess("Channel Updated");

	}



}
