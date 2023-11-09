<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use App\Interfaces\API\AccountInterface;
use App\Services\Images\ImageServices;
use App\Models\Notification;

class AccountRepository implements AccountInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getUserDetailsByEmail($email)
    {
        return User::where('email', '=', $email)->first();
    }
    public function updateOtpData($id,$otp,$newOtpCount,$todaysDate)
    {
        $user = User::where('id','=',$id)->first();
        $user->otp = $otp;
        $user->daily_otp_count = $newOtpCount;
        $user->updated_at = $todaysDate;
        $user->save();
        if ($user->wasChanged()) 
        {
            return true;
        }
        return false;
    }
    public function updateUserPassword($inputData)
    {
        $user = User::where('email', '=', $inputData['email'])->first();
        $user->password = md5($inputData['newPassword']);
        $user->first_time = 1;
        $user->save();
        if ($user->wasChanged()) 
        {
            return true;
        }
        return false;
    }

    public function storeNotification($notificationData)
    {
        // return Notification::create($notificationData);
        $intNotification = new Notification;
        $intNotification->notification_by_id = $notificationData['notification_by_id'];
        $intNotification->notification_by_name = $notificationData['notification_by_name'];
        $intNotification->notification_to_id = $notificationData['notification_to_id'];
        $intNotification->notification_to_name = $notificationData['notification_to_name'];
        $intNotification->notification_to_type = $notificationData['notification_to_type'];
        $intNotification->notification_message = $notificationData['notification_message'];
        $intNotification->route = $notificationData['route'];
        $intNotification->created_at = $notificationData['created_at'];
        $intNotification->updated_at = $notificationData['updated_at'];
        $intNotification->save();
        return;
    }
    public function updateNotificationReadStatus($request)
    {
        $notification = Notification::where('id', '=', $request['notification_id'])->first();
        $notification->is_read = 1;
        $notification->updated_at = date('Y-m-d H:i:s');
        $notification->save();
        if ($notification->wasChanged()) {
            return true;
        }
        return false;
    }
    public function getNotificationCount($userId, $userType)
    {

        return Notification::where('notification_to_id', '=', $userId)->where('is_read', '=', 0)->where('route', '!=', 'drinkWaterReminder')->where('notification_to_type', '=', $userType)->count();
    }

    public function getMyAllNotifications($request)
    {
        if ($request['user_type'] == 'trainer') {
            return Notification::join('users', 'users.id', '=', 'ftns_internal_notification.notification_by_id')->where('notification_to_id', '=', $request['id'])->where('notification_to_type', '=', $request['user_type'])->select('ftns_internal_notification.*', 'users.photo as receiver_profile')->orderBy('id', 'DESC')->get();

        } else {

            return Notification::join('ftns_trainer', 'ftns_trainer.id', '=', 'ftns_internal_notification.notification_by_id')->where('route', '!=', 'drinkWaterReminder')->where('notification_to_id', '=', $request['id'])->where('notification_to_type', '=', $request['user_type'])->select('ftns_internal_notification.*', 'ftns_trainer.trainer_profile_image as receiver_profile')->orderBy('id', 'DESC')->get();

        }

    }

  
}
?>