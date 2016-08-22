<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Ldap;
use Carbon\Carbon;

class AuthController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/profile';
	protected $username = 'email';


	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'logout']);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			// 'password' => 'required|confirmed|min:6',
			'password' => 'required|confirmed',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}

		/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function login(Request $request)
	{
		$this->validate($request, [
			$this->loginUsername() => 'required', 'password' => 'required',
		]);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		$throttles = $this->isUsingThrottlesLoginsTrait();

		if ($throttles && $this->hasTooManyLoginAttempts($request)) {
			return $this->sendLockoutResponse($request);
		}

		$credentials = $this->getCredentials($request);


//auth method
		/**
		 * auth via local base
		 */
		// if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
		// 	return $this->handleUserWasAuthenticated($request, $throttles);
		// }

		/**
		 * auth via LDAP
		 */
		$ldap = new Ldap(env('LDAP_AUTH'), function), $credentials);

		if ( $ldap->isCredentialsCorrect( $credentials ) ) {

			//dd($ldap->user);

			//var
			if (array_key_exists('sn', $ldap->user) ) {
				$fullname 			= $ldap->user['sn'][0] . " " . $ldap->user['givenname'][0];
			} else {
				$fullname 			= $credentials['email'];
			}

			if (array_key_exists('mail', $ldap->user) ) {
				$email 				= $ldap->user['mail'][0];
			} else {
				$email 				= $credentials['email'];
			}

			if (array_key_exists('telephonenumber', $ldap->user) ) {
				$telephonenumber 	= $ldap->user['telephonenumber'][0];
			} else {
				$telephonenumber 	= '';
			}

			if (array_key_exists('mobile', $ldap->user) ) {
				$mobile 			= $ldap->user['mobile'][0];
			} else {
				$mobile 			= '';
			}

			if (array_key_exists('title', $ldap->user) ) {
				$title 				= $ldap->user['title'][0];
			} else {
				$title 				= '';
			}

			$password		= $credentials['password'];

			//action
			if ( User::where('email', $email)->count()==1 ) {
				$user = User::where('email', $email)->firstOrFail();
				$user->name = $fullname;
				$user->telephonenumber = $telephonenumber;
				$user->mobile = $mobile;
				$user->title = $title;
				$user->last_login_at = Carbon::now();
				$user->save();
			} else {
				$user = User::create( [
					'name'=>$fullname,
					'email' => $email,
					'password'=>$password,
					'title'=>$title,
					'mobile'=>$mobile,
					'telephonenumber'=>$telephonenumber,
					'last_login_at'=>Carbon::now(),
				] );
			}
			Auth::login($user);
			return $this->handleUserWasAuthenticated($request, $throttles);
		}
//auth method


		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		if ($throttles) {
			$this->incrementLoginAttempts($request);
		}

		return $this->sendFailedLoginResponse($request);
	}




};