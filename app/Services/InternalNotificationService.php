<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
use App\Interfaces\API\AccountInterface;

class InternalNotificationService 
{
    private $AccountInterface;

    public function __construct(AccountInterface $AccountInterface)
    {
        $this->AccountInterface = $AccountInterface;
        
    }

    public function storeNotification($notificationData)
    {
        return $this->AccountInterface->storeNotification($notificationData);
        
    }

    public function updateReadStatus($request)
    {
        $isNotificationRead = $this->AccountInterface->updateNotificationReadStatus($request);
        if($isNotificationRead==true){
            $response['isSuccess'] = true;
            $response['message'] = 'Notification read successfully.';
            return $response;
        }
        $response['isSuccess'] = false;
        $response['message'] = 'Notification is not read successfully.';
        return $response;
    }

    public function getAllNotifications($request)
    {
        $allNotificatios = $this->AccountInterface->getMyAllNotifications($request); 
        if(count($allNotificatios)==0)
        {
            $response['isSuccess'] = true;
            $response['message'] = 'No notification found.';
            $response['count'] = 0;
            $response['notifications'] = $allNotificatios;
            return $response;
        }
        $response['isSuccess'] = true;
        $response['message'] = 'Notification found.';
        $response['count'] = count($allNotificatios);
        $response['notifications'] = $allNotificatios;
        return $response;
    }
    

}


?>