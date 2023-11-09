<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\RailwayZoneModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\RailwayZoneInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;


use App\Models\Notification;

class RailwayZoneRepository implements RailwayZoneInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getRailwayZoneList(){ 
        return  $RailwayZoneModel = RailwayZoneModel::select('id','name')->where('status',1)->where('is_deleted',0)->get();            
    } 
    
    public function storeRailwayZone($request)
    {   
        $ZoneCount = RailwayZoneModel::select('id')->where('name',$request['name'])->count();
        if($ZoneCount == 0){    
        $RailwayZoneModel = new RailwayZoneModel;
        $RailwayZoneModel->name = $request['name'];               
        $RailwayZoneModel->save();  
        return  $RailwayZoneModel->id;
        }
        return $ZoneCount;
    }

    public function editRailwayZone($request)
    {
        RailwayZoneModel::where('id', $request->railwayZoneId)->update(['name' => $request->name]);
        return true;
    }

    public function setDeleteRailwayZone($RailwayZoneId)
    {
        return RailwayZoneModel::where('id',$RailwayZoneId)->update(['is_deleted'=>1]);
    }

}
?>