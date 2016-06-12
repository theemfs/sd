<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
	],

	'mandrill' => [
		'secret' => env('MANDRILL_SECRET'),
	],

	'ses' => [
		'key'    => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => App\User::class,
		'key'    => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],

	'github' => [
		'client_id' 		=> 'b2e91887d0cddd859808',
		'client_secret' 	=> '9c3ace4ac8ba45c5f619cd3b994c2e1d9f5b274a',
		'redirect' 			=> 'http://crm2.in-time.cc/githubed',
	],

	'google' => [
		'client_id' 		=> '1092756469891-ga0grfg0ir9up6bq1b6fm61u3cmvdc3u.apps.googleusercontent.com',
		'client_secret' 	=> '6SUtxzKA5hF8qgkAfCkFor1C',
		'redirect' 			=> 'http://crm2.in-time.cc/googled',
	],

	'facebook' => [
		'client_id' 		=> '435963019861889',
		'client_secret' 	=> '7adf8072ef064752088d6a0394021d06',
		'redirect' 			=> 'http://crm2.in-time.cc/facebooked',
	],

	'ldap' => [
		'client_id' 		=> '1',
		'client_secret' 	=> '1',
		'redirect' 			=> 'http://crm2.in-time.cc/ldaped',
	],

	// 'twitter' => [
	// 	'client_id' 		=> 'Og8qgHbM9dVn0UP61ZPTDfo6h',
	// 	'client_secret' 	=> 'M58r3hoccNqUUQ1j4vKUwW7XO0gJoQvD2DLfrkg7LX0lZ37ubc',
	// 	'redirect' 			=> 'http://crm2.in-time.cc/github',
	// ],
];
