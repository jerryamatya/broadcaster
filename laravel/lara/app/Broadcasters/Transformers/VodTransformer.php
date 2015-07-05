<?php
namespace Broadcasters\Transformers;


class VodTransformer extends Transformer
{

	public  function transform($model){
		$cod = unserialize($model->cod);
		return [
			'channel'=>$cod['channel_id'],
			'featured_playlist'=>$cod['feat_playlist'],
			'count'=>$cod['count']
		];
	}

}