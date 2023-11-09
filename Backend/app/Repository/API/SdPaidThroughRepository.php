<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\SdPaidThroughModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\SdPaidThroughInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;
use App\Models\Notification;

class SdPaidThroughRepository implements SdPaidThroughInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getSdPaidThroughList(){ 
        return  $SdPaidThroughModel = SdPaidThroughModel::select('id','name')->where('status',1)->where('is_deleted',0)->get();            
    } 
    
    public function storeSdPaidThrough($request)
    {   
        $ZoneCount = SdPaidThroughModel::select('id')->where('name',$request['name'])->count();
        if($ZoneCount == 0){    
        $SdPaidThroughModel = new SdPaidThroughModel;
        $SdPaidThroughModel->name = $request['name'];               
        $SdPaidThroughModel->save();  
        return  $SdPaidThroughModel->id;
        }
        return $ZoneCount;
    }

    public function editSdPaidThrough($request)
    {
        SdPaidThroughModel::where('id', $request->sdpaidthroughId)->update(['name' => $request->name]);
        return true;
    }

    public function setDeleteSdPaidThrough($SdPaidThroughId)
    {
        return SdPaidThroughModel::where('id',$SdPaidThroughId)->update(['is_deleted'=>1]);
    }

}
?>