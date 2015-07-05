<<<<<<< HEAD
<?php namespace App\Http\Controllers\api\v1;

use Broadcasters\Providers\ChannelServiceProvider as Channel;


class LiveTvController extends \App\Http\Controllers\api\ApiController {

	protected $transformer;
	protected $channel;

	function __construct(\Broadcasters\Transformers\ChannelTransformer $transformer, Channel $channel) {
		$this->transformer = $transformer;
		$this->channel = $channel;

	}


	public function view($id)
	{
		$channel = $this->channel->api_get($id);
		if(!$channel){
			return $this->respondNotFound('Channel not found.');
		}
		return $this->respond([
			'data'=>$this->transformer->transform($channel)
		]);
	}
	public function epgPrograms($channelId)
	{
		$data = $this->channel->getEpgWithPrograms($channelId);

		if(!$data){
			return $this->respondNotFound('No data available.');
		}
		return $this->respond([
			'data'=>$this->transformer->transformEpgPrograms($data)
		]);
	}

	public function getBroadcasterChannels($id)
	{
		$data = $this->channel->getByBroadcaster($id);

		if(!$data->count()){
			return $this->respondNotFound('No data available.');
		}
		return $this->respond([
			'data'=>$this->transformer->transformCollection($data->toArray())
		]);
	}
}
=======
<?php namespace App\Http\Controllers\api\v1;

use Broadcasters\Providers\ChannelServiceProvider as Channel;


class LiveTvController extends \App\Http\Controllers\api\ApiController {

	protected $transformer;
	protected $channel;

	function __construct(\Broadcasters\Transformers\ChannelTransformer $transformer, Channel $channel) {
		$this->transformer = $transformer;
		$this->channel = $channel;

	}


	public function view($id)
	{
		$channel = $this->channel->api_get($id);
		if(!$channel){
			return $this->respondNotFound('Channel not found.');
		}
		return $this->respond([
			'data'=>$this->transformer->transform($channel)
		]);
	}
	public function epgPrograms($channelId)
	{
		$data = $this->channel->getEpgWithPrograms($channelId);

		if(!$data){
			return $this->respondNotFound('No data available.');
		}
		return $this->respond([
			'data'=>$this->transformer->transformEpgPrograms($data)
		]);
	}

	public function getBroadcasterChannels($id)
	{
		$data = $this->channel->getByBroadcaster($id);

		if(!$data->count()){
			return $this->respondNotFound('No data available.');
		}
		return $this->respond([
			'data'=>$this->transformer->transformCollection($data->toArray())
		]);
	}
}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
