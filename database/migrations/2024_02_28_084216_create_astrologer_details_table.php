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
        Schema::create('astrologer_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('designation');
            $table->string('image_url');
            $table->integer('total_question_answered');
            $table->integer('mac_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologer_details');
    }
};
