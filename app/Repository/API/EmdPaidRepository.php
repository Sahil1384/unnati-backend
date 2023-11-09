<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\EmdPaidModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\EmdPaidInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;


use App\Models\Notification;

class EmdPaidRepository implements EmdPaidInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getEmdPaidList(){ 
        return  $EmdPaidModel = EmdPaidModel::select('id','name')->where('status',1)->where('is_deleted',0)->get();            
    } 
    
    public function storeEmdPaid($request)
    {   
        $ZoneCount = EmdPaidModel::select('id')->where('name',$request['name'])->count();
        if($ZoneCount == 0){    
        $EmdPaidModel = new EmdPaidModel;
        $EmdPaidModel->name = $request['name'];               
        $EmdPaidModel->save();  
        return  $EmdPaidModel->id;
        }
        return $ZoneCount;
    }

    public function editEmdPaid($request)
    {
        EmdPaidModel::where('id', $request->emdpaidId)->update(['name' => $request->name]);
        return true;
    }

    public function setDeleteEmdPaid($EmdPaidId)
    {
        return EmdPaidModel::where('id',$EmdPaidId)->update(['is_deleted'=>1]);
    }

}
?>