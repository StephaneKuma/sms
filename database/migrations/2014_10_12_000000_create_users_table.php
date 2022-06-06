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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender')->default(null)->nullable();
            $table->string('nationality')->default(null)->nullable();
            $table->string('phone')->default(null)->nullable();
            $table->string('address')->default(null)->nullable();
            $table->string('address2')->default(null)->nullable();
            $table->string('city')->default(null)->nullable();
            $table->string('zip')->default(null)->nullable();
            $table->string('picture')->default(null)->nullable();
            $table->string('birthday')->default(null)->nullable();
            $table->string('blood_type')->default(null)->nullable();
            $table->string('religion')->default(null)->nullable();
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
