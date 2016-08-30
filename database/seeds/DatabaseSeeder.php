<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Types;
use App\Priorities;
use App\Statuses;
// use App\MessagesTypes;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call(UserTableSeeder::class);
		// DB::table('users')->truncate();
		// DB::table('roles')->truncate();
		// DB::table('tasks')->truncate();
		// DB::table('performers')->truncate();
		// DB::table('phones')->truncate();

		//User::create(['email' => 'admin@example.com', 'password'=>Hash::make('12'), 'name' => 'Admin']);//default user

		Priorities::create(['name' => 'наивысший', 	'color' => '#FF0000']);
		Priorities::create(['name' => 'высокий', 	'color' => '#F77777']);
		Priorities::create(['name' => 'обычный', 	'color' => '#F1C6C6']);
		Priorities::create(['name' => 'низкий', 	'color' => '#FFFFFF']);

		Types::create(['name' => 'event']);
		Types::create(['name' => 'event']);

		Statuses::create(['name' => 'новый', 	'color' => '#d9edf7']);
		Statuses::create(['name' => 'в работе', 'color' => '#ebcccc']);
		Statuses::create(['name' => 'ожидание', 'color' => '#fcf8e3']);
		Statuses::create(['name' => 'решён', 	'color' => '#dff0d8']);
		Statuses::create(['name' => 'закрыт', 	'color' => '#f7f7f9']);

		// MessagesTypes::create(['name' => 'reply']);
		// MessagesTypes::create(['name' => 'status']);
		// MessagesTypes::create(['name' => 'sms']);

		// Rounds::create(['name' => 'test']);
		// Roles::create(['name' => 'requestor']);
		// Roles::create(['name' => 'owner']);
		// Roles::create(['name' => 'watcher']);

		// factory(App\User::class, 10)->create();
		// factory(App\Groups::class, 5)->create();

		// factory(App\Performers::class, 5)->create()->each(function($u) {
		// 	$u->phones()->save(factory(App\Phones::class)->make());
		// });

		// $performer = App\Performers::create(['name' => 'Anton']);
		// 	$performer->phones()->create(['id'=>'89501240539']);
		// 	$performer->phones()->create(['id'=>'89140107762']);
		// $performer = App\Performers::create(['name' => 'Zuck']);
		// 	$performer->phones()->create(['id'=>'89501196183']);

		// $group1 = App\Groups::create(['name' => 'Group 1']);
		// $group2 = App\Groups::create(['name' => 'Group 2']);
		// $performer = App\Performers::create(['name' => 'Anton']);
		// 		$performer->groups()->sync($group1->toArray());
		// 		$performer->groups()->sync($group2->toArray());
		// 			$performer->phones()->create(['name'=>'89501240539']);
		// 			$performer->phones()->create(['name'=>'89140107762']);

		// 	$performer = App\Performers::create(['name' => 'John Doe']);
		// 		$performer->groups()->sync($group2->toArray());

		// $group3 = App\Groups::create(['name' => 'Group 3']);
		// 	$performer = App\Performers::create(['name' => 'Jeffrey Way']);
		// 	$performer = App\Performers::create(['name' => 'Zuck']);
		// 		$performer->groups()->sync($group3->toArray());
		// 			$performer->phones()->create(['name'=>'89501196183']);

		// App\Numbers::create(['id'=>'89501240539']);
		// App\Numbers::create(['id'=>'89501196183']);
		// App\Numbers::create(['id'=>'89140107762']);
		// dd($performer->phones());


		//$performer->phones()->create( App\Phones::create(['name'=>'89140107762']) );

		// factory(App\Groups::class, 50)->create();
		// factory(App\Tasks::class, 50)->create();
		// factory(App\Sendings::class, 50)->create();
		// factory(App\Numbers::class, 50)->create();

		// Gateways::create([
		// 	'name' => 'modem0',
		// 	'comment' => 'Megafon',
		// 	'url_status' => 'http://192.168.111.123:13000/status.xml',
		// 	'url_send' => 'http://192.168.111.123:13004/cgi-bin/sendsms',
		// 	'login' => 'cubie',
		// 	'password' => 'bar',
		// 	'sender' => '89501189819',
		// ]);

		//Performers::create(['name' => 'Performer 1'])->phones()->save(Phones::create(['name' => '89501240539']));

		// $p = Performers::find('1');
		// $ph = App\Phones::create(['name'=>'11111111111']);
		// $p->phones()->save($ph);
		//$ph->performers()->sync('1');

		// factory(App\Performers::class, 50)->create()->each(function($u) {
		// 	$u->posts()->save(factory(App\Phones::class)->make());
		// });

	}

}