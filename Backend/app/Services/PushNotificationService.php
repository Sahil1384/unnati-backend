<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
class PushNotificationService 
{
    public function sendPushNotification($title,$msg_body,$fcm_token,$route=null)
    {
        $serverKey = 'AAAA2n5zAuQ:APA91bEU04CxZ-fjqdwfnM5IIggt58ec5XvZ9xIWzB_fUlUq9j63VIlpkrtq9n5kKe7aON6DNsy-YolgIo3qxSp3lR4zRmWqXyT00Puidi-ij449C15N-ncagTG4Acye4RR7zEgF3teU';

        // $token = 'crpYFMFpTnOT-SiQh6DqHo:APA91bFmeCfoS8fq0-l-BpUeSMhX4mbdtx4B56bNgxHG-Q6K24XJEeJMKl4HVEYA-NV2nF6Vg2AANvOLJbLPmx3Dvz5hbswIqmS1OtkjXmy4zKhsXQQf7J0nOfcM3zIurCFdegUZazmk';
        $token = $fcm_token;

        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $notification = [
            'title' =>$title,
            'body' => $msg_body,
            'icon' => 'myIcon', 
            'sound' => 'caller',
            'route' => $route
        ];
        $extraNotificationData = ["message" => $notification,"route" => $route,"payload" => $route];
        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData,
            
        ];
        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        
        if($result === FALSE)
        {
            dd(curl_error($ch));
        }

        curl_close($ch);

    }

}


?>