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
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id');
            $table->tinyInteger('read');
            $table->text('message');
            $table->integer('read_by_customer');
            $table->timestamp('read_at');
            $table->integer('receiver_id');
            $table->tinyInteger('is_being_moderated');
            $table->string('systemMessageTitle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat');
    }
};
