<?php 
namespace app\Services\API;

use App\Interfaces\API\UnitInterface;
use App\Interfaces\API\UnitServiceInterface;

class UnitServices implements  UnitServiceInterface
{

private $UnitInterface;

public function __construct(UnitInterface $UnitInterface) 
{
    $this->UnitInterface = $UnitInterface;
}
public function getUnitList()
{
   $UnitList = $this->UnitInterface->getUnitList();
    if(!empty($UnitList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'Unit List';
        $response['unitList'] = $UnitList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function storeUnit($request)
{
  $storeUnit = $this->UnitInterface->storeUnit($request);
  if(!empty($storeUnit))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'Unit Added';
      $response['unitId'] = $storeUnit;      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;   
}

public function editUnit($request)
{
  $editUnit = $this->UnitInterface->editUnit($request);
  if(!empty($editUnit))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'Unit updated';      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;  
}

public function setDeleteUnit($UnitId)
{
  $DeleteUnit = $this->UnitInterface->setDeleteUnit($UnitId);
    if($DeleteUnit==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'Unit is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to Delete';
    return $response;
}



}

?>