<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Fast2SmsService;

class OtpController extends Controller
{
    protected $smsService;
    public function __construct(Fast2SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendOtp()
    {
        $mobile = '7379909947';
        $otp = rand(100000, 999999);

        $templateId = '1107176830539091161';

        $response = $this->smsService->sendSms($mobile, $templateId, [
            'Shubham',
            $otp
        ]);

        return $response;
    }
}
