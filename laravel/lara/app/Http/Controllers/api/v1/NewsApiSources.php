<<<<<<< HEAD
<?php namespace App\Http\Controllers\api\v1;

use Broadcasters\Models\api\ApiSource as NewsApiSource;


class NewsApiSourcesController extends \App\Http\Controllers\api\ApiController {

	protected $transformer;
	protected $newsApiSourceModel;

	function __construct(Transformer $transformer, NewsApiSource $newsApiSourceModel) {
		$this->transformer = $transformer;
		$this->newsApiSourceModel = $newsApiSourceModel;

	}

	public function view($id)
	{
		$channel = $this->channel->get($id);
		if(!$channel){
			return $this->respondNotFound('Channel not found.');
		}
		return $this->respond([
			'data'=>$this->transformer->transform($channel)
		]);
	}
	

}
=======
<?php namespace App\Http\Controllers\api\v1;

use Broadcasters\Models\api\ApiSource as NewsApiSource;


class NewsApiSourcesController extends \App\Http\Controllers\api\ApiController {

	protected $transformer;
	protected $newsApiSourceModel;

	function __construct(Transformer $transformer, NewsApiSource $newsApiSourceModel) {
		$this->transformer = $transformer;
		$this->newsApiSourceModel = $newsApiSourceModel;

	}

	public function view($id)
	{
		$channel = $this->channel->get($id);
		if(!$channel){
			return $this->respondNotFound('Channel not found.');
		}
		return $this->respond([
			'data'=>$this->transformer->transform($channel)
		]);
	}
	

}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
