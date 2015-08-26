<?php namespace Broadcasters\Providers;
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
	}

}