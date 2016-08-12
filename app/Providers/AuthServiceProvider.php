<?php

namespace App\Providers;

// use App\Cases;
// use App\Policies\CasesPolicy;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;



class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
		// 'App\Cases' => 'CasesPolicy::class',
	];

	/**
	 * Register any application authentication / authorization services.
	 *
	 * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
	 * @return void
	 */
	public function boot(GateContract $gate)
	{
		$this->registerPolicies($gate);

		$gate->define('show-case', function ($user, $case) {
			return $case->user->id === $user->id
				|| $case->performers->contains($user->id)
				|| $case->members->contains($user->id)
			;
		});

		$gate->define('update-case', function ($user, $case) {
			return $case->user->id === $user->id
				// || $case->performers->contains($user->id)
				// || $case->members->contains($user->id)
			;
		});

	}
}
