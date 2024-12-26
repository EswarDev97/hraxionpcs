<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  // database/migrations/xxxx_xx_xx_create_tasks_table.php
public function up()
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('project_id')->constrained()->onDelete('cascade');
        $table->foreignId('resource_assigned_to')->constrained('employees')->onDelete('cascade');
        $table->string('task_name');
        $table->text('task_description')->nullable();
        $table->enum('priority', ['high', 'medium', 'low']);
        $table->enum('status', ['completed', 'not_started', 'in_progress']);
        $table->date('expected_completion_date');
        $table->integer('efforts_estimate');
        $table->integer('actual_efforts')->nullable();
        $table->foreignId('assignee_id')->constrained('employees')->onDelete('cascade');
        $table->date('work_start_date')->nullable();
        $table->date('work_complete_date')->nullable();
        $table->boolean('completed_status')->default(false);
        $table->text('comments')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
