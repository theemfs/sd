<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Mail;
use Storage;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		Commands\Inspire::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{

		// $tasks = Tasks::where('round_id', $id)->orderBy('id', 'desc')->get();
		// foreach ($tasks as $task) {
		// 	$task->updateStatus();
		// }

		//$schedule->exec('touch /var/www/crm2.in-time.cc/public/test.txt');
		$schedule->exec('ls -la /dev/ttyUSB*');
		// $schedule->command('laracasts:daily-report');
		//$schedule->command('inspire')->hourly();

		// $schedule->call( function() {
		// 	Mail::send('emails.emails', ['text' => 'view'], function($message){
		// 		$message->to('anton@grandbaikal.ru', 'John Doe')->subject('Test');
		// 	});
		// });

	}
}
