<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('farmer_residential_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('residential_type', ['rural', 'urban'])
                ->default('rural');

            $table->string('address_english')->nullable();
            $table->string('address_local')->nullable();

            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('block_id')->nullable();

            // Foreign keys
            $table->foreign('division_id')
                ->references('id')->on('divisions')
                ->nullOnDelete();

            $table->foreign('district_id')
                ->references('id')->on('districts')
                ->nullOnDelete();

            $table->foreign('block_id')
                ->references('id')->on('blocks')
                ->nullOnDelete();
            $table->string('village')->nullable();

            $table->string('pincode', 6);

            $table->boolean('is_latest')
                ->default(true)
                ->comment('Latest residential details');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farmer_residential_details');
    }
};
