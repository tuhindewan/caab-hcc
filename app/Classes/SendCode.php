<?php

namespace App\Classes;

use Nexmo\Laravel\Facade\Nexmo;

class SendCode
{
    public static function sendCode($mobile){
        $code=rand(11111,99999);
        Nexmo::message()->send([
            'to'   => '+88'.$mobile,
            'from' => config('app.name', 'Laravel'),
            'text' => "Dear x, CAAB assigned you a role in HCC system. Your login credentials are Username: {$code}"
        ]);
        return $code;
    }
}
