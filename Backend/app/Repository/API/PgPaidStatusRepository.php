<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\PgPaidStatusModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\PgPaidStatusInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;
use App\Models\Notification;

class PgPaidStatusRepository implements PgPaidStatusInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getPgPaidStatusList(){ 
        return  $PgPaidStatusModel = PgPaidStatusModel::select('id','name')->where('status',1)->where('is_deleted',0)->get();            
    } 
    
    public function storePgPaidStatus($request)
    {   
        $ZoneCount = PgPaidStatusModel::select('id')->where('name',$request['name'])->count();
        if($ZoneCount == 0){    
        $PgPaidStatusModel = new PgPaidStatusModel;
        $PgPaidStatusModel->name = $request['name'];               
        $PgPaidStatusModel->save();  
        return  $PgPaidStatusModel->id;
        }
        return $ZoneCount;
    }

    public function editPgPaidStatus($request)
    {
        PgPaidStatusModel::where('id', $request->PgPaidStatusId)->update(['name' => $request->name]);
        return true;
    }

    public function setDeletePgPaidStatus($PgPaidStatusId)
    {
        return PgPaidStatusModel::where('id',$PgPaidStatusId)->update(['is_deleted'=>1]);
    }

}
?>