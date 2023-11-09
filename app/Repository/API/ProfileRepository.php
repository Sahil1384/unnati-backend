<?php 
namespace App\Repository\API;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Interfaces\API\ProfileInterface;
use App\Models\User; 
use App\Services\Images\ImageServices;

class ProfileRepository implements ProfileInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }
    public function getUserProfile($request){  
    return User::select('users.id','users.name','users.email','users.phone','users.profileimage','roles.name as userDesignation','users.fcm_token AS user_fcm_token')
    ->join('roles', 'roles.id', '=', 'users.designation')
    ->where('users.id',$request->userId)->first();
    }


 
    
}
?>