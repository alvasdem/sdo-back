<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_groups', function (Blueprint $table) {
            //$table->increments('id', true);
            $table->increments('u_group_id')->unsigned()->nullable(false)->comment('ID группы');
            $table->integer('u_group_parent')->unsigned()->nullable(true)->comment('ID родительской группы');
            $table->string('u_group_name', 250)->nullable(false)->comment('Названия группы во всех падежах');
            $table->string('u_group_color', 32)->nullable(false)->comment('Цвет группы 383f62');

        });

        Schema::table('u_groups', function($table) {
            $table->foreign('u_group_parent')->references('u_group_id')->on('u_groups')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('u_group_id')->references('u_group_id')->on('users_to_groups')->onDelete('cascade')->onUpdate('cascade');

        });             
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('u_groups');
    }
}
