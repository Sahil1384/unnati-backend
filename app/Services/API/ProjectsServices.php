<?php 
namespace app\Services\API;
use App\Interfaces\API\ProjectsInterface;
use App\Interfaces\API\ProjectsServiceInterface;

class ProjectsServices implements  ProjectsServiceInterface
{

private $ProjectsInterface;

public function __construct(ProjectsInterface $ProjectsInterface) 
{
    $this->ProjectsInterface = $ProjectsInterface;
}

public function storeProjectFirst($request)
{
   $storeProjectFirst = $this->ProjectsInterface->storeProjectFirst($request);
   if(!empty($storeProjectFirst))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'Project Added';
       $response['projectId'] = $storeProjectFirst;
      
       return $response;
   }

    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}

public function storeProjectSecond($request)
{
   $storeProjectSecond = $this->ProjectsInterface->storeProjectSecond($request);
   if(!empty($storeProjectSecond))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'Project Added';
       $response['projectId'] = $storeProjectSecond;      
       return $response;
   }

    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}

public function storeProjectThird($request)
{
   $storeProjectThird = $this->ProjectsInterface->storeProjectThird($request);
   if(!empty($storeProjectThird))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'Project Added';
       $response['projectId'] = $storeProjectThird;      
       return $response;
   }
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}
public function storeProjectForth($request)
{
   $storeProjectForth = $this->ProjectsInterface->storeProjectForth($request);
   if(!empty($storeProjectForth))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'Project Added';
       $response['projectId'] = $storeProjectForth;      
       return $response;
   }
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}
public function storeProjectFifth($request)
{
   $storeProjectFifth = $this->ProjectsInterface->storeProjectFifth($request);
   if(!empty($storeProjectFifth))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'Project Added';
       $response['projectId'] = $storeProjectFifth;      
       return $response;
   }
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}
public function storeProjectSixth($request)
{
   $storeProjectSixth = $this->ProjectsInterface->storeProjectSixth($request);
   if(!empty($storeProjectSixth))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'Project Added';
       $response['projectId'] = $storeProjectSixth;      
       return $response;
   }
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}
public function storeProjectSeventh($request)
{
   $storeProjectSeventh = $this->ProjectsInterface->storeProjectSeventh($request);
   if(!empty($storeProjectSeventh))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'Project Added';
       $response['projectId'] = $storeProjectSeventh;      
       return $response;
   }
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}


public function getProjectsDropDown($request)
{
   $getProjectsDropDown = $this->ProjectsInterface->getProjectsDropDown($request);
    if(!empty($getProjectsDropDown))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'Projects List';
        $response['projectSelect'] = $getProjectsDropDown;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}
public function getProjectsList($request)
{
   $getProjectsList = $this->ProjectsInterface->getProjectsList($request);
    if(!empty($getProjectsList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'Projects List';
        $response['projectsList'] = $getProjectsList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}

public function setDeleteProject($request)
{
    $isProjectDeleted = $this->ProjectsInterface->setDeleteProject($request->project_id);
    if($isProjectDeleted==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'project is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to delete project';
    return $response;
}

public function updateProjectImage($request)
{
   $updateProjectImage = $this->ProjectsInterface->updateProjectImage($request);
   if(!empty($updateProjectImage))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'image updated';      
       return $response;
   }

    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}

}

?>