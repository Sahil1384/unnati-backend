<?php 
namespace app\Services\API;

use App\Interfaces\API\RailwayZoneInterface;
use App\Interfaces\API\RailwayZoneServiceInterface;

class RailwayZoneServices implements  RailwayZoneServiceInterface
{

private $RailwayZoneInterface;

public function __construct(RailwayZoneInterface $RailwayZoneInterface) 
{
    $this->RailwayZoneInterface = $RailwayZoneInterface;
}
public function getRailwayZoneList()
{
   $RailwayZoneList = $this->RailwayZoneInterface->getRailwayZoneList();
    if(!empty($RailwayZoneList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'RailwayZone List';
        $response['RailwayZoneList'] = $RailwayZoneList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function storeRailwayZone($request)
{
  $storeRailwayZone = $this->RailwayZoneInterface->storeRailwayZone($request);
  if(!empty($storeRailwayZone))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'Railway Zone Added';
      $response['railwayZoneId'] = $storeRailwayZone;      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;   
}

public function editRailwayZone($request)
{
  $editRailwayZone = $this->RailwayZoneInterface->editRailwayZone($request);
  if(!empty($editRailwayZone))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'Railway Zone updated';      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;  
}

public function setDeleteRailwayZone($RailwayZoneId)
{
  $DeleteRailwayZone = $this->RailwayZoneInterface->setDeleteRailwayZone($RailwayZoneId);
    if($DeleteRailwayZone==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'Railway Zone is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to Delete';
    return $response;
}



}

?>