<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Service as Model;

class ServicesServiceProvider {


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