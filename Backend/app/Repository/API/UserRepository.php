<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Interfaces\API\UserInterface;
use App\Services\Images\ImageServices;
use App\Models\AssignMemberOnProject;


use App\Models\Notification;

class UserRepository implements UserInterface
{
    private $imageService;
    
    public function __construct(ImageServices $imageService ) {
        $this->imageService = $imageService;
    }

    public function addNewUser($inputData)
    {
        
      $user_id = $inputData['user_id'];
      $admin =  User::select('name')->where('id',$user_id)->first();
    
        $base64ImageCode = $inputData['profileimage'];
        if(!empty($base64ImageCode)){
        $imageUploadPath = 'assets/images/projects';
        $newImageName = str_replace(' ', '_', $inputData['name']);
        $uploadedImageName = $this->imageService->uploadImage($base64ImageCode, $imageUploadPath, $newImageName);
        $inputData['profileimage'] = $imageUploadPath . '/' . $uploadedImageName;       
        }
        $password = "User@2023";
        $inputData['password'] = md5($password);
        $inputData['first_time'] = 0;  
        $user = User::create($inputData); 

        $isMailSent = $this->sendMail($user,$password,$admin);      
        $isMailSent = $this->sendAdminMail($user,$admin);   

        if(!empty($inputData['assignProject'])){
            $this->addAssignProjectData($user->id, $inputData['assignProject']);
        }       
        return $user;
}


public function addAssignProjectData($userId,$assignProject)
{     
    foreach ($assignProject as $key => $project) {
        $projectCount = AssignMemberOnProject::select('id')->where('project_id',$project)->where('member_id',$userId)->count();
        if($projectCount == 0){
        $AssignMemberOnProject = new AssignMemberOnProject;
        $AssignMemberOnProject['project_id'] = $project;
        $AssignMemberOnProject['member_id'] = $userId;          
        $AssignMemberOnProject->save();
    }
}

}

public function updateUserData($inputData)
{
    
  $userid = $inputData['user_id'];
  $updateuserid = $inputData['id'];
  $admin =  User::select('name')->where('id',$userid)->first();
  $user =  User::select('name')->where('id',$updateuserid)->first();


    $base64ImageCode = $inputData['profileimage'];
    if(!empty($base64ImageCode)){
    $imageUploadPath = 'assets/images/projects';
    $newImageName = str_replace(' ', '_', $inputData['name']);
    $uploadedImageName = $this->imageService->uploadImage($base64ImageCode, $imageUploadPath, $newImageName);
    $inputData['profileimage'] = $imageUploadPath . '/' . $uploadedImageName;       
    }
    else{
        $inputData['profileimage'] = $user['profileimage'];
    }


    $updatearray = array('name' => $inputData['name'],'email' => $inputData['email'],'designation' => $inputData['designation'],'profileimage' => $inputData['profileimage'], 'phone' => $inputData['phone'], 'reporting_person' => $inputData['reporting_person'], 'joining_date' => $inputData['joining_date']);
   
   
    User::where('id',$updateuserid)->update($updatearray);
    
    if(!empty($inputData['assignProject'])){
        $this->addAssignProjectData($user->id, $inputData['assignProject']);
    } 
   
     
    // $isMailSent = $this->sendMail($user,$password,$admin);      
    // $isMailSent = $this->sendAdminMail($user,$admin);   
    return true;
}

public function sendMail($user,$password,$admin){
   
    $mail_data = ['name' => $user['name'], 'email' => $user['email'], 'password' => "$password", 'admin' => $admin['name']];
    $to = "deepakumar760@gmail.com";
    $successEmail = Mail::send('vendor.newUserAdded', $mail_data, function ($message) use ($to) {
        $message->to($to, 'Gym Mail')->subject('OTP Verification Mail');
        $message->from('security-noreply@fojfit.com', 'OTP Verification Mail Services');
    });

    return true;
}

public function sendAdminMail($user,$admin){   
    $mail_data = ['user' => $user,'admin' => $admin['name']];
    $to = "deepakumar760@gmail.com";
    $successEmail = Mail::send('vendor.adminNotification', $mail_data, function ($message) use ($to) {
        $message->to($to, 'Gym Mail')->subject('OTP Verification Mail');
        $message->from('security-noreply@fojfit.com', 'OTP Verification Mail Services');
    });

    return true;
}


public function getUserDropDown($roleId){  
    return User::select('users.id','users.name','users.email','users.phone','users.profileimage','roles.name as userDesignation')
    ->join('roles', 'roles.id', '=', 'users.designation')
    ->where('users.is_deleted',0)
    ->where('users.first_time',1)
    ->get();
}

public function getUserList($request){  

    $Users = User::select('users.id','users.name','users.email','users.phone','users.profileimage','roles.name as userDesignation')
    ->join('roles', 'roles.id', '=', 'users.designation')
    ->where(function($query) use($request) {
        $query->orWhere('users.name','like', '%'.$request.'%');
    })   
    ->where('users.is_deleted',0)
    ->where('users.first_time',1)

    ->where('users.designation',3)->get();

    $topLevel = User::select('users.id','users.name','users.email','users.phone','users.profileimage','roles.name as userDesignation')
    ->join('roles', 'roles.id', '=', 'users.designation')
    ->where('users.is_deleted',0)
    ->where('users.first_time',1)
    ->where('users.designation','<',3)->get();
    $response['topLevel'] = $topLevel;
    $response['User'] = $Users;

    return $response;
}

public function updateUserImage($inputData)
{
    $userId = $inputData['user_id'];       
    $base64ImageCode = $inputData['image'];
    $imageUploadPath = 'assets/images/users';
    $newImageName = str_replace(' ', '_', $userId.'user');         
    $uploadedImageName = $this->imageService->uploadImage($base64ImageCode, $imageUploadPath, $newImageName);
    $uploadedImagePath = $imageUploadPath . '/' . $uploadedImageName;   
    return User::where('id',$userId)->update(['profileimage'=>$uploadedImagePath]);

}
public function setDeleteUser($userId)
{
    return User::where('id',$userId)->update(['is_deleted'=>1]);
}

public function getUserEditDetails($userId){  
    return User::select('id','name','phone','profileimage','email','designation','reporting_person','joining_date')->where('id',$userId)->first();
}
  
}
?>