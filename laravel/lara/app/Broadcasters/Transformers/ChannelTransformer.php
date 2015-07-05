<?php
namespace Broadcasters\Transformers;
use Broadcasters\Transformers\EpgTransformer as EpgTransformer;

class ChannelTransformer extends Transformer
{
	public  function transform($model){
		$wmsAuthSign = getUrlSignature($model['urlTokenKey'],$model['validTime']);
		$offset=5*60*60+45*60; //converting 5 hours to seconds.
  		$dateFormat="N";
  		$today=gmdate($dateFormat, time()+$offset)%7+1;
		return [
			'id'=>$model['id'],
			'name'=>$model['name'],
			'today'=>$today,
			'source'=>$model['local_source'].'?wmsAuthSign='.$wmsAuthSign,
			//'cdn_source'=>$model['cdn_source'].'?wmsAuthSign='.$wmsAuthSign,
			'epg'=>$model['epg']?$this->transformEpgPrograms($model['epg']):null,
			'api'=>unserialize($model['config']['value'])
		];
	}

	public function transformEpgPrograms($data)
	{
		$epgTransformer = new EpgTransformer();
		return $epgTransformer->transform($data);
	}

}