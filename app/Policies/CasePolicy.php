<?php

namespace Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Cases;

class CasePolicy
{
	use HandlesAuthorization;

	/**
	 * Create a new policy instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}



	public function show(User $user, Cases $case)
	{
        return $user->id === $case->user_id;
	}
}
