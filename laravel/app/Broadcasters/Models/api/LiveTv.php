<?php namespace Broadcasters\Models\api;

class LiveTv extends \Broadcasters\Models\LiveTv{

	public function get($id)
	{
		return $this->with('sources')->find($id);	
	}
	
}