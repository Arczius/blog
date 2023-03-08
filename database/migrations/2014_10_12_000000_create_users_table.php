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
            $table->id();
            $table->string('username');
            $table->string('token')->nullable();
            $table->string('handle')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('followers');
            $table->string('following');
            $table->string('about_me')->default("hey there, im a blog user");
            $table->string('profile_picture')->nullable(true);
            $table->string('profile_header')->nullable(true);
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
