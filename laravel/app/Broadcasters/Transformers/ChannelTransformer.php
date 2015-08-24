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

  		$configindexes = ['channel_external_api'=>'api'];
  		$channelconfig = [];
  		foreach($model['configs'] as $config){
  			if(array_key_exists($config['key'], $configindexes)){
  				$channelconfig[$configindexes[$config['key']]] = $config['value']; 
  			}
  		}
		 return ([
			'id'=>$model['id'],
			'name'=>$model['name'],
			'today'=>$today,
			'source'=>$model['local_source'].'?wmsAuthSign='.$wmsAuthSign,
			//'cdn_source'=>$model['cdn_source'].'?wmsAuthSign='.$wmsAuthSign,
			'epg'=>$model['epg']?$this->transformEpgPrograms($model['epg']):null,
		]+$channelconfig);
	}

	public function transformEpgPrograms($data)
	{
		$epgTransformer = new EpgTransformer();
		return $epgTransformer->transform($data);
	}

}