<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\PgPaidThroughModel;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\PgPaidThroughInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;
use App\Models\Notification;

class PgPaidThroughRepository implements PgPaidThroughInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function getPgPaidThroughList(){ 
        return  $PgPaidThroughModel = PgPaidThroughModel::select('id','name')->where('status',1)->where('is_deleted',0)->get();            
    } 
    
    public function storePgPaidThrough($request)
    {   
        $ZoneCount = PgPaidThroughModel::select('id')->where('name',$request['name'])->count();
        if($ZoneCount == 0){    
        $PgPaidThroughModel = new PgPaidThroughModel;
        $PgPaidThroughModel->name = $request['name'];               
        $PgPaidThroughModel->save();  
        return  $PgPaidThroughModel->id;
        }
        return $ZoneCount;
    }

    public function editPgPaidThrough($request)
    {
        PgPaidThroughModel::where('id', $request->PgpaidthroughId)->update(['name' => $request->name]);
        return true;
    }

    public function setDeletePgPaidThrough($PgPaidThroughId)
    {
        return PgPaidThroughModel::where('id',$PgPaidThroughId)->update(['is_deleted'=>1]);
    }

}
?>