<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generate()
    {
        $text = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5);
        Session::put('captcha', $text);

        $img = imagecreate(150, 45);
        $bg  = imagecolorallocate($img, 245, 245, 245);
        $txt = imagecolorallocate($img, 0, 0, 0);
        $line = imagecolorallocate($img, 50, 50, 50);

        imageline($img, 0, rand(20,35), 150, rand(10,30), $line);
        imagestring($img, 5, 40, 14, $text, $txt);

        ob_start();
        imagepng($img);
        $data = ob_get_clean();
        imagedestroy($img);

        return response($data)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'no-store, no-cache');
    }
}
