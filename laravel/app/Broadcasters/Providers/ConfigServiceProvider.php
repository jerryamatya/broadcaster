<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Config as Model;

class ConfigServiceProvider extends BaseServiceProvider {

	public function __construct(Model $model)
	{
		$this->model = $model;
	}
	public function create($request, $key)
	{
		try {
			$value = serialize($request->get('config'));
			$this->model->key = $key;
			$this->model->value = $value;
			$this->model->object_id = $request->get('broadcaster_id');
			$this->model->save();
		}
		catch(\Exception $e){
			dd($e);
		}
		
	}
	public function updateConfig($id, $request)
	{
		$config = $this->model->findOrFail($id);
		try {
			$config->value = serialize($request->get('config'));
			$config = $config->save();
		}
		catch(\Exception $e){
			dd($e);
		}

	}

}