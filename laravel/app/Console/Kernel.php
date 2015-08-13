<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Parse\ParseClient as ParseClient;
use Parse\ParsePush as ParsePush;

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
           'fPSUGZ0H5wm7UPgcEYQ3EImEgv3HuidGeFXFDDJw',
           '6VIhRzVVQN8oBsYjbZ2SYCmBzEqK4C499o4Q25KD',
           'c6akmuK1fHz8RcYuwn6bh5EhaXvqeeZdezc6xbpj'
        );					
		ParsePush::send(
            [
            'channels'=>['broadcast'],
            'data'     => ['alert' => 'test notification 1'],
            ]
        );
        \Log::info(error_get_last ());
		})->dailyAt('7:55');
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
