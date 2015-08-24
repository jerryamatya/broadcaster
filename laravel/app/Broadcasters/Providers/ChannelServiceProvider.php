<?php namespace Broadcasters\Providers;

use Broadcasters\Models\LiveTv as Model;
use Broadcasters\Models\Country as CountryModel;

class ChannelServiceProvider extends BaseServiceProvider {


	protected $model,$countryModel, $countries;
	use AuthTrait;
	public function __construct(Model $model, CountryModel $countryModel)
	{
		self::getAuth();
		$this->model = $model;
		$this->countryModel = $countryModel;
		$this->countries = $this->countryModel->lists('name','id');
	}

	public function getAll(){
		$channels = $this->model->all();
		return [
		'countries'=>$this->countries,
		'channels'=>$channels
		];
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}
	public function getWithConfig($channelId){
		return $this->model->with('config')->where('object_id','=',$channelId)->get();
	}

	public function getByIdWithData($id)
	{
		return $this->model->with(['country','broadcaster'])->where('id',$id)->first();
	}

	public function save($request)
	{
		$inputs = $request->all();

		if($request->hasFile('logo')){
			$file = $request->file('logo');
			$logo = time() . "-".$file->getClientOriginalName();
			$file->move(public_path().\Config::get('site.channelLogoPath'),$logo);
			$inputs['logo'] = $logo;
		}
		try{
		$this->model->create($inputs); // broadcaster is from view, if logged in broadcaster take his id

		}
		catch(\Exception $e){

		}
	}

	public function update($request, $id)
	{
		$channel = $this->model->findOrFail($id);

		$channel->name = $request->get('name');
		$channel->broadcaster_id = $request->get('broadcaster_id');
		$channel->details = $request->get('details');
		$channel->country_id = $request->get('country_id');
		$channel->language = $request->get('language');
		$channel->local_source = $request->get('local_source');
		$channel->cdn_source = $request->get('cdn_source');
		$channel->active = $request->get('active');
		$channel->urlTokenKey = $request->get('urlTokenKey');
		$channel->validTime = $request->get('validTime');

		//update logo
		if($request->hasFile('logo')){
			$file = $request->file('logo');
			$logo = time() . "-".$file->getClientOriginalName();
			$file->move(public_path().\Config::get('site.channelLogoPath'),$logo);
			
			//update live tv if logo is moved
			$channel->logo = $logo;
			//delete previous logo			
		}
		
		try{
			$channel->save();
		}
		catch(\Exception $e){
		}
	}

	public function bupdate($request, $id)
	{
		$channel = $this->model->findOrFail($id);

		$channel->name = $request->get('name');
		$channel->broadcaster_id = self::$broadcaster->id;
		$channel->details = $request->get('details');
		$channel->country_id = $request->get('country_id');
		$channel->language = $request->get('language');
		$channel->local_source = $request->get('local_source');
		$channel->cdn_source = $request->get('cdn_source');

		//update logo
		if($request->hasFile('logo')){
			$file = $request->file('logo');
			$logo = time() . "-".$file->getClientOriginalName();
			$file->move(public_path().\Config::get('site.channelLogoPath'),$logo);
			
			//update live tv if logo is moved
			$channel->logo = $logo;
			//delete previous logo			
		}
		
		try{
			$channel->save();
		}
		catch(\Exception $e){
		}
	}
	public function getBroadcasterChannels($broadcasterid = null)
	{
		if(!$broadcasterid && !\Auth::check()){
			return [];
		}
		if(!$broadcasterid){
			$broadcasterid = \Auth::user()->broadcaster->id;
		}
		return $this->model->active()->where('broadcaster_id','=',$broadcasterid)->get();
	}

	public function findWithEpg($id)
	{
		return $this->model->with('epg')->findOrFail($id);
	}
	//public function getWithConfig($id)
	//{
		//return $this->model->with('config')->find($id);
	//}
	public function createConfig($broadcasterId, $request)
	{
		try {
			$config = new \Broadcasters\Models\Config();
			$value = serialize($request->get('config'));
			$config->key = "channel_config";
			$config->value = $value;
			$config->object_id = $broadcasterId;
			$config->save();
		}
		catch(\Exception $e){
			dd($e);
		}
		
	}
	public function updateConfig($id, $request)
	{
					$configModel = new \Broadcasters\Models\Config();

		$config = $configModel->findOrFail($id);
		try {
			$config->value = serialize($request->get('config'));
			$config = $config->save();
		}
		catch(\Exception $e){
			dd($e);
		}

	}	

	/**
	 * api methods
	 */
	
	public function api_get($id)
	{
		return $this->model->find($id);
		
	}

	public function getEpgWithPrograms($channelId)
	{
		return $this->model->with(['epg'=>function($q){
			return $q->with(['programs'=>function($q){
				return $q->orderBy('day');
			}]);
		}])->find($channelId);
	}

	public function getByBroadcasterWithConfig($id)
	{
		return $this->model->with(['epg'=>function($q){
			return $q->active()->with(['programs'=>function($q){
				return $q->orderBy('day');
			}]);
		},'configs'=>function($q){
			return $q->where('type','=','channel');
		}])->active()->where('broadcaster_id','=',$id)->get();
	}


}