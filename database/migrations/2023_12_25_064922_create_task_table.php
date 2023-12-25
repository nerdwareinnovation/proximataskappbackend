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
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->integer('task_type_id');
            $table->integer('parent_task_id')->nullable();
            $table->integer('user_id');
            $table->string('task_title');
            $table->text('task_requirements');
            $table->date('due_date');
            $table->time('due_time_start');
            $table->time('due_time_end');
            $table->decimal('budget')->nullable();
            $table->string('attachment')->nullable();
            $table->string('voice_note')->nullable();
            $table->string('delete_reason')->nullable();
            $table->string('restore_reason')->nullable();
            $table->boolean('is_restored')->nullable();
            $table->boolean('is_urgent')->default(0);
            $table->boolean('is_important')->default(0);
            $table->boolean('set_remainder')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
