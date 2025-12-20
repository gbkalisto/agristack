<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('farmer_crop_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('main_crop');
            $table->string('secondary_crop')->nullable();

            $table->enum('season', ['rabi', 'kharif', 'zaid']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farmer_crop_details');
    }
};
