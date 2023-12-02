<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Twilio\Rest\Client;


class UserOtp extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'otp', 'expire_at'];

    public function sendSMS($receiverNumber)
    {
        $message = "Login OTP is ".$this->otp;

        $account_sid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $auth_token  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $twilio_number = config('app.twilio')['TWILIO_APP_SID'];


        $client = new client($account_sid, $auth_token);
        $msg = $client->messages->create("+639762147193",[
            "body" => $message,
            "from" => $twilio_number,
         ]);

         print($msg->accountSid);
         dd($message);

    }
}
