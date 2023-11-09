<?php 
namespace app\Services\API;

use App\Interfaces\API\SdPaidThroughInterface;
use App\Interfaces\API\SdPaidThroughServiceInterface;

class SdPaidThroughServices implements  SdPaidThroughServiceInterface
{

private $SdPaidThroughInterface;

public function __construct(SdPaidThroughInterface $SdPaidThroughInterface) 
{
    $this->SdPaidThroughInterface = $SdPaidThroughInterface;
}
public function getSdPaidThroughList()
{
   $SdPaidThroughList = $this->SdPaidThroughInterface->getSdPaidThroughList();
    if(!empty($SdPaidThroughList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'SdPaid Through List';
        $response['SdPaidThroughList'] = $SdPaidThroughList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function storeSdPaidThrough($request)
{
  $storeSdPaidThrough = $this->SdPaidThroughInterface->storeSdPaidThrough($request);
  if(!empty($storeSdPaidThrough))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'SdPaid Through Added';
      $response['sdpaidThroughId'] = $storeSdPaidThrough;      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;   
}

public function editSdPaidThrough($request)
{
  $editSdPaidThrough = $this->SdPaidThroughInterface->editSdPaidThrough($request);
  if(!empty($editSdPaidThrough))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'SdPaid Through updated';      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;  
}

public function setDeleteSdPaidThrough($SdPaidThroughId)
{
  $DeleteSdPaidThrough = $this->SdPaidThroughInterface->setDeleteSdPaidThrough($SdPaidThroughId);
    if($DeleteSdPaidThrough==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'SdPaid Through is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to Delete';
    return $response;
}



}

?>