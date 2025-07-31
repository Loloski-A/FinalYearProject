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
        Schema::create('incident_media', function (Blueprint $table) {
            $table->id();
            // Foreign key to the 'incidents' table
            $table->foreignId('incident_id')->constrained('incidents')->onDelete('cascade');
            $table->string('file_path'); // Path to the stored media file (e.g., storage/app/public/incidents/image.jpg)
            $table->enum('file_type', ['image', 'video']);
            $table->text('description')->nullable(); // Optional description of the media
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incident_media');
    }
};
