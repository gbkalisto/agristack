<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Fast2SmsService
{
    protected string $apiKey;
    protected string $senderId;
    protected string $route;

    public function __construct()
    {
        $this->apiKey   = config('services.fast2sms.api_key');
        $this->senderId = config('services.fast2sms.sender_id');
        $this->route    = config('services.fast2sms.route');
    }

    /**
     * Send OTP SMS
     */
    public function sendOtp(string $mobile, string $otp): bool
    {
        $message = "Your OTP is {$otp}. Do not share it with anyone.";

        return $this->sendSms($mobile, $message);
    }

    /**
     * Send custom transactional SMS
     */
    public function sendSms(string $mobile, string $message): bool
    {
        try {
            $response = Http::withHeaders([
                'authorization' => $this->apiKey,
                'accept'        => 'application/json',
                'content-type'  => 'application/json',
            ])->post('https://www.fast2sms.com/dev/bulkV2', [
                'route'      => $this->route,
                'sender_id'  => $this->senderId,
                'message'    => $message,
                'numbers'    => $mobile,
            ]);

            if ($response->successful() && $response->json('return') === true) {
                return true;
            }

            Log::error('Fast2SMS Failed', [
                'response' => $response->json()
            ]);

            return false;
        } catch (\Throwable $e) {
            Log::error('Fast2SMS Exception', [
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }
}
