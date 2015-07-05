<<<<<<< HEAD
<?php namespace Broadcasters\Models\api;

class LiveTv extends \Broadcasters\Models\LiveTv{

	public function get($id)
	{
		return $this->with('sources')->find($id);	
	}
	
=======
<?php namespace Broadcasters\Models\api;

class LiveTv extends \Broadcasters\Models\LiveTv{

	public function get($id)
	{
		return $this->with('sources')->find($id);	
	}
	
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}