<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Broadcaster as Model;

class BroadcasterServiceProvider extends BaseServiceProvider{


	protected $model;
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function getById($id)
	{
		return $this->model->findOrFail($id);
	}
	public function getByIdWithServices($id)
	{
		return $this->model->with('services')->findOrFail($id);
	}	
	public function getAll($active = null)
	{
		if($active)
			return $this->model->active()->get();//include inactive
		return $this->model->all();//include inactive
	}
	public function getAllWithUsers()
	{
		return $this->model->with('user')->get();//include inactive
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
		$inputs = $request->all();
		if($request->hasFile('logo')){
			$file = $request->file('logo');
			$logo = time() . "-".$file->getClientOriginalName();
			$file->move(public_path().\Config::get('site.broadcasterLogoPath'),$logo);
				$inputs['logo'] = $logo;

		}
		try{

		$broadcaster = $this->model->create($inputs);
		$request->get('services');
		$broadcaster->services()->attach($request->get('services'));//add services to broadcaster
		//return \Redirect::action('BroadcastersController@index')->withSuccess("New Broadcaster added");	
		}
		catch(Exception $e){

		}
	}

	public function update($request, $id)
	{
		$broadcaster = $this->model->findOrFail($id);

		$broadcaster->display_name = $request->get('display_name');
		$broadcaster->company_name = $request->get('company_name');

		//update logo
		if($request->hasFile('logo')){
			$file = $request->file('logo');
			$logo = time() . "-".$file->getClientOriginalName();
			$file->move(public_path().\Config::get('site.broadcasterLogoPath'),$logo);
			
			//update live tv if logo is moved
			$broadcaster->logo = $logo;
			//delete previous logo		
		}
		
		try{
			$broadcaster->save();
		$broadcaster->services()->sync($request->get('services'));//add services to broadcaster
			
		}
		catch(\Exception $e){
			dd($e);
		}
	}

	public function createUser($broadcasterId, $request)
	{
		
		$success = false;
		\DB::beginTransaction();
		try {
			$email = $request->get('email');
			$name = $request->get('name');
			$password = \Hash::make($request->get('password'));

			$data = compact('email','name','password');

			$user = new \App\User();
			$user = $user->create($data);
			$broadcaster = $this->model->find($broadcasterId);
			$broadcaster->user_id = $user->id;
			$broadcaster->save();
			$success = true;
		}
		catch(\Exception $e){
			dd($e);
		}
		if ($success) {
			\DB::commit();
		} else {
			\DB::rollback();
		}
	}
	public function updateUser($id, $request)
	{
		$userModel = new \App\User();
		$user = $userModel->findOrFail($id);
		try {
			$user->name = $request->get('name');
			if($request->changepass)
				$user->password = \Hash::make($request->get('password'));
			$user = $user->save();
		}
		catch(\Exception $e){
			dd($e);
		}

	}	

	public function getWithUser($id)
	{
		return $this->model->with('user')->find($id);
	}
	public function getWithConfig($id)
	{
		return $this->model->with('config')->find($id);
	}
	
	public function createConfig($broadcasterId, $request)
	{
		try {
			$config = new \Broadcasters\Models\Config();
			$value = serialize($request->get('config'));
			$config->key = "broadcaster_config";
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

	public function getList()
	{
		return $this->model->lists('display_name','id')->all();
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