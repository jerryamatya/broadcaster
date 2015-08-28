<?php namespace Broadcasters\Providers;
use Parse\ParseClient as ParseClient;
use Parse\ParsePush as ParsePush;
use Parse\ParseInstallation;
use Broadcasters\Models\Notification as Model;

class NotificationsServiceProvider extends BaseServiceProvider{
	protected $model;
	function __construct(Model $model) {
		$this->model = $model;
	}
	public function save($id,$request)
	{
		$notifications = $request->get('notifications');
		foreach($notifications as $notification):
			if($notification['id']):
				$model = $this->model->find($notification['id']);
			if(isset($notification['remove'])):
				$model->delete();
			continue;
			endif;
			$model->type = $notification['type'];
			$model->data = $notification['data'];
			$model->time = $notification['time'];
			$model->msg = $notification['msg'];
			$model->save();
			else:
				if(isset($notification['remove'])):
					continue;
				endif;				
				$data = $notification+['channel_id'=>$id];
				$this->model->create($data);				
				endif;
				endforeach;
		$key = \Config::get('site.cacheChannelsWithNotifications');				
		\Cache::forget($key);
	}

			public function notify($schedule,ChannelServiceProvider $channelService){
				$key = \Config::get('site.cacheChannelsWithNotifications');
				$channels = \Cache::get($key, function() use ($channelService){
					return $channelService->getAllWithNotificationsAndConfig();
				});
				foreach($channels as $channel):
					$parseConfig = $channel->configs->count()?$channel->configs->first():null;
				$notifications = $channel->notifications->count()?$channel->notifications:null;
				if($parseConfig==null || $notifications==null)
					continue;
				if(!$parseConfig->value['appKey'] ||!$parseConfig->value['restKey'] ||!$parseConfig->value['masterKey']):
					continue;
				endif;
				foreach($notifications as $notification):

					//dd($parseConfig);
					$time = date("H:i", strtotime('-345 minutes', strtotime($notification->time)));
				$schedule->call(function() use ($notification,$parseConfig){
				\Log::info('test');
				//sendNotification('test notification 1');
					ParseClient::initialize(
						$parseConfig->value['appKey'],
						$parseConfig->value['restKey'],
						$parseConfig->value['masterKey']
						);
					$query = ParseInstallation::query();
					$query->containedIn('channels', ['']);
				//$types = ['live','latest','featured','popular','news'];
					$not_data =[];
					ParsePush::send(array(
						"where" => $query,
						"data" => array(
							"alert" => $notification->msg,
							"nitv_b_typeId" => $notification->type,
							"nitv_b_data"=>$not_data
							)
						));

					\Log::info(error_get_last ());
				})->everyMinute();
				endforeach;
				endforeach;
			}

		}