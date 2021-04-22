<?php

namespace App\Classes;

use Nexmo\Laravel\Facade\Nexmo;

class SendCode
{
    public static function sendCode($mobile, $name){
        $code=rand(11111,99999);
        Nexmo::message()->send([
            'to'   => '+88'.$mobile,
            'from' => config('app.name', 'Laravel'),
            'text' => "Dear {$name}, Your CAAB HCC account verification code is: {$code}"
        ]);
        return $code;
    }
}
