<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticles2 extends Migration
{

    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->string('comment')->nullable();

            $table->string('name')->nullable();
            $table->string('text')->unique();
            $table->integer('is_published')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('articles');
    }

}