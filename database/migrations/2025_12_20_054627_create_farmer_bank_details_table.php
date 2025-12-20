<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('farmer_bank_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('bank_name');
            $table->string('account_holder_name');
            $table->string('account_number');
            $table->string('ifsc_code', 11);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farmer_bank_details');
    }
};
