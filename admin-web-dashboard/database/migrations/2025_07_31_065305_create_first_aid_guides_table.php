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
        Schema::create('first_aid_guides', function (Blueprint $table) {
            $table->id();
            $table->string('incident_type'); // e.g., Fire, Flood, Medical, Accident - relates to the type of incident the guide is for
            $table->string('title'); // e.g., "CPR Basics", "Bleeding Control"
            $table->longText('content'); // The detailed first aid instructions
            $table->string('language', 50); // e.g., "English", "Kiswahili"
            // Foreign key to the 'users' table, assuming an admin user creates the guide
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict'); // Restrict deletion if guides exist
            $table->timestamps(); // Adds created_at and updated_at columns automatically
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('first_aid_guides');
    }
};
