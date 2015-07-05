<?php
namespace Broadcasters\Transformers;


class NewsAppTransformer extends Transformer
{

	public  function transform($model){
		return [
			'id'=>$model['id'],
			'name'=>$model['name'],
			'apisources'=>$this->transformCollection($model['sources']->toArray(),'transformApiSources'),
		];
	}

	public  function transformApiSources($model){
		return [
			'name'=>$model['name'],
			'value'=>$model['value'],
		];
	}
}