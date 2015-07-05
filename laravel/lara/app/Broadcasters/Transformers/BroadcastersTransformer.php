<?php
namespace Broadcasters\Transformers;


class BroadcastersTransformer extends Transformer
{

	public  function transform($model){
		return [
			'name'=>$model['name'],
			'email'=>$model['email'],
		];
	}

}