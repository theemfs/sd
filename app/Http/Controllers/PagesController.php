<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use App\User;
use App\Files;
use Storage;
use Image;

class PagesController extends Controller
{



	public function __construct()
	{
	}



	public function home()
	{
		return view('pages.home');
	}



	public function test()
	{
		return view('pages.test');
	}
	public function test2()
	{
		return view('pages.test2');
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
		$users = User::where('is_active', '1')->get();
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

		$users = User::all();
		foreach($users as $user) {
			$user->is_active = 0;
		}

		$filter = '(&(objectClass=user)(objectCategory=person)(!(objectCategory=group))(mail=*@*)(!(cn=_*))(!(userAccountControl:1.2.840.113556.1.4.803:=2)))';
		$ldapusers = Adldap::search()->rawFilter($filter)->get();

		$r = array();
		$i = 0;

		foreach ($ldapusers as $ldapuser) {

			$r[$i] = $ldapuser->mail[0];

			if ( User::withTrashed()->where('email', $ldapuser->mail[0])->exists() ) {
				$user = User::withTrashed()->where('email', $ldapuser->mail[0])->first();
				$r[$i] = $r[$i] . ' - EXISTS! updated!';
			} else {
				$r[$i] = $r[$i] . '';
				$user = new User;
				$r[$i] = $r[$i] . ' - CREATED!';
			}

			$user->name 			= $ldapuser->name[0];
			$user->email 			= $ldapuser->mail[0];
			$user->mobile 			= $ldapuser->mobile[0];
			$user->phone 			= $ldapuser->telephonenumber[0];
			$user->homephone 		= $ldapuser->homephone[0];
			$user->title 			= $ldapuser->title[0];
			$user->department 		= $ldapuser->department[0];
			$user->is_active 		= 1;
			$user->save();

			$r[$i] = $r[$i] . $ldapuser->name[0]. ' | ';
			$r[$i] = $r[$i] . $ldapuser->mail[0]. ' | ';
			$r[$i] = $r[$i] . $ldapuser->mobile[0]. ' | ';
			$r[$i] = $r[$i] . $ldapuser->telephonenumber[0]. ' | ';
			$r[$i] = $r[$i] . $ldapuser->homephone[0]. ' | ';
			$r[$i] = $r[$i] . $ldapuser->title[0]. ' | ';
			$r[$i] = $r[$i] . $ldapuser->department[0]. ' | ';

			$i++;
		}

		return($r);

	}



	public function regenerateThumbnails()
	{

		$files = Files::all();
		//return($files);

		foreach ($files as $file){

			if ( substr($file->mimetype, 0, 5) == 'image' ) {
				Storage::disk('thumbnails')->put($file->thumbnail,Image::make('/var/www/sd-dev.nyzix.com/storage/uploads/'.$file->original)->fit(100, 100, function($callback){$callback->upsize();})->stream($file->sext, 75));
			}

		}

	}



	public function react()
	{
		return view('pages.react');
	}



}
