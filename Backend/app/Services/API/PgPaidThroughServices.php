<?php 
namespace app\Services\API;

use App\Interfaces\API\PgPaidThroughInterface;
use App\Interfaces\API\PgPaidThroughServiceInterface;

class PgPaidThroughServices implements  PgPaidThroughServiceInterface
{

private $PgPaidThroughInterface;

public function __construct(PgPaidThroughInterface $PgPaidThroughInterface) 
{
    $this->PgPaidThroughInterface = $PgPaidThroughInterface;
}
public function getPgPaidThroughList()
{
   $PgPaidThroughList = $this->PgPaidThroughInterface->getPgPaidThroughList();
    if(!empty($PgPaidThroughList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'PgPaid Through List';
        $response['PgPaidThroughList'] = $PgPaidThroughList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function storePgPaidThrough($request)
{
  $storePgPaidThrough = $this->PgPaidThroughInterface->storePgPaidThrough($request);
  if(!empty($storePgPaidThrough))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'PgPaid Through Added';
      $response['PgpaidThroughId'] = $storePgPaidThrough;      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;   
}

public function editPgPaidThrough($request)
{
  $editPgPaidThrough = $this->PgPaidThroughInterface->editPgPaidThrough($request);
  if(!empty($editPgPaidThrough))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'PgPaid Through updated';      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;  
}

public function setDeletePgPaidThrough($PgPaidThroughId)
{
  $DeletePgPaidThrough = $this->PgPaidThroughInterface->setDeletePgPaidThrough($PgPaidThroughId);
    if($DeletePgPaidThrough==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'PgPaid Through is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to Delete';
    return $response;
}



}

?>