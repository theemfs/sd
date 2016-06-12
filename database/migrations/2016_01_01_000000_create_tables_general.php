<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesGeneral extends Migration
{



	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->timestamps();
			$table->softDeletes();
			$table->string('comment');

			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('salt');
			$table->string('hash');
			$table->dateTime('last_login_at');
			$table->rememberToken();

			$table->string('telephonenumber');
			$table->string('mobile');
			$table->string('homephone');
			$table->string('title');
		});

						
		Schema::create('cases', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->timestamps();
			$table->softDeletes();
			$table->string('comment');

			$table->string('name');
			$table->string('text', 10240)->index();

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
		});
			// Schema::create('batch_numbers', function (Blueprint $table) {
			// 	$table->string('numbers_id', 11)->index();
			// 	$table->integer('sets_id')->unsigned()->index();
			// 	$table->timestamps();
			// 	$table->softDeletes();
			// 		$table->foreign('numbers_id')->references('id')->on('numbers')->onDelete('cascade');
			// 		$table->foreign('sets_id')->references('id')->on('sets')->onDelete('cascade');
			// 		$table->primary(['numbers_id', 'sets_id']);
			// });

		Schema::create('messages', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->timestamps();
			$table->softDeletes();
			$table->string('comment');

			$table->integer('author');
			$table->string('text', 10240)->index();
		});

		Schema::create('types', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->timestamps();
			$table->softDeletes();
			$table->string('comment');

			$table->string('name');
		});

		Schema::create('priorities', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->timestamps();
			$table->softDeletes();
			$table->string('comment');

			$table->string('name');
		});

		Schema::create('files', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->timestamps();
			$table->softDeletes();
			$table->string('comment');

			$table->string('name');
			$table->string('ext');
			$table->string('mimetype');
			$table->string('size');
			$table->integer('downloaded');
			$table->integer('opened');

			$table->string('original');
			$table->string('converted');
			$table->string('thumbnail');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

			$table->integer('case_id')->unsigned();
			$table->foreign('case_id')->references('id')->on('cases');
		});

	}



	public function down()
	{
		Schema::drop('users');
		Schema::drop('cases');
		Schema::drop('types');
		Schema::drop('priorities');
		Schema::drop('files');
	}
}
