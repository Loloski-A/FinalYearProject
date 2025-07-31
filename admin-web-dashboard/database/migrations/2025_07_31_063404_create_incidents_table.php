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
            Schema::create('incidents', function (Blueprint $table) {
                $table->id();
                // Foreign key to the 'users' table, assuming the reporter is a 'User'
                // onDelete('cascade') means if a user is deleted, their incidents are also deleted.
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('incident_type'); // e.g., Fire, Flood, Medical, Accident
                $table->enum('severity', ['Critical', 'High', 'Medium', 'Low']);
                $table->text('description');
                $table->decimal('latitude', 10, 8); // Precision for geographical coordinates
                $table->decimal('longitude', 11, 8); // Precision for geographical coordinates
                $table->string('location_name')->nullable(); // Human-readable location, optional
                $table->string('contact_info')->nullable(); // Reporter's contact, optional
                $table->enum('status', ['Pending', 'Assigned', 'En Route', 'Resolved', 'Closed'])->default('Pending');
                $table->timestamp('reported_at')->useCurrent(); // Automatically set on creation
                $table->timestamp('resolved_at')->nullable(); // Set when incident is resolved
                $table->timestamps(); // Adds created_at and updated_at columns automatically
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('incidents');
        }
    };
