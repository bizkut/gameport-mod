<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmoticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emoticals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('string');
            $table->string('description')->default('');
            $table->string('image')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED');
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
        Schema::drop('emoticals');
    }
}
