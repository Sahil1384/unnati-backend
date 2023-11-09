<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\ProjectTypeModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\ProjectTypeInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;
use App\Models\Notification;

class ProjectTypeRepository implements ProjectTypeInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getProjectTypeList(){ 
        return  $ProjectTypeModel = ProjectTypeModel::select('id','name')->where('status',1)->where('is_deleted',0)->get();            
    } 
    
    public function storeProjectType($request)
    {   
        $ZoneCount = ProjectTypeModel::select('id')->where('name',$request['name'])->count();
        if($ZoneCount == 0){    
        $ProjectTypeModel = new ProjectTypeModel;
        $ProjectTypeModel->name = $request['name'];               
        $ProjectTypeModel->save();  
        return  $ProjectTypeModel->id;
        }
        return $ZoneCount;
    }

    public function editProjectType($request)
    {
        ProjectTypeModel::where('id', $request->projecttypeId)->update(['name' => $request->name]);
        return true;
    }

    public function setDeleteProjectType($ProjectTypeId)
    {
        return ProjectTypeModel::where('id',$ProjectTypeId)->update(['is_deleted'=>1]);
    }

}
?>