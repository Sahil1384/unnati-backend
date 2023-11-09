<?php 
namespace app\Services\API;

use App\Interfaces\API\SdPaidStatusInterface;
use App\Interfaces\API\SdPaidStatusServiceInterface;

class SdPaidStatusServices implements  SdPaidStatusServiceInterface
{

private $SdPaidStatusInterface;

public function __construct(SdPaidStatusInterface $SdPaidStatusInterface) 
{
    $this->SdPaidStatusInterface = $SdPaidStatusInterface;
}
public function getSdPaidStatusList()
{
   $SdPaidStatusList = $this->SdPaidStatusInterface->getSdPaidStatusList();
    if(!empty($SdPaidStatusList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'SdPaid Status List';
        $response['SdPaidStatusList'] = $SdPaidStatusList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function storeSdPaidStatus($request)
{
  $storeSdPaidStatus = $this->SdPaidStatusInterface->storeSdPaidStatus($request);
  if(!empty($storeSdPaidStatus))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'SdPaid Status Added';
      $response['sdpaidstatusId'] = $storeSdPaidStatus;      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;   
}

public function editSdPaidStatus($request)
{
  $editSdPaidStatus = $this->SdPaidStatusInterface->editSdPaidStatus($request);
  if(!empty($editSdPaidStatus))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'SdPaid Status updated';      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;  
}

public function setDeleteSdPaidStatus($SdPaidStatusId)
{
  $DeleteSdPaidStatus = $this->SdPaidStatusInterface->setDeleteSdPaidStatus($SdPaidStatusId);
    if($DeleteSdPaidStatus==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'SdPaid Status is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to Delete';
    return $response;
}



}

?>