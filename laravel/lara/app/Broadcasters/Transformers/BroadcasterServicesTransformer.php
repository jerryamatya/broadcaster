<<<<<<< HEAD
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

=======
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

>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}