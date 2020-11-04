<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_to_groups', function (Blueprint $table) {
            $table->increments('id', true);
            $table->integer('user_id')->unique()->unsigned()->nullable(true)->comment('Номер пользователя');
            $table->integer('u_group_id')->unique()->unsigned()->nullable(true)->comment('Номер группы');
            $table->date('u_to_group_added')->nullable(true)->comment('Дата привязки');

        });

        Schema::table('users_to_groups', function($table) {
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_to_groups');
    }
}
