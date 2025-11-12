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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->foreignId('customer_profile_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('driver_profile_id')->nullable()->constrained('driver_profiles')->onDelete('set null');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->onDelete('set null');

            // Service info
            $table->string('type');           // ride, package, express
            $table->string('vehicle_type');   // bike, car, van etc.

            // Pickup / Dropoff info
            $table->string('pickup_address');
            $table->decimal('pickup_latitude', 10, 7);
            $table->decimal('pickup_longitude', 10, 7);

            $table->string('dropoff_address');
            $table->decimal('dropoff_latitude', 10, 7);
            $table->decimal('dropoff_longitude', 10, 7);

            // Metrics & pricing
            $table->decimal('distance', 8, 2)->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();

            // Status
            $table->string('status')->default('pending'); // pending, assigned, in_progress, completed, cancelled

            // Timestamps
            $table->timestamps();

            // Indexes for faster lookups
            $table->index('customer_profile_id');
            $table->index('driver_profile_id');
            $table->index('status');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
