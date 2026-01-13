<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Fast2SmsService
{
    protected $apiKey;
    protected $senderId;
    protected $route;

    public function __construct()
    {
        $this->apiKey   = config('services.fast2sms.api_key');
        $this->senderId = config('services.fast2sms.sender_id');
        $this->route    = 'dlt';
    }

    /**
     * Send DLT SMS
     */
    public function sendSms($mobile, $templateId, $variables = [])
    {
        // Convert array to pipe separated string
        $variablesValues = implode('|', $variables);

        $response = Http::withHeaders([
            'authorization' => $this->apiKey,
            'accept'        => 'application/json'
        ])->get('https://www.fast2sms.com/dev/bulkV2', [
            'route'            => $this->route,
            'sender_id'       => $this->senderId,
            'message'         => $templateId,
            'variables_values' => $variablesValues,
            'numbers'         => $mobile,
            'flash'           => 0
        ]);

        return $response->json();
    }
}
