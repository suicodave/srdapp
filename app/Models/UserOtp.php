<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vonage\Client;
use Vonage\SMS\Message\SMS;
class UserOtp extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'otp', 'expire_at'];

    public function sendSMS($receiverNumber)
    {

        $newPhoneNumber = "63" . substr($receiverNumber, 1);
        $message = "Login OTP is ".$this->otp;

        $basic = new \Vonage\Client\Credentials\Basic(env('VONAGE_KEY',null), env('VONAGE_SECRET',null));
        $client = new Client($basic);
        $response = $client->sms()
            ->send(new SMS("$newPhoneNumber",env('VONAGE_SMS_FROM',null),"$message"));
        $message = $response->current();
        if($message->getStatus() == 0){
            echo "The message was sent successfully!\n";
        }else{
            echo "The message failed with status:" .$message->getStatus() ."\n";
        }

    }
}
