<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\SdPaidStatusModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\SdPaidStatusInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;
use App\Models\Notification;

class SdPaidStatusRepository implements SdPaidStatusInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getSdPaidStatusList(){ 
        return  $SdPaidStatusModel = SdPaidStatusModel::select('id','name')->where('status',1)->where('is_deleted',0)->get();            
    } 
    
    public function storeSdPaidStatus($request)
    {   
        $ZoneCount = SdPaidStatusModel::select('id')->where('name',$request['name'])->count();
        if($ZoneCount == 0){    
        $SdPaidStatusModel = new SdPaidStatusModel;
        $SdPaidStatusModel->name = $request['name'];               
        $SdPaidStatusModel->save();  
        return  $SdPaidStatusModel->id;
        }
        return $ZoneCount;
    }

    public function editSdPaidStatus($request)
    {
        SdPaidStatusModel::where('id', $request->SdPaidStatusId)->update(['name' => $request->name]);
        return true;
    }

    public function setDeleteSdPaidStatus($SdPaidStatusId)
    {
        return SdPaidStatusModel::where('id',$SdPaidStatusId)->update(['is_deleted'=>1]);
    }

}
?>