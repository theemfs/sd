<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Performers;
use App\Gateways;
use App\Modems;
use App\Sendings;

use DB;
use SSH;
use Storage;

class GatewaysController extends Controller
{



	public function __construct()
	{
		//$this->middleware('auth');
	}



	public function index(Request $request)
	{
		// filered version
		$filter = trim($request->input('filter'));
		if (strlen($filter)==0) {
			$gateways = Gateways::paginate(10);
		} else {
			$gateways = Gateways::where('name', 'LIKE', '%'.$filter.'%')
				->paginate(10);
		}
		return view('gateways.index')
			->with('gateways', 				$gateways)
			->with('filter', 				$filter);
	}



	public function create()
	{
		return view('gateways.create');
	}



	public function store(Request $request)
	{
		Gateways::create($request->all());
		return redirect('gateways');
	}



	public function show($id)
	{

		$gateway 	= Gateways::findOrFail($id);
		$modems 	= Modems::all();

		foreach ($modems as $modem) {
			//$modem->updateStatus();
		}

		return view('gateways.show')
				->with('gateway',		$gateway)
				->with('modems',		$modems)
				// ->with('status',		$gateway->getStatus())
			;
	}



	public function edit($id)
	{
		$gateway 		= Gateways::findOrFail($id);
		return view('gateways.edit')
				->with('gateway',		$gateway)
			;
	}



	public function update(Request $request, $id)
	{
		$gateway = Gateways::findOrFail($id);
		$gateway->update($request->all());
		return redirect()->action('GatewaysController@show', [$id]);
	}



	public function destroy($id)
	{
		$gateway = Gateways::findOrFail($id);
		$gateway->delete();
		return redirect()->action('GatewaysController@index');
	}



	/**
	 * Refresh kanel.conf and Restart kannel server
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function restart($id)
	{

		session()->flash('flash_success', trans('app.Gateway restarted, modems recreated'));

		// get devices
		// $commands = ['/usr/bin/sudo -u root -p12 -S  bash /etc/sh/crm_get_devices.sh'];
		// SSH::run($commands, function($line)
		// {
		// 	// echo $line.PHP_EOL;
		// 	//dd($line);
		// });


		// prepare
		$gateway = Gateways::findOrFail($id);
		//$gw 	= DB::table('gateways')->where('id', 1)->get();
		$array 	= preg_split('/$\R?^/m', $gateway->devices);

		array_shift($array);
		array_shift($array);
		array_shift($array);

		// dd($array);

		DB::table('modems')->truncate();
		for ($i=0; $i<count($array); $i++) {

			$modem_port_number = $array[$i][strpos($array[$i], 'port0')-2];
			$modem_port_name = substr( $array[$i], strpos($array[$i],'ttyUSB'), strlen($array[$i])-strpos($array[$i],'ttyUSB') );
			$modem_id = substr( $array[$i], strpos($array[$i],'pci')+4, strpos($array[$i],'port')-strpos($array[$i],'pci')-7 );
			$login = substr( $array[$i], strpos($array[$i],'pci')+4, strpos($array[$i],'port')-strpos($array[$i],'pci')-7 );
			$modem_id = substr( $array[$i], strpos($array[$i],'pci')+4, strpos($array[$i],'port')-strpos($array[$i],'pci')-7 );

			$gateway = DB::table('modems')->insert([
				[
					'modem_id' 			=> $modem_id,
					'modem_port_number' => $modem_port_number,
					'modem_port_name' 	=> $modem_port_name,
				],
			]);
		}

		$modems = DB::select('SELECT * FROM (	SELECT * FROM modems ORDER BY modem_id, modem_port_number DESC ) aa GROUP BY modem_id');

		$i=0;

		DB::table('modems')->truncate();

// CONFIG CREATING
$result = '';

// sms-service SECTION
#get-url = http://127.0.0.1/receive.php?from=%p&text=%a&char=%C&code=%c&time=%T
$get_url = action('SpamsController@receive', ['','','','','','',''])."/%p/%P/%a/%C/%c/%T/%i";
$result = $result."

group = sms-service
keyword = default
catch-all = yes
get-url = $get_url
max-messages = 0
concatenation = true


";

// MODEMS && USERS SECTION
foreach ($modems as $modem) {

$modem->name = "modem$i";
//$modem->sender = "+79147991000";
$modem->login = "user$i";
$modem->password = "password$i";

$modem = Modems::create(get_object_vars($modem));
$modem->gateway_id = $id;
$modem->save();

$result = $result."
#MODEMS && USERS SECTION
#-----------------------------------

group = sendsms-user
username = user$i
password = password$i
user-allow-ip = 127.0.0.1
concatenation = true
max-messages = 20
forced-smsc = modem$i
default-smsc = modem$i


group = smsc
smsc-id = modem$i
smsc = at
modemtype = auto
device = /dev/$modem->modem_port_name
sms-center = $modem->sender
sim-buffering = true
allowed-smsc-id = modem$i

#-----------------------------------
";

$i++;
}

		$config = DB::table('gateways')->where('id', 1)->get()[0]->config;
		Storage::disk('local')->put('kannel.conf', $config.$result);

		//restart
		// $commands = ['/usr/bin/sudo -u root -p12 -S  bash /etc/sh/kannel_restart.sh'];
		//Storage::disk('local')->delete('kannel.conf');
		// SSH::run($commands, function($line){});

		$commands = ['/bin/sleep 10'];
		SSH::run($commands, function($line){});
		// $commands = ['/bin/ping 127.0.0.1 -c 10'];
		// SSH::run($commands, function($line){});

		return redirect()->action('GatewaysController@show', [$id]);
	} // public function restart($id)



	/**
	 * Send sms to selected modem
	 *
	 * @param  Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function send(Request $request)
	{

		$this->validate($request, ['to' => 'required|regex:/^89\d{9}$/', 'message'=>'required|min:1|max:60']);

		// get data
		$gateway 	= Gateways::findOrFail($request->gateway);
		$modem 		= Modems::findOrFail($request->modem);
		$url 		= $gateway->url_send;
		$smsc 		= $modem->name;
		// if username and password are same for all modems - use gateway fields user and password
			// $username 	= $gateway->login;
			// $password 	= $gateway->password;

		// if username and password are NOT same - use sendsms-user sections
		$username 	= $modem->login;
		$username 	= $modem->login;
		$password 	= $modem->password;
		$coding 	= 2;
		$to 		= $request->to;
		$message 	= urlencode(iconv("utf-8","ucs-2be",$request->message));

		// send
		$url 		= "$url?smsc=$smsc&username=$username&password=$password&coding=$coding&dlr-mask=7&to=$to&text=$message";
		$result 	= file_get_contents($url);

		// result
		//debug flash
		session()->flash('flash_success', 'Message: '.$message.' / Username: '.$smsc.' / Status message: '.$result.' / URL: '.$url);
		//session()->flash('flash_success', 'Message to '.$to.' was sended with status message: '.$result);
		session()->flash('to', $to);
		return redirect()->action('PagesController@send');

	} // public function send(Request $request)







	// public function send(Request $request)
	/**
	 * Check balance
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function checkbalance($id)
	{
		$modems = Modems::all();
		foreach ($modems as $modem) {
			$modem->getBalance();
		}

		session()->flash('flash_success', trans('balance refreshing'));
		//return
		//return redirect()->action('GatewaysController@show', [$id]);
		return redirect()->action('GatewaysController@show', [$id]);
	}



}