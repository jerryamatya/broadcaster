<?php namespace App\Http\Controllers\api\v1;

use Broadcasters\Providers\EpgServiceProvider as Epg;


class EpgController extends \App\Http\Controllers\api\ApiController {

	protected $transformer;
	protected $epg;

	function __construct(\Broadcasters\Transformers\EpgTransformer $transformer, Epg $epg) {
		$this->transformer = $transformer;
		$this->epg = $epg;

	}


	public function getByChannel($channelId)
	{
		$epg = $this->epg->getByChannel($channelId);
		if(!$epg){
			return $this->respondNotFound('Epg not found.');
		}
		return $this->respond([
				'data'=>$this->transformer->transform($epg)
		]);
	}
	

}
