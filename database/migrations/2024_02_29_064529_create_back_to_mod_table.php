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
        Schema::create('back_to_mod', function (Blueprint $table) {
            $table->id();
            $table->integer('query_id');
            $table->integer('astrologer_id');
            $table->integer('moderator_id');
            $table->text('astrologer_answer');
            $table->text('moderator_reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('back_to_mod');
    }
};
