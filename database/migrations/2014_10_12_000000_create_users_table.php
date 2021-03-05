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
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('password');
            $table->smallInteger('actorid');
            $table->string('ip');
            $table->timestamp('registerdate');
            $table->timestamp('accessdate');
            $table->booelan('status');
            $table->string('gmailid');
            $table->string('facebookid');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('nohp');
            $table->string('province');
            $table->string('city');
            $table->string('postcode');
            $table->string('npwp');
            $table->string('ktpfile');
            $table->string('nik');
            $table->string('sex');
            $table->string('dateofbirth');
            $table->string('avatarfile');
            $table->string('bankname');
            $table->string('banknumber');
            $table->string('bankowner');
            $table->string('referalid');
            $table->integer('registertype');
            $table->string('token');
            $table->integer('refbp');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
