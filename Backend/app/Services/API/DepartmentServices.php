<?php 
namespace app\Services\API;

use App\Interfaces\API\DepartmentInterface;
use App\Interfaces\API\DepartmentServiceInterface;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class DepartmentServices implements  DepartmentServiceInterface
{

private $DepartmentInterface;

public function __construct(DepartmentInterface $DepartmentInterface) 
{
    $this->DepartmentInterface = $DepartmentInterface;
}

public function storeDepartment($request)
{
   $storeProject = $this->DepartmentInterface->storeDepartment($request);
   if(!empty($storeProject))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'Department Added';
      
       return $response;
   }

    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}

public function getDepartmentList($request)
{
   $getDepartmentList = $this->DepartmentInterface->getDepartmentList($request);
    if(!empty($getDepartmentList))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'Department List';
        $response['departmentsList'] = $getDepartmentList;
        return $response;
    }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response; 

}





}

?>