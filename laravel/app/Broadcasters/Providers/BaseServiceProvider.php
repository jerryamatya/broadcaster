<?php namespace Broadcasters\Providers;


class BaseServiceProvider {
	public function getBroadcasterRecentServicesByCount($count = 5,$broadcaster=null,$with=[])
	{
		if($broadcaster!=null)
			return $this->model->take($count)->with($with)->active()->where('broadcaster_id','=',$broadcaster)->get();
		return $this->model->take($count)->with($with)->active()->get();
	}
}