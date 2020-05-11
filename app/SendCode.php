<?php
namespace App;
class SendCode
{
    public static function sendCode($phone)
    {
        $code = rand(1111,9999);
        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => $phone,
            'from' => 'Roga i kopita inc.',
            'text' => 'Kod dlya podtverzhdeniya documenta '.$code,
        ]);
        
        return $code;
    }
}


?>