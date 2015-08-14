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
			$types = ['news'];
			foreach($types as $typeId):
			$not_data =[];
				if($typeId=="news"){
					$not_data = ['newsId'=>655];
				}
			ParsePush::send(array(
				"where" => $query,
				"data" => array(
					"alert" => "test with new notification for tab ".$typeId,
					"nitv_b_typeId" => $typeId,
					"nitv_b_data"=>$not_data
					)
				));
			endforeach;

			\Log::info(error_get_last ());
		})->daily();
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
