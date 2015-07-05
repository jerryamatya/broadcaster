<<<<<<< HEAD
<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Country as Model;

class CountryServiceProvider {


	protected $model;
	public function __construct(Model $model)
	{
		$this->model = $model;
	}
	
	public function getList()
	{
		return $this->model->lists('name','id');
	}

=======
<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Country as Model;

class CountryServiceProvider {


	protected $model;
	public function __construct(Model $model)
	{
		$this->model = $model;
	}
	
	public function getList()
	{
		return $this->model->lists('name','id');
	}

>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}