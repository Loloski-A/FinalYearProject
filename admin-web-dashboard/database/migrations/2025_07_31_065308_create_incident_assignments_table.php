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
        Schema::create('incident_assignments', function (Blueprint $table) {
            $table->id();
            // Foreign key to the 'incidents' table
            $table->foreignId('incident_id')->constrained('incidents')->onDelete('cascade');
            // Foreign key to the 'response_teams' table
            $table->foreignId('team_id')->constrained('response_teams')->onDelete('cascade');
            $table->timestamp('assigned_at')->useCurrent();
            $table->enum('status', ['Assigned', 'En Route', 'Arrived', 'Completed', 'Cancelled'])->default('Assigned');
            $table->text('notes')->nullable(); // Any notes related to the assignment
            $table->timestamps(); // Adds created_at and updated_at columns

            // Ensure a team is assigned to an incident only once (optional, but good for uniqueness)
            $table->unique(['incident_id', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_assignments');
    }
};
