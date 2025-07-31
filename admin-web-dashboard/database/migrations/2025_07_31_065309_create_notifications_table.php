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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            // User ID (nullable if it's a team-specific or global notification)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            // Team ID (nullable if it's a user-specific or global notification)
            $table->foreignId('team_id')->nullable()->constrained('response_teams')->onDelete('cascade');
            // Incident ID (nullable if notification is not incident-related)
            $table->foreignId('incident_id')->nullable()->constrained('incidents')->onDelete('cascade');
            $table->string('type'); // e.g., 'New Incident', 'Status Update', 'Broadcast Alert'
            $table->string('title');
            $table->text('message');
            $table->boolean('read_status')->default(false);
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
