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
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
            $table->string('father_name')->nullable()->after('name');
            $table->string('aadhaar', 12)
                ->unique()
                ->nullable()
                ->after('phone');
            $table->date('dob')->nullable()->after('aadhaar');
            $table->enum('gender', ['male', 'female', 'other'])
                ->nullable()
                ->after('dob');
            $table->string('category')->nullable()->after('gender');
            $table->foreignId('district_id')
                ->nullable()
                ->constrained('districts')
                ->nullOnDelete()
                ->after('category');

            /* ---------------- Tracking / Audit Fields ---------------- */

            // Who filled the form
            $table->enum('filled_by', ['self', 'admin_user'])
                ->default('self')
                ->after('district_id');

            // Admin ID if filled by admin
            $table->unsignedBigInteger('filled_by_admin_user_id')
                ->nullable()
                ->after('filled_by');

            // Profile completion flag
            $table->boolean('is_profile_completed')
                ->default(false)
                ->after('filled_by_admin_user_id');

            // Foreign key to admins table
            $table->foreign('filled_by_admin_user_id')
                ->references('id')
                ->on('admin_users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('farmers', function (Blueprint $table) {

                $table->dropForeign(['district_id']);
                $table->dropForeign(['filled_by_admin_user_id']);

                $table->dropColumn([
                    'uuid',
                    'father_name',
                    'aadhaar',
                    'dob',
                    'gender',
                    'category',
                    'district_id',
                    'filled_by',
                    'filled_by_admin_user_id',
                    'is_profile_completed',
                ]);
            });
        });
    }
};
