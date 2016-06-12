<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

use Closure;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier
{
	/**
	 * The URIs that should be excluded from CSRF verification.
	 *
	 * @var array
	 */
	protected $except = [
		//
	];

	// protected function addCookieToResponse($request, $response)
	// {
	// 	$config = config('session');

	// 	$response->headers->setCookie(
	// 		new Cookie(
	// 			'remixtoken', $request->session()->token(), time() + 60 * 120,
	// 			$config['path'], $config['domain'], $config['secure'], false
	// 		)
	// 	);

	// 	return $response;
	// }
}
