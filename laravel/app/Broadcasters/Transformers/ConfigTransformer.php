<?php
namespace Broadcasters\Transformers;


class ConfigTransformer extends Transformer
{
	protected $platform;

	public  function transform($model){
		if(!$model || !$this->platform)
			return null;
		$config = unserialize($model->value);
		return [
			'info'=>$model->info,
			'addcode'=>$config[$this->platform]['addcode']
		];
	}

	public function setPlatform($platform){
		$this->platform = $platform;
		return $this;
	}
}