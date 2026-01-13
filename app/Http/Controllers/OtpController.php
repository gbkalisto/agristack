<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Fast2SmsService;

class OtpController extends Controller
{
    public function sendOtp(Fast2SmsService $smsService, Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10'
        ]);

        $otp = rand(100000, 999999);

        return $smsService->sendOtp($request->mobile, $otp);
    }
}
