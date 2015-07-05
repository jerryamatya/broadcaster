<<<<<<< HEAD
<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Broadcaster as BroadcasterModel;
use Broadcasters\Providers\ChannelServiceProvider as ChannelServiceProvider;
use Broadcasters\Providers\NewsappServiceProvider as NewsAppServiceProvider;
use Broadcasters\Providers\NewsBlogServiceProvider as NewsBlogServiceProvider;
use Broadcasters\Providers\VodServiceProvider as VodServiceProvider;

class BroadcasterDashboardServiceProvider {


	protected 	$broadcasterModel,
				$broadcaster,
				$channelServiceProvider,
				$newsAppServiceProvider,
				$newsBlogServiceProvider,
				$vodServiceProvider;
	
	public function __construct(
		BroadcasterModel $broadcasterModel,
		ChannelServiceProvider $channelServiceProvider,
		NewsAppServiceProvider $newsAppServiceProvider,
		NewsBlogServiceProvider $newsBlogServiceProvider,
		VodServiceProvider $vodServiceProvider
		)
	{
		$this->broadcasterModel = $broadcasterModel;
		$this->broadcaster = \Auth::check()?\Auth::user()->broadcaster:null;

		$this->channelServiceProvider = $channelServiceProvider;
		$this->newsAppServiceProvider = $newsAppServiceProvider;
		$this->newsBlogServiceProvider = $newsBlogServiceProvider;
		$this->vodServiceProvider = $vodServiceProvider;
	}

	public function getBroadcasterServices()
	{
		return $this->broadcasterModel->find($this->broadcaster->id)->services;
	}
	public function getBroadcasterServicesList()
	{
		$services = $this->getBroadcasterServices();
		$data=[];
		foreach($services as $service):
			switch ($service->name) {
				case 'Live Tv':
					$data[$service->id] = $this->channelServiceProvider->getBroadcasterRecentServicesByCount(2,$this->broadcaster->id,['sources']);	
					break;
				case 'News App':
					$data[$service->id] = $this->newsAppServiceProvider->getBroadcasterRecentServicesByCount(2,$this->broadcaster->id);	
					break;
				case 'News Blog':
					$data[$service->id] = $this->newsBlogServiceProvider->getBroadcasterRecentServicesByCount(5,$this->broadcaster->id);	
					break;
				case 'Vod':
					$data[$service->id] = $this->vodServiceProvider->getBroadcasterRecentServicesByCount(2,$this->broadcaster->id);	
					break;													
				default:
					# code...
					break;
			}
		endforeach;

		return $data;
	}
=======
<?php namespace Broadcasters\Providers;

use Broadcasters\Models\Broadcaster as BroadcasterModel;
use Broadcasters\Providers\ChannelServiceProvider as ChannelServiceProvider;
use Broadcasters\Providers\NewsappServiceProvider as NewsAppServiceProvider;
use Broadcasters\Providers\NewsBlogServiceProvider as NewsBlogServiceProvider;
use Broadcasters\Providers\VodServiceProvider as VodServiceProvider;

class BroadcasterDashboardServiceProvider {


	protected 	$broadcasterModel,
				$broadcaster,
				$channelServiceProvider,
				$newsAppServiceProvider,
				$newsBlogServiceProvider,
				$vodServiceProvider;
	
	public function __construct(
		BroadcasterModel $broadcasterModel,
		ChannelServiceProvider $channelServiceProvider,
		NewsAppServiceProvider $newsAppServiceProvider,
		NewsBlogServiceProvider $newsBlogServiceProvider,
		VodServiceProvider $vodServiceProvider
		)
	{
		$this->broadcasterModel = $broadcasterModel;
		$this->broadcaster = \Auth::check()?\Auth::user()->broadcaster:null;

		$this->channelServiceProvider = $channelServiceProvider;
		$this->newsAppServiceProvider = $newsAppServiceProvider;
		$this->newsBlogServiceProvider = $newsBlogServiceProvider;
		$this->vodServiceProvider = $vodServiceProvider;
	}

	public function getBroadcasterServices()
	{
		return $this->broadcasterModel->find($this->broadcaster->id)->services;
	}
	public function getBroadcasterServicesList()
	{
		$services = $this->getBroadcasterServices();
		$data=[];
		foreach($services as $service):
			switch ($service->name) {
				case 'Live Tv':
					$data[$service->id] = $this->channelServiceProvider->getBroadcasterRecentServicesByCount(2,$this->broadcaster->id,['sources']);	
					break;
				case 'News App':
					$data[$service->id] = $this->newsAppServiceProvider->getBroadcasterRecentServicesByCount(2,$this->broadcaster->id);	
					break;
				case 'News Blog':
					$data[$service->id] = $this->newsBlogServiceProvider->getBroadcasterRecentServicesByCount(5,$this->broadcaster->id);	
					break;
				case 'Vod':
					$data[$service->id] = $this->vodServiceProvider->getBroadcasterRecentServicesByCount(2,$this->broadcaster->id);	
					break;													
				default:
					# code...
					break;
			}
		endforeach;

		return $data;
	}
>>>>>>> 22be403ff560b2bebfd1c48a952bcdee7ef708da
}