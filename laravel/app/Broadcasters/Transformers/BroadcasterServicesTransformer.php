<?php
namespace Broadcasters\Transformers;


class BroadcasterServicesTransformer extends Transformer
{

	public  function transform($model){
		return [
			'id'=>$model['id'],
			'name'=>$model['name'],
		];
	}

}