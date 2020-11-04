<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {      
            $table->increments('user_id')->nullable(false)->comment('ID пользователя');
            $table->string('user_email', 100)->unique()->nullable(false)->comment('Email пользователя');    
            $table->string("password", 100)->nullable(false)->comment('Пароль пользователя'); 
            $table->string("surname", 100)->nullable(false)->comment("Фамилия пользователя");                   
            $table->string("name", 100)->nullable(false)->comment("Имя пользователя");    
            $table->string("patronymic", 100)->nullable(false)->comment("Отчество  пользователя");       
            $table->string("user_phone", 100)->nullable(false)->comment("Телефон пользователя");             
            $table->date("date_of_birth")->nullable(true)->comment("Дата рождения");             
            $table->integer("partner_id")->nullable(true)->comment("ID представительства");             
            $table->string("user_hash", 32)->nullable(true)->comment("Служебное поле");             
            $table->dateTime("reg_date")->nullable(true)->comment("Дата регистрации пользователя");             
            $table->integer("region_id")->nullable(true)->comment("регион");             
            $table->string("user_ip", 52)->nullable(true)->comment("IP пользователя с которого заходил последний раз");             
            $table->integer("referral_id")->nullable(true)->comment("рефеал");             
            $table->string("facebook_link", 250)->nullable(true)->comment("Ссылка на Facebook");             
            $table->string("user_skype")->nullable(true)->comment("линк скайп");             
            $table->string("utm_parametrs")->nullable(true)->comment("параметры времени");             
            $table->integer("user_active")->nullable(true)->default(true)->comment("1 - Активный, 0 - Деактивирован, -2 - Забанен");             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
