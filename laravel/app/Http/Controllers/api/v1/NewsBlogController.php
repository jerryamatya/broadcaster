<?php namespace App\Http\Controllers\api\v1;

use Broadcasters\Providers\NewsBlogServiceProvider as NewsBlog;


class NewsBlogController extends \App\Http\Controllers\api\ApiController {

	protected $transformer;
	protected $service;

	function __construct(\Broadcasters\Transformers\NewsBlogTransformer $transformer, NewsBlog $service) {
		$this->transformer = $transformer;
		$this->service = $service;

	}


	public function getBroadcasterNews($id, $limit)
	{
		$news= $this->service->getLimitedWithBroadcasterId($id,$limit);
		if(!$news->count()){
			return $this->respondNotFound('NewsBlog not found.');
		}
		return $this->respond([
				'data'=>$this->transformer->transformCollection($news->toArray())
			]);
		dd();
	}

}
