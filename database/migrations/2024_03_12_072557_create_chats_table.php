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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sender_id');
            $table->text('message')->nullable();
            $table->boolean('read')->default(0)->nullable();
            $table->boolean('read_by_customer')->default(0)->nullable();
            $table->dateTime('read_at')->nullable();
            $table->unsignedInteger('receiver_id');
            $table->boolean('is_being_moderated')->default(0)->nullable();
            $table->text('systemMessageTitle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
