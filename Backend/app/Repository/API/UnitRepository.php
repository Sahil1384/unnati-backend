<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\UnitModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\UnitInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;


use App\Models\Notification;

class UnitRepository implements UnitInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getUnitList(){ 
        return  $UnitModel = UnitModel::select('id','name')->where('status',1)->where('is_deleted',0)->get();            
    } 
    
    public function storeUnit($request)
    {   
        $ZoneCount = UnitModel::select('id')->where('name',$request['name'])->count();
        if($ZoneCount == 0){    
        $UnitModel = new UnitModel;
        $UnitModel->name = $request['name'];               
        $UnitModel->save();  
        return  $UnitModel->id;
        }
        return $ZoneCount;
    }

    public function editUnit($request)
    {
        UnitModel::where('id', $request->UnitId)->update(['name' => $request->name]);
        return true;
    }

    public function setDeleteUnit($UnitId)
    {
        return UnitModel::where('id',$UnitId)->update(['is_deleted'=>1]);
    }

}
?>