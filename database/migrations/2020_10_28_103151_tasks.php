<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tasks extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id');
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->date('finished_at');
            $table->smallInteger('is_ok')->default(0);
            $table->integer('status')->default(1);
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
