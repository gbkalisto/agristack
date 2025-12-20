<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('farmer_land_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('khata_number')->nullable();
            $table->string('plot_numbers')->nullable();
            $table->decimal('total_land', 8, 2)->nullable();

            $table->enum('irrigation_source', ['canal', 'tubewell', 'rainfed'])
                ->nullable();

            $table->enum('ownership_type', ['owner', 'lease', 'sharecrop'])
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farmer_land_details');
    }
};
