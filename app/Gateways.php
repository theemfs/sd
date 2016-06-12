<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gateways extends Model
{

	use SoftDeletes;

	//protected $table = 'phones';

	protected $fillable = [
		'name',
		'comment',
		'is_black',
		"name",
		'url_status',
		'url_send',
		'url_recieve',
		'login',
		'password',
		'sender',
		'config'
	];

	protected $dates = [
		'deleted_at'
	];

	/**
	 * Performer is owned by a user;
	 */
	// public function user()
	// {
	//     //return $this->belongsTo('App\User');
	// }

	/**
	 * Performer associated with many Gateways
	 */
	public function performers()
	{
		// return $this->belongsToMany('App\Performers')->withTimestamps();
		return '!';
	}

	public function getStatus()
	{

		if ($curl = curl_init()) {
			curl_setopt($curl, CURLOPT_URL, $this->url_status);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			$out = curl_exec($curl);
			curl_close($curl);
			return $out;
				//return simplexml_load_file($out)->xpath("//smsc[./admin-id='$this->name']")[0];
				// if ( @fopen('http://192.168.111.123:13000/status.xml', "r") ) {
				// 	return simplexml_load_file($out)->xpath("//smsc[./admin-id='$this->name']")[0];
				// } else {
				// 	$test = new \SimpleXMLElement('<?xml version=\"1.0\"\?\><gateway><smscs><smsc><name></name><admin-id></admin-id><id></id><status>server kannel not available!</status><received><sms></sms><dlr></dlr></received><sent><sms></sms><dlr></dlr></sent><failed></failed><queued></queued></smsc></smscs></gateway>');
				// 	return $test->xpath("//smsc")[0];
				// }
		}

	}

}