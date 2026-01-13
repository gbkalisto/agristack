<?php

namespace App\Services;

class Fast2SmsService
{
    protected $apiKey;
    protected $senderId;
    protected $templateId;

    public function __construct()
    {
        $this->apiKey      = config('services.fast2sms.api_key');
        $this->senderId   = config('services.fast2sms.sender_id');
        $this->templateId = config('services.fast2sms.template_id');
    }

    public function sendOtp($mobile, $otp)
    {
        $dateTime = now()->format('d-m-Y h:i A');
        $minutes  = 5;

        $variables = implode('|', [
            $otp,
            $dateTime,
            $minutes
        ]);

        $url = "https://www.fast2sms.com/dev/bulkV2?" . http_build_query([
            'authorization'    => $this->apiKey,
            'route'            => 'dlt',
            'sender_id'        => $this->senderId,
            'message'          => $this->templateId,
            'variables_values' => $variables,
            'flash'            => 0,
            'numbers'          => $mobile
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
