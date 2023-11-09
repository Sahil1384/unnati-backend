<?php 
namespace App\Repository;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Interfaces\RoleInterface;
use App\Models\RoleModel;
use App\Models\RolePermissionModel;
use App\Models\PermissionModel;
use Session;


class RoleRepository implements RoleInterface
{
    public function getRoleList(){ 
        return  $roleData = RoleModel::select('id','name')->get();            
    } 
    
    public function createNewRole($request)
    {       
        $RoleModel = new RoleModel;
        $RoleModel->name = $request->name; 
        $RoleModel->guard_name = 'web';                 
        $RoleModel->save();  
        return;
    }
    public function editRole($request)
    {
        RoleModel::where('id', $request->id)->update(['name' => $request->name]);
        return;
    }
    public function rolePermissionList($request){ 
       $permissionArry = array();
        $rolepermissions = RolePermissionModel::where('role_id',$request->roleid)->select('permission_id')->get()->toarray();
        foreach($rolepermissions as $permission){
            $rolepermissions1 = $permission['permission_id'];
            array_push($permissionArry,$rolepermissions1);
        }

        $permission = PermissionModel::select('name')->distinct()->get();
        $permissionData = array();
      
        foreach($permission as $value){
           
            $permissionlist = PermissionModel::select('id','slug as name')->where('name',$value->name)->get()->toArray();
            $permissionData1['name']= $value->name;
            $list = array();
            foreach($permissionlist as $plist){
               // dd($list);
                    $list1['id'] = $plist['id'];
                    $list1['name'] = $plist['name'];
                    if (in_array($plist['id'], $permissionArry)){
                        $list1['havePermission'] = 1;
                    }
                    else{
                        $list1['havePermission'] = 0; 
                    } 
                    array_push($list, $list1);     
            }   
            //dd($list);        
            $permissionData1['permissionList']= $list;
               
            array_push($permissionData, $permissionData1);     
        }
        return $permissionData;                           
    } 

    public function updateRolePermission($request)
    {           
        $hasPermission =  RolePermissionModel::where('permission_id', $request->permissionId)->where('role_id',$request->roleId)->count();
       
        if($hasPermission > 0){
            RolePermissionModel::where('permission_id', $request->permissionId)->where('role_id',$request->roleId)->delete();
        }
        else{
            $RolePermissionModel = new RolePermissionModel;
            $RolePermissionModel->permission_id = $request->permissionId; 
            $RolePermissionModel->role_id = $request->roleId;                 
            $RolePermissionModel->save();  
          
        }
        return;
    }
    
}
?>