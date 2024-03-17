<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTimesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expiration_times', function (Blueprint $table) {
            $table->id();
            $table->string('label', 90);
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });
        Schema::create('start_times', function (Blueprint $table) {
            $table->id();
            $table->string('label', 90);
            $table->string('description', 255)->nullable();
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
        Schema::dropIfExists('expiration_times');
        Schema::dropIfExists('start_times');
    }
}
