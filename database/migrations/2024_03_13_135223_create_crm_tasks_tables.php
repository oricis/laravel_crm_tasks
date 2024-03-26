<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmTasksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_task_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });
        Schema::create('crm_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('description', 255)->nullable();
            $table->foreignId('crm_task_group_id')
                ->nullable()
                ->constrained('crm_task_groups')
                ->onDelete('set null');

            // Choose when is going to create the user task
            $table->foreignId('crm_start_time_id')
                ->nullable()
                ->constrained('crm_start_times')
                ->onDelete('set null');

            // Choose when the user task must be completed
            $table->foreignId('crm_expiration_time_id')
                ->nullable()
                ->constrained('crm_expiration_times')
                ->onDelete('set null');

            // Time to start scheduling
            $table->timestamp('start_at')->default(now());

            // Time to end scheduling
            $table->timestamp('expired_at')->default(now()->addDays(7));

            $table->timestamps();
        });
        Schema::create('crm_user_task', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('description', 255)->nullable();
            $table->foreignId('crm_task_group_id')
                ->constrained('crm_task_groups')
                ->onDelete('cascade');
            $table->foreignId('assigned_to') // user_id
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->timestamp('created_at'); // from tasks.started_at
            $table->timestamp('updated_at');
            $table->timestamp('expired_at'); // from tasks.expired_at
            $table->timestamp('ended_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crm_user_task');
        Schema::dropIfExists('crm_tasks');
        Schema::dropIfExists('crm_task_groups');
    }
}
