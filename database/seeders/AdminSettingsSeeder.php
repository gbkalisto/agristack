<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // GENERAL
            ['key' => 'site_name', 'value' => 'My Website'],
            ['key' => 'site_url', 'value' => 'https://example.com'],
            ['key' => 'logo', 'value' => ''],
            ['key' => 'favicon', 'value' => ''],
            ['key' => 'timezone', 'value' => 'Asia/Kolkata'],
            ['key' => 'default_language', 'value' => 'en'],

            // EMAIL
            ['key' => 'mail_driver', 'value' => 'smtp'],
            ['key' => 'mail_host', 'value' => 'smtp.mailtrap.io'],
            ['key' => 'mail_port', 'value' => '2525'],
            ['key' => 'mail_username', 'value' => 'null'],
            ['key' => 'mail_password', 'value' => 'null'],
            ['key' => 'mail_encryption', 'value' => 'tls'],
            ['key' => 'mail_from_address', 'value' => 'noreply@example.com'],
            ['key' => 'mail_from_name', 'value' => 'My Website'],

            // SECURITY
            ['key' => 'maintenance_mode', 'value' => 'off'],
            ['key' => 'password_min_length', 'value' => '8'],
            ['key' => 'max_login_attempts', 'value' => '5'],
            ['key' => 'lockout_duration', 'value' => '15'],

            // USER SETTINGS
            ['key' => 'default_user_role', 'value' => 'user'],
            ['key' => 'allow_user_registration', 'value' => 'yes'],
            ['key' => 'user_email_verification', 'value' => 'yes'],

            // SEO
            ['key' => 'meta_title', 'value' => 'Welcome to My Website'],
            ['key' => 'meta_description', 'value' => 'This is the default meta description.'],
            ['key' => 'meta_keywords', 'value' => 'website, laravel, seo'],
        ];

        foreach ($settings as $setting) {
            DB::table('admin_settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
