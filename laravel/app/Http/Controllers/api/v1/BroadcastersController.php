<?php namespace App\Http\Controllers\api\v1;

use Broadcasters\Providers\BroadCasterServiceProvider as Broadcasters;
use Broadcasters\Models\api\Service as Service;
use Broadcasters\Models\api\ApiSource as ApiSource;
use Broadcasters\Providers\ChannelServiceProvider as ChannelService;

use Broadcasters\Transformers\BroadcastersTransformer as BroadcastersTransformer;
use Broadcasters\Transformers\BroadcasterServicesTransformer as ServicesTransformer;
use Broadcasters\Transformers\NewsAppTransformer as NewsAppTransformer;


class BroadcastersController extends \App\Http\Controllers\api\ApiController {

	protected $transformer;
	protected $broadcaster;
	protected $channelService;
	protected $servicesTransformer;

	function __construct(
		 BroadcastersTransformer $transformer,
		Broadcasters $broadcaster,
		ServicesTransformer $servicesTransformer,
		ChannelService $channelService) {
		$this->transformer = $transformer;
		$this->servicesTransformer = $servicesTransformer;
		$this->broadcaster = $broadcaster;
		$this->channelService = $channelService;

	}

	public function index()
	{
		$users = \App\User::all();
		return $this->respond([
				'data'=>$this->transformer->transformCollection($users->toArray())
			]);
	}

	public function show($id)
	{
		$user = \App\User::find($id);
		if(!$user){
			return $this->respondNotFound('User not found.');
		}
		return $this->respond([
				'data'=>$this->transformer->transform($user)
		]);
	}

	public function getChannels($id)
	{
		$channels = $this->broadcaster->getChannels($id);
		if(!$channels){
			return $this->respondNotFound('BroadCasters not found.');
		}
		return $this->respond([
			'data'=>$this->transformer->transform($channels)
		]);
	}

	public function services(Service $serviceModel, $id){
		try{
			if(!$this->broadcaster->existsAndisValid($id)){
				return $this->respondNotFound('BroadCasters not found.');
			}
			$services = $this->broadcaster->getServices($id);
			return $this->respond([
					'data'=>$this->servicesTransformer->transformCollection($services->toArray())
				]);

		}
		catch(\Exception $e){
			return $e->getMessage();
		}
		
	}
	public function newsappsources(ApiSource $apiSourceModel,
		NewsAppTransformer $thistransformer ,$id){
		try{
			if(!$this->broadcaster->existsAndisValid($id)){
				return $this->respondNotFound('BroadCasters not found.');
			}
			$newsAppApiSources = $this->broadcaster->getNewsAppWithApiSources($id);
			return $this->respond([
					'data'=>$thistransformer->transformCollection($newsAppApiSources)
				]);

		}
		catch(\Exception $e){
			return $e->getMessage();
		}		
	}

	public function getData($id, 
		\Broadcasters\Providers\ChannelServiceProvider $channelService,
		\Broadcasters\Providers\VodServiceProvider $vodService
		)
	{
		$platform = \Request::get('platform');
		if($platform !="ios" && $platform !="android"){
			$configResponse = $this->notFoundMessage('No config for this platform.');
		}
		$broadcaster = $this->broadcaster->getWithConfig($id);
		if(!$broadcaster){
			$infoResponse =  $this->notFoundMessage('No data available.');
			$configResponse = null;
		}
		else{
			$infoResponse= $this->transformer->transform($broadcaster);
			$configTransformer = new \Broadcasters\Transformers\ConfigTransformer();
			$configResponse = $configTransformer->setPlatform($platform)->transform($broadcaster->config);	
		}


		$channels = $channelService->getByBroadcasterWithConfig($id);
		if(!$channels->count()){
			$channelResponse =  $this->notFoundMessage('No data available.');
		}
		else
		{
			$channelTransformer = new \Broadcasters\Transformers\ChannelTransformer();
			$channelResponse = $channelTransformer->transformCollection($channels->toArray());
		}
		$vod = $vodService->getBroadcasterVod($id);
		if(!$vod){
			$vodResponse =  $this->notFoundMessage('No data available.');

		}
		else
		{
			$vodTransformer = new \Broadcasters\Transformers\VodTransformer();
			$vodResponse = $vodTransformer->transform($vod);

		}

		$newsAppApiSources = $this->broadcaster->getNewsAppWithApiSources($id);

		if(!$newsAppApiSources){
			$newsAppApiResponse =  $this->notFoundMessage('No data available.');

		}
		else
		{
			$newsAppTransformer = new \Broadcasters\Transformers\NewsAppTransformer();
			$newsAppApiResponse = $newsAppTransformer->transformCollection($newsAppApiSources);

		}

		$response = [
			'info'=>$infoResponse,
			'config'=>$configResponse,
			"channels"=>$channelResponse,
			"vod"=>$vodResponse,
			"newsappapisources"=>$newsAppApiResponse
		];
			return $this->respond($response);	
	}
	

}
