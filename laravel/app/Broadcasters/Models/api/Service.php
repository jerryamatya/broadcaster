<?php namespace Broadcasters\Models\api;

class Service extends \Broadcasters\Models\Service{
	
	public function getBroadcasterServices($id)
	{
		return $this->valid()->where("broadcaster_id","=",$id)->get();
	}

}