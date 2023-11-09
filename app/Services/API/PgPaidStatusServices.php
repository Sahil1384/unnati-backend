<?php 
namespace app\Services\API;

use App\Interfaces\API\PgPaidStatusInterface;
use App\Interfaces\API\PgPaidStatusServiceInterface;

class PgPaidStatusServices implements  PgPaidStatusServiceInterface
{

private $PgPaidStatusInterface;

public function __construct(PgPaidStatusInterface $PgPaidStatusInterface) 
{
    $this->PgPaidStatusInterface = $PgPaidStatusInterface;
}
public function getPgPaidStatusList()
{
   $PgPaidStatusList = $this->PgPaidStatusInterface->getPgPaidStatusList();
    if(!empty($PgPaidStatusList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'PgPaid Status List';
        $response['PgPaidStatusList'] = $PgPaidStatusList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function storePgPaidStatus($request)
{
  $storePgPaidStatus = $this->PgPaidStatusInterface->storePgPaidStatus($request);
  if(!empty($storePgPaidStatus))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'PgPaid Status Added';
      $response['PgpaidstatusId'] = $storePgPaidStatus;      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;   
}

public function editPgPaidStatus($request)
{
  $editPgPaidStatus = $this->PgPaidStatusInterface->editPgPaidStatus($request);
  if(!empty($editPgPaidStatus))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'PgPaid Status updated';      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;  
}

public function setDeletePgPaidStatus($PgPaidStatusId)
{
  $DeletePgPaidStatus = $this->PgPaidStatusInterface->setDeletePgPaidStatus($PgPaidStatusId);
    if($DeletePgPaidStatus==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'PgPaid Status is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to Delete';
    return $response;
}



}

?>