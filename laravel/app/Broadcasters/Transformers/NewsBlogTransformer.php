<?php
namespace Broadcasters\Transformers;


class NewsBlogTransformer extends Transformer
{

	public  function transform($model){
		return [
			'title'=>$model['title'],
			'excerpt'=>$model['excerpt'],
			'body'=>$model['body'],
			'img'=>asset(\Config::get('site.newsBlogPath').$model['img'])
		];
	}

}