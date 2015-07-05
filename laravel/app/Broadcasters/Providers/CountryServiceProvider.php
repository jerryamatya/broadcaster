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

}