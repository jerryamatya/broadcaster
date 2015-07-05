<<<<<<< HEAD
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
=======
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
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}