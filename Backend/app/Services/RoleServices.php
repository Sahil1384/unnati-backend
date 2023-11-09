<?php 
namespace app\Services;

use App\Interfaces\RoleInterface;
use App\Interfaces\RoleServiceInterface;

class RoleServices implements  RoleServiceInterface
{
private $RoleInterface;

    public function __construct(RoleInterface $RoleInterface) 
    {
        $this->RoleInterface = $RoleInterface;
    }
    public function getRoleList()
    {
       $getRoleList = $this->RoleInterface->getRoleList();
        if(!empty($getRoleList))
        {
            $response['isSuccess'] = true;
            $response['message'] = 'Role List';
            $response['roleList'] = $getRoleList;
            return $response;
        }    
        $response['isSuccess'] = false;
        $response['message'] = 'Sorry, No record found';
        return $response; 

    }
    public function createNewRole($request)
    {
      return $this->RoleInterface->createNewRole($request);
    }
    public function editRole($request)
    {
      return $this->RoleInterface->editRole($request);
    }
    public function rolePermissionList($request)
    {
        return $this->RoleInterface->rolePermissionList($request);
    }
    public function updateRolePermission($request)
    {
        return $this->RoleInterface->updateRolePermission($request);
    }

}

?>