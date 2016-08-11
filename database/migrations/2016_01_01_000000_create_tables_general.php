<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesGeneral extends Migration
{



	public function up()
	{



		Schema::create('users', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->nullableTimestamps();
			$table->softDeletes();
			$table->string('comment')->nullable();

			$table->string('name')->nullable();
			$table->string('email')->unique();
			$table->string('password')->nullable();
			$table->string('salt')->nullable();
			$table->string('hash')->nullable();
			$table->dateTime('last_login_at')->nullable();
			$table->rememberToken();
			$table->string('telephonenumber')->nullable();
			$table->string('mobile')->nullable();
			$table->string('homephone')->nullable();
			$table->string('title')->nullable();
			$table->string('department')->nullable();
		});



		Schema::create('cases', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->nullableTimestamps();
			$table->softDeletes();
			$table->string('comment')->nullable();

			$table->string('name')->nullable();
			$table->string('text', 10240)->index()->nullable();
			$table->dateTime('due_to')->nullable();
			$table->integer('user_id')->unsigned()->index();
				$table->foreign('user_id')->references('id')->on('users');
		});



			Schema::create('case_performers', function (Blueprint $table) {
				$table->nullableTimestamps();
				$table->integer('case_id')->unsigned()->index();
					$table->foreign('case_id')->references('id')->on('cases');
				$table->integer('user_id')->unsigned()->index();
					$table->foreign('user_id')->references('id')->on('users');
			});



			Schema::create('case_members', function (Blueprint $table) {
				$table->nullableTimestamps();
				$table->integer('case_id')->unsigned()->index();
					$table->foreign('case_id')->references('id')->on('cases');
				$table->integer('user_id')->unsigned()->index();
					$table->foreign('user_id')->references('id')->on('users');
			});



		Schema::create('messages', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->nullableTimestamps();
			$table->softDeletes();
			$table->string('comment')->nullable();

			$table->string('text', 10240)->index()->nullable();
			$table->integer('user_id')->unsigned()->index();
				$table->foreign('user_id')->references('id')->on('users');
			$table->integer('case_id')->unsigned()->index();
		});



		Schema::create('types', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->nullableTimestamps();
			$table->softDeletes();
			$table->string('comment')->nullable();

			$table->string('name')->nullable();
		});



		Schema::create('priorities', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->nullableTimestamps();
			$table->softDeletes();
			$table->string('comment')->nullable();

			$table->string('name')->nullable();
		});



		Schema::create('statuses', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->nullableTimestamps();
			$table->softDeletes();
			$table->string('comment')->nullable();

			$table->string('name')->nullable();
			$table->string('color')->nullable();
		});



		Schema::create('files', function (Blueprint $table) {
			$table->increments('id')->index();
			$table->nullableTimestamps();
			$table->softDeletes();
			$table->string('comment')->nullable();

			$table->string('name')->nullable();
			$table->string('ext')->nullable();
			$table->string('mimetype')->nullable();
			$table->string('size')->nullable();
			$table->integer('downloaded')->nullable();
			$table->integer('opened')->nullable();
			$table->string('original')->nullable();
			$table->string('converted')->nullable();
			$table->string('thumbnail')->nullable();

			$table->integer('user_id')->unsigned();
				$table->foreign('user_id')->references('id')->on('users');

			// $table->integer('case_id')->unsigned();
			// $table->foreign('case_id')->references('id')->on('cases');

			$table->integer('message_id')->unsigned();
			// $table->foreign('message_id')->references('id')->on('messages');
		});



	}



	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		Schema::drop('users');
		Schema::drop('cases');
		Schema::drop('case_performers');
		Schema::drop('case_members');
		Schema::drop('messages');
		Schema::drop('priorities');
		Schema::drop('statuses');
		Schema::drop('types');
		Schema::drop('files');

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}
