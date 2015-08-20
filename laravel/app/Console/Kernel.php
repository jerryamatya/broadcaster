<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Parse\ParseClient as ParseClient;
use Parse\ParsePush as ParsePush;
use Parse\ParseInstallation;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
	'App\Console\Commands\Inspire',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
		->hourly();

		$notifications = [];
		$notifications[] = [
			'msg'=>"Coming up Himalaya Fatafat",
			'time'=>"11:58",
			'type'=>'live'
		];
		$notifications[] = [
			'msg'=>" Coming up Himalaya Prime News",
			'time'=>"18:58",
			'type'=>'live'
		];
		$notifications[] = [
			'msg'=>"Coming up Prime Story",
			'time'=>"19:28",
			'type'=>'live'
		];
		$notifications[] = [
			'msg'=>"Coming up Himalaya Fatafat",
			'time'=>"19:58",
			'type'=>'live'
		];
		$notifications[] = [
			'msg'=>"Coming up Prime Story at 5:30",
			'time'=>"17:27",
			'type'=>'live'
		];		
		foreach($notifications as $notification):
			$time = date("H:i", strtotime('-285 minutes', strtotime($notification['time'])));
			$schedule->call(function(){
				//sendNotification('test notification 1');
				ParseClient::initialize(
					'ZBGNVDDcZJdilnPVkxTrXOe8U0ToWZcfWAqRTupN',
					'bhtvPPoz8siyZO0RbS7sGYmvpusa8YubzxIi7Oa9',
					'd269BnkUvTv83AvbqFnKoRVb9gHRmMQDZht4kpuc'
					);
				$query = ParseInstallation::query();
				$query->containedIn('channels', ['','global']);
				//$types = ['live','latest','featured','popular','news'];
				$not_data =[];
				ParsePush::send(array(
					"where" => $query,
					"data" => array(
						"alert" => $notification['msg'],
						"nitv_b_typeId" => $notification['type'],
						"nitv_b_data"=>$not_data
						)
					));

				\Log::info(error_get_last ());
			})->dailyAt($time);
		endforeach;
	}
	
	function sendNotification($msg){
		ParseClient::initialize(
			'fPSUGZ0H5wm7UPgcEYQ3EImEgv3HuidGeFXFDDJw',
			'6VIhRzVVQN8oBsYjbZ2SYCmBzEqK4C499o4Q25KD',
			'c6akmuK1fHz8RcYuwn6bh5EhaXvqeeZdezc6xbpj'
			);					
		ParsePush::send(
			[
			'channel'=>['broadcast'],
			'data'     => ['alert' => $msg],
			]
			);
		\Log::info(error_get_last ());
	}

}
