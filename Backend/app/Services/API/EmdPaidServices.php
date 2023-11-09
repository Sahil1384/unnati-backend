<?php 
namespace app\Services\API;

use App\Interfaces\API\EmdPaidInterface;
use App\Interfaces\API\EmdPaidServiceInterface;

class EmdPaidServices implements  EmdPaidServiceInterface
{

private $EmdPaidInterface;

public function __construct(EmdPaidInterface $EmdPaidInterface) 
{
    $this->EmdPaidInterface = $EmdPaidInterface;
}
public function getEmdPaidList()
{
   $EmdPaidList = $this->EmdPaidInterface->getEmdPaidList();
    if(!empty($EmdPaidList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'EmdPaid List';
        $response['EmdPaidList'] = $EmdPaidList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function storeEmdPaid($request)
{
  $storeEmdPaid = $this->EmdPaidInterface->storeEmdPaid($request);
  if(!empty($storeEmdPaid))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'EmdPaid Added';
      $response['EmdPaidId'] = $storeEmdPaid;      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;   
}

public function editEmdPaid($request)
{
  $editEmdPaid = $this->EmdPaidInterface->editEmdPaid($request);
  if(!empty($editEmdPaid))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'EmdPaid updated';      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;  
}

public function setDeleteEmdPaid($EmdPaidId)
{
  $DeleteEmdPaid = $this->EmdPaidInterface->setDeleteEmdPaid($EmdPaidId);
    if($DeleteEmdPaid==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'EmdPaid is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to Delete';
    return $response;
}



}

?>