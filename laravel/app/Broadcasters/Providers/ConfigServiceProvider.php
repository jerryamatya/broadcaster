<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Config as Model;

class ConfigServiceProvider extends BaseServiceProvider {

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function getByChannel($channelId)
	{
		return $this->model->where(['object_id'=>$channelId,'type'=>'channel'])->get();
	}
	public function create($object_id, $request, $key)
	{
		try {
			$value = serialize($request->get('config'));
			$this->model->key = $key;
			$this->model->value = $value;
			$this->model->object_id = $object_id;
			$this->model->save();
		}
		catch(\Exception $e){
			dd($e);
		}
		
	}
	public function storeForChannel($id, $request){
		foreach($request->get('config') as $key=>$value){
			$model = $this->model->where(['object_id'=>$id,'key'=>$key])->first();
			if(!$model)
			{
				$data['object_id'] = $id; 
				$data['key'] = $key;
				$data['type'] = 'channel';
				$data['value'] = serialize($value);
				$this->model->create($data);			
			}
			else{
				$model->value = serialize($value);
				$model->save();
			}
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