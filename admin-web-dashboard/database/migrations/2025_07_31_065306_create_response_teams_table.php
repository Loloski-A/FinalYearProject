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
        Schema::create('response_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., "Fire Brigade Alpha", "Ambulance Unit 3"
            $table->string('team_type'); // e.g., "Fire Response", "Medical Response", "Police"
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'On Duty', 'Off Duty'])->default('Active');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_teams');
    }
};
