<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Auth;

class UpdateLastUserActivity
{



	public function handle($request, Closure $next, $guard = null)
	{

		if ( Auth::check() ) {
			$user = Auth::user();
			$user->last_activity_at = Carbon::now();
			$user->save();
		}

		return $next($request);
	}



}