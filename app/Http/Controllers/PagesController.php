<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Gateways;
use App\Modems;
use App\Performers;
use App\Groups;
use App\User;
use Storage;
use SSH;
use DB;
use Adldap\Laravel\Facades\Adldap;

class PagesController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}



	 /**
	 * Show the application dashboard.
	 *
	 * @return Response
	 */
	public function about()
	{

		//$performers = DB::table('performers')->take(10)->get();
		$performers = Performers::all();
		$p = [];


		// dd ($performers);
		// return( $performers );

		// $performer = Performers::find(403);
		// $groups_ids = unserialize($performer->groups_old);
		// dd ($groups_ids);


		// foreach ($groups_ids as $group_id) {
		// 	array_push( $groups, Groups::find($group_id) );
		// }
		// dd ($groups);

		//dd ( unserialize($performer->groups_old) );

		// $i = 0;

		foreach ($performers as $performer) {
			//$i++;
			$groups = [];
			$groups_ids = unserialize($performer->groups_old);

			$performer->groups()->detach();

			if (!is_null($groups_ids)) {
				foreach ($groups_ids as $group_id) {
					$g = Groups::find($group_id);
					array_push( $groups, $g->name );
				}

				$performer->groups()->sync($groups_ids);

			}
			// dd( $groups_ids );

			// dd($groups_ids);

			// foreach ($groups_ids as $group_id) {
			// 	array_push( $groups, $performer, $groups_ids );
			// 	$group = Groups::find($group_id);
			// 	// array_push( $groups,  );
			// };
			array_push( $p, $performer->id, $performer->name, $performer->groups_old, $groups_ids, $groups );


			// $performer->update($request->all());

		};

		// return ($groups);
		return ($p);
		// $gateway = Gateways::find(2);
		// $status = $gateway->getStatus();

		// dd($status);
		// if ( @fopen('http://192.168.111.123:13000/status.xml', "r") ) {
		// 	return "exists!";
		// } else {
		// 	return "!exists";
		// }
		// $gatewaysIds = $gateways->lists('id')->toArray();
		//return \Auth::user();

		// $contents = Storage::disk('local')->get('public/test.txt');
		// return $contents;

		// $commands = [
		// 	'ls -la /dev/serial/by-path/',
		// ];

		// dd(SSH::run($commands, function($result){
		// 	return $result;
		// }));

		return view('pages.about')
		// 		->with('array2', $array2)
		// 		// ->with('gatewaysIds', $gatewaysIds)
		 		;

	}

	// public function getPorts()
	// {
	// 	$commands = [
	// 		'ls -la /dev/serial/by-path/',
	// 	];

	// 	dd(SSH::run($commands, function($result){
	// 		//dd($result);
	// 		return response()->json($result);
	// 	}));

	// }

	public function welcome()
	{
		//return \Auth::user();
		return view('pages.welcome')->with('title', 'Welcome');
	}

	public function home()
	{
		//return \Auth::user();mc
		return view('pages.home');
	}

	public function send(Request $request)
	{

		// $result = '';
		// for ($i=0; $i<2; $i++) {
		// 	$dt_created 	= $i.": ".date("Y-m-d H-i-s");
		// 	$x_kannel_to 	= "89140107762";
		// 	$text 			= urlencode(iconv("utf-8","ucs-2be",$dt_created));
		// 	$dlrurl 		= "http://crm.in-time.cc/dlr.php?message_id=".$message_id;
		// 	$send_url 		= "http://192.168.111.123:13004/cgi-bin/sendsms?username=user0&password=password0&coding=2&dlr-mask=7&dlr-url=$dlrurl&to=$x_kannel_to&text=$text";

		// 	//$result_send	= '0: Accepted to delivery';
		// 	$result_send	= file_get_contents($send_url);
		// 	$result 		= $result."<strong>".$i."</strong>: '".$dt_created."'<br>".$send_url."<br>".$result_send."<br><hr><br>";
		// }

		// $result = '';
		// for ($i=0; $i<50; $i++) {
		// 	// $dt_created 	= $i.": ".date("Y-m-d H-i-s");
		// 	// $x_kannel_to 	= "89140107762";
		// 	// $text 			= urlencode(iconv("utf-8","ucs-2be",$dt_created));
		// 	// $send_url 		= "http://192.168.111.123:13004/cgi-bin/sendsms?username=user0&password=password0&coding=2&dlr-mask=7&to=$x_kannel_to&text=$text";
		// 	// $result_send	= '0: Accepted to delivery';
		// 	// $result_send	= file_get_contents($send_url);
		// 	$result 		= $result."group = smsc<br>smsc-id = modem$i<br>smsc = at<br>modemtype = auto<br>device = /dev/ttyUSB$i<br>my-number = \"+79140009955<br>sms-center = \"+79025110010<br>sim-buffering = true<br><br>";
		// }

		//return $result;

		$gateways 		= Gateways::all();
		$modems 		= Modems::all();
		// $gatewaysIds 	= $gateways->lists('id')->toArray();
		// $modemsIds 		= $gateways->lists('id')->toArray();
		return view('pages.send')
				->with('gateways', 		$gateways)
				->with('modems', 		$modems)
				;
	}

	public function send_sms(Request $request)
	{

		// get data
		// $gateway 	= Gateways::findOrFail($request->gateway);
		// $url 		= $gateway->url_send;
		// $smsc 		= $gateway->name;
		// $username 	= $gateway->login;
		// $password 	= $gateway->password;
		// $coding 	= 2;
		// $to 		= $request->to;
		// $message 	= urlencode(iconv("utf-8","ucs-2be",$request->message));

		// // validate
		// // $message_id = $pdo->lastInsertId();
		// // $dlrurl = "http://crm.in-time.cc/dlr.php?message_id=".$message_id;
		// // &dlr-url=$dlrurl
		// // $error = ( !strlen($to)==11 ) ? 'phone number not correct!' : null;

		// // send
		// $url 		= "$url?username=$username&password=$password&coding=$coding&dlr-mask=7&to=$to&text=$message";
		// $result 	= file_get_contents($url);

		// // result
		// session()->flash('flash_success', 'Message: '.$message.' / Username: '.$smsc.' / Status message: '.$result.' / URL: '.$url);
		// return redirect('send');

	}

	public function settingsShow(Request $request)
	{
		$settings = Settings::all();
		return view('pages.settings')
				->with('settings', $settings)
			;
	}

	public function settingsSave(Request $request)
	{
		// return redirect('send');
	}

	public function dashboardShow(Request $request)
	{
		//$settings = Settings::all();

// 		$data = DB::select('
// select
// count(*) total,
// count(if (operator is null,1,null) ) estimate,
// count(if (operator is not null,1,null) ) checked,
// count(if (deleted_at is not null,1,null)) deleted
// from numbers
// 			');
		return view('pages.dashboard')
				// ->with('data', $data[0])
			;
	}



	public function adminShow(Request $request)
	{
		return view('pages.admin.admin')
				// ->with('data', $data[0])
			;
	}



	public function adminPhpinfoShow(Request $request)
	{
		return view('pages.admin.phpinfo');
	}



	public function adminUsersShow(Request $request)
	{
		$users = User::all();
		return view('pages.admin.users')
			->with('users', $users)
		;
	}



	public function getUsersFromLdap(Request $request)
	{
		//$ldapusers = Adldap::search()->users()->where('samaccountname', '=', 'anton')->get();
		//$ldapusers = Adldap::search()->users()->sortBy('cn', 'asc')->get();

		$filter = '(&(objectClass=user)(objectCategory=person)(!(objectCategory=group))(mail=*@*)(!(cn=_*))(!(userAccountControl:1.2.840.113556.1.4.803:=2)))';
		$ldapusers = Adldap::search()->rawFilter($filter)->sortBy('cn', 'asc')->get();
		return view('pages.admin.ldapusers')
			->with('ldapusers', $ldapusers)
		;
	}



	public function syncUsersFromLdap(Request $request)
	{

		$filter = '(&(objectClass=user)(objectCategory=person)(!(objectCategory=group))(mail=*@*)(!(cn=_*))(!(userAccountControl:1.2.840.113556.1.4.803:=2)))';
		$ldapusers = Adldap::search()->rawFilter($filter)->get();

		$r = array();
		$i = 0;

		foreach ($ldapusers as $ldapuser) {

			$r[$i] = $ldapuser->mail[0];

			if ( User::where('email', $ldapuser->mail[0])->exists() ) {
				$r[$i] = $r[$i] . ' - EXISTS!';
			} else {
				$r[$i] = $r[$i] . '';
				$user = new User;
				$user->name 			= $ldapuser->name[0];
				$user->email 			= $ldapuser->mail[0];
				$user->mobile 			= $ldapuser->mobile[0];
				$user->telephonenumber 	= $ldapuser->telephonenumber[0];
				$user->homephone 		= $ldapuser->homephone[0];
				$user->title 			= $ldapuser->title[0];
				$user->department 		= $ldapuser->department[0];
				$user->save();
				$r[$i] = $r[$i] . ' - CREATED!';
			}

			$i++;
		}

		return($r);

	}
}
