<?php 
namespace app\Services\API;

use App\Interfaces\API\ProjectTypeInterface;
use App\Interfaces\API\ProjectTypeServiceInterface;

class ProjectTypeServices implements  ProjectTypeServiceInterface
{

private $ProjectTypeInterface;

public function __construct(ProjectTypeInterface $ProjectTypeInterface) 
{
    $this->ProjectTypeInterface = $ProjectTypeInterface;
}
public function getProjectTypeList()
{
   $ProjectTypeList = $this->ProjectTypeInterface->getProjectTypeList();
    if(!empty($ProjectTypeList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'Project Type List';
        $response['ProjectTypeList'] = $ProjectTypeList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function storeProjectType($request)
{
  $storeProjectType = $this->ProjectTypeInterface->storeProjectType($request);
  if(!empty($storeProjectType))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'Project Type Added';
      $response['ProjectTypeId'] = $storeProjectType;      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;   
}

public function editProjectType($request)
{
  $editProjectType = $this->ProjectTypeInterface->editProjectType($request);
  if(!empty($editProjectType))
  {
      $response['isSuccess'] = true;
      $response['message'] = 'Project Type updated';      
      return $response;
  }
   $response['isSuccess'] = false;
   $response['message'] = 'Sorry, Something went wrong';
   return $response;  
}

public function setDeleteProjectType($ProjectTypeId)
{
  $DeleteProjectType = $this->ProjectTypeInterface->setDeleteProjectType($ProjectTypeId);
    if($DeleteProjectType==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'Project Type is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to Delete';
    return $response;
}



}

?>