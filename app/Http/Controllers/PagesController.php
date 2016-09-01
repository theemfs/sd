<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use App\User;

class PagesController extends Controller
{



	public function __construct()
	{
	}



	public function home()
	{
		return view('pages.home');
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

				$user = User::where('email', $ldapuser->mail[0])->first();
					$user->name 			= $ldapuser->name[0];
					$user->email 			= $ldapuser->mail[0];
					$user->mobile 			= $ldapuser->mobile[0];
					$user->telephonenumber 	= $ldapuser->telephonenumber[0];
					$user->homephone 		= $ldapuser->homephone[0];
					$user->title 			= $ldapuser->title[0];
					$user->department 		= $ldapuser->department[0];
				$user->update();
				$r[$i] = $r[$i] . ' - EXISTS! updated!';

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
