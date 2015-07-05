<<<<<<< HEAD
<?php namespace Broadcasters\Models\api;

class Service extends \Broadcasters\Models\Service{
	
	public function getBroadcasterServices($id)
	{
		return $this->valid()->where("broadcaster_id","=",$id)->get();
	}

=======
<?php namespace Broadcasters\Models\api;

class Service extends \Broadcasters\Models\Service{
	
	public function getBroadcasterServices($id)
	{
		return $this->valid()->where("broadcaster_id","=",$id)->get();
	}

>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}