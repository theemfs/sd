<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
	$password = str_random(8);
	return [
		'name' => $faker->name,
		'email' => $faker->email,
		'password' => bcrypt($password),
		'comment' => $password,
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Performers::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'email' => $faker->email,
	];
});

$factory->define(App\Groups::class, function (Faker\Generator $faker) {
	return [
		'name' => "Group ".str_random(10),
	];
});

$factory->define(App\Tasks::class, function (Faker\Generator $faker) {
	return [
		'name' => "Task ".str_random(10),
	];
});

$factory->define(App\Phones::class, function (Faker\Generator $faker) {
	return [
		'name' => mt_rand(89500000000,89509999999),
	];
});

$factory->define(App\Sendings::class, function (Faker\Generator $faker) {
	return [
		'name' => "Sending ".str_random(10),
	];
});

$factory->define(App\Numbers::class, function (Faker\Generator $faker) {
	return [
		'id' => mt_rand(89500000000,89509999999),
	];
});