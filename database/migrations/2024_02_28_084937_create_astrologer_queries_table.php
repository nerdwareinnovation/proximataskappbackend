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
        Schema::create('astrologer_queries', function (Blueprint $table) {
            $table->id();
            $table->text('translated_by_moderator');
            $table->integer('chat_id');
            $table->integer('reply_id');
            $table->text('astrologer_answer');
            $table->text('translated_answer');
            $table->tinyInteger('type');
            $table->integer('astrologer_id');
            $table->integer('moderator_id');
            $table->timestamp('astrologer_answer_at')->nullable();
            $table->timestamp('moderated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologer_queries');
    }
};
