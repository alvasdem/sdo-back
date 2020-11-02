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
            $table->integer('user_id')->increments()->unsigned()->nullable(false)->comment('ID пользователя');
            $table->string('user_email', 100)->unique()->nullable(false)->comment('Email пользователя');    
            $table->string("user_password", 100)->nullable(false)->comment('Пароль пользователя'); 
            $table->string("surname", 100)->nullable(false)->comment("Фамилия");                   
            $table->string("name", 100)->nullable(false)->comment("Имя");    
            $table->string("patronymic", 100)->nullable(false)->comment("отчество");       
            $table->string("user_phone", 100)->nullable(false)->comment("телефон");             
            $table->date("date_of_birth")->comment("дата рождения");             
            $table->integer("partner_id")->comment("ID представительства");             
            $table->string("user_hash", 32)->comment("служебное поле");             
            $table->dateTime("reg_date")->comment("дата регистрации");             
            $table->integer("region_id")->comment("регион");             
            $table->string("user_ip", 52)->nullable(false)->comment("айпи");             
            $table->integer("referral_id")->comment("рефеал");             
            $table->string("facebook_link", 250)->nullable(false)->comment("линк фейсбук");             
            $table->string("user_skype")->nullable(false)->comment("линк скайп");             
            $table->string("utm_parametrs")->nullable(false)->comment("параметры времени");             
            $table->integer("user_active", 11)->nullable(false)->comment("1 - Активный, 0 - Деактивирован, -2 - Забанен");             
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