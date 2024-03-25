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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('question_asked')->nullable();
            $table->integer('total_question_answered')->nullable();
            $table->string('designation')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('image_url')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('currently_serving')->nullable();
            $table->string('affiliate_id')->nullable();
            $table->string('referred_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
