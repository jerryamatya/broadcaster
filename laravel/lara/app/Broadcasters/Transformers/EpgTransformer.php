<?php
namespace Broadcasters\Transformers;


class EpgTransformer extends Transformer
{

	public  function transform($model){
		if(is_object($model)){
			$model = json_decode(json_encode($model), true);
		}
		$programs = $this->transformPrograms($model['schedule']);
		return [
		'details'=>$model['details'],
		'programs'=>$programs
		];
	}
	public function transformPrograms($schedule)
	{
		$schedule = unserialize($schedule);
		// $first = [];
		// $last = [];
		$data = [];
		//$today = ((int)date('N'))%7+1;

		$offset=5*60*60+45*60; //converting 5 hours to seconds.
  		$dateFormat="N";
  		$today=gmdate($dateFormat, time()+$offset)%7+1;
  		$data['day'] = $today;
  		$programs = $schedule[$today];
		foreach($programs['names'] as $i=>$name){
			$data['data'][] = [
				'name'=>$name,
				'start'=>$programs['starts'][$i],
				'end'=>$programs['ends'][$i]
				];
		}
		return $data;


		// foreach($schedule as $day=>$programs){
		// 	foreach($programs['names'] as $i=>$name){
		// 		$data[$day][] = [
		// 		'name'=>$name,
		// 		'start'=>$programs['starts'][$i],
		// 		'end'=>$programs['ends'][$i]
		// 		];
		// 	}
		// 	if($today>$day){
		// 		$last = $data;
		// 		continue;
		// 	}
		// 	$first = $data;
		// }
		// return $first+$last;
	}


}