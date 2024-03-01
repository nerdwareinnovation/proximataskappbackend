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
        Schema::create('sample_questions_moderators', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->integer('category_id');
            $table->integer('orderfront');
            $table->tinyInteger('is_published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_questions_moderators');
    }
};
