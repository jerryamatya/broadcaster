<?php namespace Broadcasters\Models;


class Service extends BaseModel{

	public function broadcasters()
	{
		return $this->belongsToMany('Broadcasters\Models\Broadasters','broadcasters_to_services');
	}

}
