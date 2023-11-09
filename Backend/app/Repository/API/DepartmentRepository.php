<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\Department;
use App\Models\Department_Member;
use App\Models\Department_Project;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use App\Interfaces\API\DepartmentInterface;
use App\Services\Images\ImageServices;
use App\Models\Notification;
use App\Services\PushNotificationService;
use App\Services\InternalNotificationService;


class DepartmentRepository implements DepartmentInterface
{
    private $imageService;
    private $pushNotificationService;
    private $internalNotificationService;
    
    public function __construct(ImageServices $imageService, PushNotificationService $pushNotificationService, InternalNotificationService $internalNotificationService) {
        $this->imageService = $imageService;
        $this->pushNotificationService = $pushNotificationService;
        $this->internalNotificationService = $internalNotificationService;
    }


    public function storeDepartment($inputData)
    {
        $Department = new Department;
        $Department->name = $inputData['name'];
        $Department->email = $inputData['email'];
        $Department->description = $inputData['description'];
        $Department->department_head = $inputData['department_head']; 
        $Department->created_by = $inputData['user_id']; 
        $Department->save(); 
        
        if(!empty($inputData['department_member'])){
            $this->addDepartmentMemberData($Department->id, $inputData['department_member']);
        }  

        if(!empty($inputData['department_project'])){
            $this->addDepartmentProjectData($Department->id, $inputData['department_project']);
        }      
    
    //    $user = User::select('id','name','phone','email','fcm_token')->where('id',1)->first();
    //    $title = "New Project Onboard";
    //    $msg_body = "You joined ".$user->name;
    //    $fcm_token = $user->fcm_token;
    //    $route = 'projectOnBoard';
    //    $this->pushNotificationService->sendPushNotification($title,$msg_body,$fcm_token,$route);
    //    $notificationData = array();
    //    $notificationData['notification_by_id'] = $user->id;
    //    $notificationData['notification_by_name'] = $user->name;
    //    $notificationData['notification_to_id'] = $user->id;
    //    $notificationData['notification_to_name'] = $user->name;
    //    $notificationData['notification_to_type'] = 'user';
    //    $notificationData['notification_message'] = $msg_body;
    //    $notificationData['route'] = $route;
    //    $notificationData['created_at'] = date('Y-m-d H:i:s');
    //    $notificationData['updated_at'] = date('Y-m-d H:i:s');
    //    $notificationDetails = $this->internalNotificationService->storeNotification($notificationData);
       return $Department->id;

    }

    public function getDepartmentList($request){ 
        $departmentData = Department::select('id','name','description','created_by')
        ->where(function($query) use($request) {
            $query->orWhere('name','like', '%'.$request->search.'%');
        }) 
        ->where('status',1)
        ->where('created_by',$request->user_id)
        ->get();            
    
      $alldepartment = array();
      foreach ($departmentData as $department) {
       $departmentHead = User::where('id',$department->created_by)->select('id','name','email','phone','profileimage')->first(); 
       $departmentMembers = Department_Member::where('department_members.department_id',$department->id)->join('users','users.id','=','department_members.user_id')->select('department_members.id','users.id as user_id','users.profileimage')->get(); 
       $completedCount = Department_Project::where('is_completed',1)->where('department_id',$department->id)->count();
       $pendingCount = Department_Project::where('is_completed',0)->where('department_id',$department->id)->count();
       
       $departments["departmentId"] = $department->id;
       $departments["departmentDetails"] = $department;
       $departments["departmentHead"] = $departmentHead;
       $departments["departmentMembers"] = $departmentMembers;
       $departments["departmentMembersCount"] = count($departmentMembers);
       $departments["departmentCompletedProjects"] = $completedCount;
       $departments["departmentPendingProjects"] = $pendingCount; 
        array_push($alldepartment, $departments);
      
      }
     return $alldepartment;
    
    } 

    public function addDepartmentMemberData($DepartmentId,$Department_member)
    {     
        foreach ($Department_member as $key => $member) {
            $MemberCount = Department_Member::select('id')->where('department_id',$DepartmentId)->where('user_id',$member)->count();
            if($MemberCount == 0){
                $DepartmentMember = new Department_Member;
                $DepartmentMember['department_id'] = $DepartmentId;
                $DepartmentMember['user_id'] = $member; 
                $DepartmentMember['date'] = date('Y-m-d');          
                $DepartmentMember->save();
            }
        }
    }

    public function addDepartmentProjectData($DepartmentId,$Department_Project)
    {     
        foreach ($Department_Project as $key => $project) {
           $ProjectCount = Department_Project::select('id')->where('department_id',$DepartmentId)->where('project_id',$project)->count();
            if($ProjectCount == 0){
                $DepartmentProject = new Department_Project;
                $DepartmentProject['department_id'] = $DepartmentId;
                $DepartmentProject['project_id'] = $project;
                $DepartmentProject['date'] = date('Y-m-d');         
                $DepartmentProject->save();
            }          
        }
    }  
}
?>