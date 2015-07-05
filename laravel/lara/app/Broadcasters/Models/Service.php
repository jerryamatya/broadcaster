<<<<<<< HEAD
<?php namespace Broadcasters\Models;


class Service extends BaseModel{

	public function broadcasters()
	{
		return $this->belongsToMany('Broadcasters\Models\Broadasters','broadcasters_to_services');
	}

}
=======
<?php namespace Broadcasters\Models;


class Service extends BaseModel{

	public function broadcasters()
	{
		return $this->belongsToMany('Broadcasters\Models\Broadasters','broadcasters_to_services');
	}

}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
