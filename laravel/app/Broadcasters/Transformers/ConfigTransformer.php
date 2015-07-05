<?php
namespace Broadcasters\Transformers;


class ConfigTransformer extends Transformer
{

	public  function transform($model){
		return $config = $model?unserialize($model->value):null;
		//return [
		//	'config'=>$config
		//];
	}

}