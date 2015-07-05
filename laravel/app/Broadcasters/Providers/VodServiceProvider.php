<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Vod as Model;

class VodServiceProvider extends BaseServiceProvider{


	protected $model;
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}
	public function getByBroadcaster($id)
	{
		return $this->model->where("broadcaster_id","=",$id)->firstOrFail();
	}
	public function getAll()
	{
		return $this->model->all();//include inactive
	}
	public function getAllWithBroadcaster($value='')
	{
		return $this->model->with('broadcaster')->get();//include inactive

	}
	public function getWithBroadcaster($id)
	{
		return $this->model->with('broadcaster')->find($id);
	}
	public function saveData($data)
	{
		try{

		return $this->model->create($data);
		//return \Redirect::action('BroadcastersController@index')->withSuccess("New Broadcaster added");	
		}
		catch(Exception $e){
			dd($e);
		}
	}

	public function save($request)
	{
		$broadcaster_id = $request->get('broadcaster_id');
		$cod = serialize($request->get('cod'));

		try{
			$this->model->create(compact('broadcaster_id','cod','validTime','urlTokenKey'));
		}
		catch(\Exception $e){

		}
	}

	public function update($id, $request)
	{
		$vod = $this->model->findOrFail($id);

		$vod->broadcaster_id = $request->get('broadcaster_id');
		$vod->cod = serialize($request->get('cod'));
		$vod->urlTokenKey = $request->get('urlTokenKey');
		$vod->validTime =  $request->get('validTime');
		try{
			$vod->save();
			
		}
		catch(\Exception $e){
			dd($e);
		}
	}

	public function delete($id)
	{
		$this->model->find($id)->delete();
	}
		public function getList()
	{
		return $this->model->lists('display_name','id');
	}

	public function getBroadcasterServices($id=null)
	{
		if(!$id && !\Auth::check()){
			return [];
		}

		if(!$id && \Auth::check()){
			if(\Auth::user()->broadcaster){
					$id = \Auth::user()->broadcaster->id;
			}
		}
		if($id)
			return $this->model->findOrFail($id)->services;
		return [];


	}


	/**
	 * methods for api response
	 */
	public function getBroadcasterVod($id)
	{
		return $this->model->where("broadcaster_id","=",$id)->first();

	}
	public function getChannels($id)
	{
		return $channels = $this->model->with(['channels'])->active()->find($id);
	}

	public function existsAndisValid($id){
		if($this->model->find($id)){
			return true;
		}
		return false;
	}
	public function getServices($id)
	{
		return $this->model->find($id)->services;
	}
	
	public function getNewsAppWithApiSources($id)
	{
		$broadcaster = $this->model->with('newsapps.sources')->find($id);
		$newsapps = [];
		foreach($broadcaster->newsapps as $newsapp ){
			$newsapps[] = $newsapp;
		}
		return $newsapps;
	}	

}