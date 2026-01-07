<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistryStepService
{
    public static function currentStep()
    {
        $userId = Auth::id();
        $steps = config('registry');

        foreach ($steps as $step => $config) {
            if ($config['table'] === 'users') {
                continue; // Step 1 always exists
            }
            $exists = DB::table($config['table'])
                ->where('user_id', $userId)
                ->exists();

            if (!$exists) {
                return $step;
            }
        }

        return null; // All steps completed
    }
}
