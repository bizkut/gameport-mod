<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('status')->nullable();
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(\Config::get('settings.users_confirmation') ? false : true);
            $table->double('balance', 15, 2)->default('0.00');
            $table->rememberToken();
            $table->string('description', 255)->nullable();
            $table->string('facebook_link', 255)->nullable();
            $table->string('twitter_link', 255)->nullable();
            $table->string('bank_firstname', 255)->nullable();
            $table->string('bank_lastname', 255)->nullable();
            $table->string('bank_iban', 255)->nullable();
            $table->string('bank_swiftcode', 255)->nullable();
            $table->string('bank_name', 255)->nullable();
            $table->string('bank_address', 255)->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
