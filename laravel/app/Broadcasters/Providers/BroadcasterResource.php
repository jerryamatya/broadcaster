<?php namespace Broadcasters\Providers;

use Broadcasters\Providers\BroadcasterServiceProvider;


class BroadcasterResource extends BaseServiceProvider{
	protected $auth = null;
	protected $broadcasterServiceProvider;
	protected $servicesMap;
	function __construct(BroadcasterServiceProvider $broadcasterServiceProvider) {
		if(\Auth::check()){
			$this->auth = \Auth::user();
		}
		$this->broadcasterServiceProvider = $broadcasterServiceProvider;
		$this->servicesMap = [
			"news"=>"News Blog",
			"channel"=>"Live Tv",
			"vod"=>"Vod",
			"newsapp"=>"News App"
		];
	}

	public function hasService($model)
	{
		$services = $this->broadcasterServiceProvider->getBroadcasterServices();
		$has = false;
		foreach($services as $service):
				if($service->name==$this->servicesMap[$model]){
					$has = true;
				}
		endforeach;
		return $has;

	}
	public function canAccess($model,$param)
	{
		switch ($model) {
			case 'news':
				return $this->validateNews($param);
				break;
			case 'channel':
				return $this->validateChannel($param);
				break;
			case 'vod':
				return $this->validateVod($param);
				break;
			
			default:
				# code...
				break;
		}
	}

	public function validateNews($param)
	{
	if(in_array($param['id'], $this->auth->broadcaster->news()->lists('id')->all())){
			return true;
		}
		return false;
	}

	public function validateChannel($param)
	{
		if(in_array($param['id'], $this->auth->broadcaster->channels()->lists('id')->all())){
			return true;
		}
		return false;

	}
	public function validateVod($param)
	{
		//dd($this->auth->broadcaster->vods()->lists('id')->all());
		if(in_array($param['id'], $this->auth->broadcaster->vods()->lists('id')->all())){
			return true;
		}
		return false;

	}

}