<?php

namespace App\Http\Controllers;
use App\Http\Requests\Admin\PermissionForm;
use App\Interfaces\PermissionServiceInterface;
use Illuminate\Http\Request;
use App\Models\PermissionModel;
use Session;
class PermissionController extends Controller
{
    public function __construct(PermissionServiceInterface $PermissionServiceInterface) {  
        $this->PermissionServiceInterface = $PermissionServiceInterface;    
        $this->middleware('admin');
    }

    public function getPermissionList(){     
        $Permission =  $this->PermissionServiceInterface->getPermissionList();
        return view('admin.permissionlist')->with('DataList',$Permission);
    }     

    public function createNewPermission(PermissionForm $request){
        $this->PermissionServiceInterface->createNewPermission($request);
        Session::flash('createNewPermission','Permission successfully added!');
        return redirect('admin/permissionlist');
    }

    public function deletePermission(Request $request){   
        PermissionModel::find($request->id)->delete();  
        Session::flash('deletePermission','Permission successfully Deleted!');
        return redirect('admin/permissionlist');
    } 
}
