<?php namespace App\Http\Controllers\api\v1;

use Broadcasters\Providers\VodServiceProvider as Service;
use Broadcasters\ModelsVod as Model;

use Broadcasters\Transformers\VodTransformer as Transformer;


class VodController extends \App\Http\Controllers\api\ApiController {

	protected $transformer;
	protected $service;

	function __construct(
		 Transformer $transformer,
		Service $service) {
		$this->transformer = $transformer;
		$this->service = $service;

	}

	public function index()
	{
		$users = \App\User::all();
		return $this->respond([
				'data'=>$this->transformer->transformCollection($users->toArray())
			]);
	}

	public function show($id)
	{
		$user = \App\User::find($id);
		if(!$user){
			return $this->respondNotFound('User not found.');
		}
		return $this->respond([
				'data'=>$this->transformer->transform($user)
		]);
	}

	public function getChannels($id)
	{
		$channels = $this->broadcaster->getChannels($id);
		if(!$channels){
			return $this->respondNotFound('BroadCasters not found.');
		}
		return $this->respond([
			'data'=>$this->transformer->transform($channels)
		]);
	}

	public function services(Service $serviceModel, $id){
		try{
			if(!$this->broadcaster->existsAndisValid($id)){
				return $this->respondNotFound('BroadCasters not found.');
			}
			$services = $this->broadcaster->getServices($id);
			return $this->respond([
					'data'=>$this->servicesTransformer->transformCollection($services->toArray())
				]);

		}
		catch(\Exception $e){
			return $e->getMessage();
		}
		
	}
	public function newsappsources(ApiSource $apiSourceModel,
		NewsAppTransformer $thistransformer ,$id){
		try{
			if(!$this->broadcaster->existsAndisValid($id)){
				return $this->respondNotFound('BroadCasters not found.');
			}
			$newsAppApiSources = $this->broadcaster->getNewsAppWithApiSources($id);
			return $this->respond([
					'data'=>$thistransformer->transformCollection($newsAppApiSources)
				]);

		}
		catch(\Exception $e){
			return $e->getMessage();
		}		
	}
	public function getBroadcasterVod($id)
	{
		$vod = $this->service->getBroadcasterVod($id);
		if(!$vod){
			return $this->respondNotFound('Vod not found.');
		}
		return $this->respond([
			'data'=>$this->transformer->transform($vod)
		]);
	}
	

}
