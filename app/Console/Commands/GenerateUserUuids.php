<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;

class GenerateUserUuids extends Command
{
    protected $signature = 'users:generate-uuids';
    protected $description = 'Generate UUIDs for users who do not have one';

    public function handle()
    {
        $users =  User::all();
        foreach ($users as $user) {
            $user->uuid = (string) Str::uuid();
            $user->save();
        }
        $this->info('UUIDs generated successfully.');
    }
}
