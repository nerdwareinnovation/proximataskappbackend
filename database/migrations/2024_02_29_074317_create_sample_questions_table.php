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
        Schema::create('sample_questions', function (Blueprint $table) {
            $table->id();
            $table->text('questions');
            $table->integer('category_id');
            $table->integer('role');
            $table->integer('order_ques');
            $table->tinyInteger('is_published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_questions');
    }
};
