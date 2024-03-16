<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('task_group_id')
                ->nullable()
                ->constrained('task_groups')
                ->onDelete('set null');
            $table->timestamp('started_at')->default(now());
            $table->timestamp('expired_at')->default(now()->addDays(7))->nullable();
            $table->timestamps();
        });

        Schema::create('user_task', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('task_group_id')
                ->constrained('task_groups')
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
        Schema::dropIfExists('user_task');
        Schema::dropIfExists('tasks');
    }
}
