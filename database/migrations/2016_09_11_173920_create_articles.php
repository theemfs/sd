<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles2', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->string('comment')->nullable();

            $table->string('name')->nullable();
            $table->string('text')->unique();
            $table->integer('is_published')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
