<?php

namespace App\Http\Controllers;
use App\Interfaces\RoleServiceInterface;
use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\UserRoleModel;
use App\Http\Controllers\API\BaseController as BaseController;

class RoleController extends BaseController
{
    public function __construct(RoleServiceInterface $RoleServiceInterface) {  
        $this->RoleServiceInterface = $RoleServiceInterface;    
       
    }
    public function getRoleList(){  

        $Role =  $this->RoleServiceInterface->getRoleList();
         if($Role['isSuccess']==false)
        {
            return $this->sendError('error', $Role['message']);
        }
        return $this->sendResponse($Role, $Role['message']);
    }
  
}
