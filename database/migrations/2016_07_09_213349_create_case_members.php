<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseMembers extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('case_members', function (Blueprint $table) {
			// $table->increments('id')->index();
			$table->timestamps();
			// $table->softDeletes();
			// $table->string('comment');

			// $table->string('name');
			// $table->string('text', 10240)->index();
			$table->integer('case_id')->unsigned()->index();
				$table->foreign('case_id')->references('id')->on('cases');
			$table->integer('user_id')->unsigned()->index();
				$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('case_members');
	}
}
