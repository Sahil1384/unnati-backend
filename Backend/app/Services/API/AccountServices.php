<?php 
namespace app\Services\API;

use App\Interfaces\API\AccountInterface;
use App\Interfaces\API\AccountServiceInterface;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AccountServices implements  AccountServiceInterface
{

private $AccountInterface;

public function __construct(AccountInterface $AccountInterface) 
{
    $this->AccountInterface = $AccountInterface;
}

public function forgetPassword($inputData)
{
    $userDetails = $this->AccountInterface->getUserDetailsByEmail($inputData['email']);
    if(!$userDetails){
        $response['isSuccess'] = false;
        $response['message'] = "This Email ID is either not valid or not registered.";
        return $response;
    }
    $last_otp_date = date('Y-m-d',strtotime($userDetails->updated_at));
    $today = date('Y-m-d');
    if((strtotime($last_otp_date)==strtotime($today)) && ($userDetails->daily_otp_count >=300))
    {
        $response['isSuccess'] = false;
        $response['message'] = "maximum limit of daily otp is exceeded";
        return $response;
    }
    $id = $userDetails->id;
    $otp = $this->generateOtp();
    $newOtpCount = $userDetails->daily_otp_count + 1;
    $todaysDate = date('Y-m-d H:i:s');
    $isUpdateOtpData = $this->AccountInterface->updateOtpData($id,$otp,$newOtpCount,$todaysDate);
    $response['isSuccess'] = $isUpdateOtpData;
        $isMailSent = $this->sendMail($userDetails,$otp);
        $response['isSuccess'] = $isMailSent;
        if($isMailSent == false)
        {
            $response['message'] = "Failed to send OTP on mail.";
        }
        $response['message'] = 'otp sent on email';
        
    return $response;
}

public function sendMail($inputData,$otp)
{
    $mail_data = ['name' => "New User", 'otp' => "$otp"];
    $to = $inputData['email'];
    $successEmail = Mail::send('vendor.accountVerify', $mail_data, function ($message) use ($to) {
        $message->to($to, 'Gym Mail')->subject('OTP Verification Mail');
        $message->from('security-noreply@fojfit.com', 'OTP Verification Mail Services');
    });

    return true;
}
public function generateOtp()
{
    return rand(100000, 999999);
}

public function checkOtp($inputData)
{
    $userDetails = $this->AccountInterface->getUserDetailsByEmail($inputData['email']);
    
    if(empty($userDetails)){
        $response['isSuccess'] = false;
        $response['message'] = "This user is not valid or not registered.";
        return $response;
    }

    $isOtpExpire = $this->isOtpExpired($userDetails->updated_at);
    if($isOtpExpire == false)
    {
        $response['isSuccess'] = false;
        $response['message'] = "Otp expired";
        return $response;
    }
    if($inputData['otp'] != $userDetails->otp)
    {
        $response['isSuccess'] = false;
        $response['message'] = "Please enter a valid OTP";
        return $response;
    }
    $token = JWTAuth::fromUser($userDetails); 
   
    $response['isSuccess'] = true;      
    $response['token'] = $token;
    $response['message'] = "otp checked";
    return $response;
}

public function isOtpExpired($updated_at)
{
    $otp_time = $updated_at;
    $current_time = date('Y-m-d H:i:s');
    $time = round((abs(strtotime($current_time) - strtotime($otp_time))/60),2);
    if($time < 1)
    {
        return true;
    }
    return false;
}

public function updatePassword($inputData)
{
    $userDetails = $this->AccountInterface->getUserDetailsByEmail($inputData['email']);        
    if(empty($userDetails)){
        $response['isSuccess'] = false;
        $response['message'] = "This user is not valid or not registered.";
        return $response;
    }
    $updatePassword = $this->AccountInterface->updateUserPassword($inputData);
    $response['isSuccess'] = true;
    $response['message'] = "password updated";
    return $response;
}

}

?>