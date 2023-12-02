<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class UserOtp extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'otp', 'expire_at'];

    public function sendSMS($receiverNumber)
    {
        $message = "Login OTP is ".$this->otp;



        try {
            $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
            $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
            $twilio_number = config('app.twilio')['TWILIO_FROM'];
            $client = new Client($accountSid, $authToken);

            //$account_sid = getenv("TWILIO_ACCOUNT_SID");
            //$auth_token = getenv("TWILIO_AUTH_TOKEN");
            //$twilio_number = getenv("TWILIO_FROM");

            //$client = new Client($accountSid, $authToken);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            info('SMS Sent Successfully.');

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
