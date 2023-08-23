<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userName');
            $table->string('Name');
            $table->string('LastName');
            $table->bigInteger('SSN');
            $table->bigInteger('Phone');
            $table->bigInteger('Workphone');
            $table->date('DateBirth');
            $table->string('Address');
            $table->string('Country');
            $table->string('State');
            $table->string('City');
            $table->string('ZipCode');
            $table->string('Email')->unique();
            $table->string('password');
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
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
};
