<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmTaskTimesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_expiration_times', function (Blueprint $table) {
            $table->id();
            $table->string('label', 90);
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });
        Schema::create('crm_start_times', function (Blueprint $table) {
            $table->id();
            $table->string('label', 90);
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });
        Schema::create('crm_time_filters', function (Blueprint $table) {
            $table->id();
            $table->string('label', 100);
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
        Schema::dropIfExists('crm_expiration_times');
        Schema::dropIfExists('crm_start_times');
        Schema::dropIfExists('crm_time_filters');
    }
}
