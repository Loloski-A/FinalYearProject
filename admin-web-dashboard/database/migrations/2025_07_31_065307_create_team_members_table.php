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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            // Foreign key to the 'users' table for the individual team member
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->unique(); // Each user can only be one team member
            // Foreign key to the 'response_teams' table
            $table->foreignId('team_id')->constrained('response_teams')->onDelete('cascade');
            $table->string('role'); // e.g., "Team Lead", "Medic", "Driver"
            $table->enum('status', ['Active', 'Inactive', 'On Duty'])->default('Active');
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
