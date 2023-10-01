<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('todo_id');
            $table->string('assigne_to')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('task_name')->nullable();
            $table->string('task_des')->nullable();
            $table->string('status');
            $table->string('prioriti')->nullable();
            $table->string('current_dates')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
