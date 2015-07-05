<?php namespace App\Http\Controllers\api;

class ApiController extends \App\Http\Controllers\MyBaseController {

	protected $statusCode=200;

	public function setStatusCode($statusCode)
	{
	 $this->statusCode = $statusCode;
	 return $this;
	}

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function respondNotFound($msg="Not Found")
	{
		return $this->setStatusCode('400')->respondWithError($msg);
	}


	public function respond($data, $headers=[])
	{
		return \Response::json($data,$this->getStatusCode(),$headers);
	}
	
	public function respondWithError($msg)
	{
		return $this->respond([
				'error'=>[
					'message'=>$msg,
					'status_code'=>$this->getStatusCode()
				]
			]);
	}
	public function notFoundMessage($msg="Not Found")
	{
			
		return	[
				'error'=>[
					'message'=>$msg,
					'status_code'=>'400'
				]
			];
	}


}
