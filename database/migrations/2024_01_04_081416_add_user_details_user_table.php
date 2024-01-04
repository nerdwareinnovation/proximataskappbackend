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
            $table->date('date_of_birth')->nullable();
            $table->string('birth_city')->nullable();
            $table->string('birth_state')->nullable();
            $table->string('birth_country')->nullable();
            $table->string('birth_time')->nullable();
            $table->boolean('is_time_accurate')->default(0);
            $table->string('gender')->nullable();
            $table->string('interested_in')->nullable();
            $table->string('current_city')->nullable();
            $table->string('current_state')->nullable();
            $table->string('current_country')->nullable();
            $table->text('bio')->nullable();
            $table->string('occupation')->nullable();
            $table->string('relationship_status')->nullable();
            $table->boolean('open_to_date')->default(0);
            $table->boolean('open_to_job')->default(0);
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_profile_detail_complete')->default(0);
            $table->date('deleted_at')->nullable();
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
