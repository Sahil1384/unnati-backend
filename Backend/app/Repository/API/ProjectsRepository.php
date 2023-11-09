<?php 
namespace App\Repository\API;

use JWTAuth;
use App\Models\Project;
use App\Models\User;
use App\Models\Notification;
use App\Models\AssignMemberOnProject;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use App\Interfaces\API\ProjectsInterface;
use App\Services\Images\ImageServices;
use App\Services\PushNotificationService;
use App\Services\InternalNotificationService;

class ProjectsRepository implements ProjectsInterface
{
    private $imageService;
    private $pushNotificationService;
    private $internalNotificationService;
    
    public function __construct(ImageServices $imageService, PushNotificationService $pushNotificationService, InternalNotificationService $internalNotificationService) {
        $this->imageService = $imageService;
        $this->pushNotificationService = $pushNotificationService;
        $this->internalNotificationService = $internalNotificationService;
    }

    public function storeProjectFirst($inputData)
    {
        $Project = new Project;
        $Project->serialNumber = $inputData['serialNumber'];
        $Project->project_title = $inputData['project_title'];
        $Project->projectDescription = $inputData['projectDescription'];
        $Project->railwayZone = $inputData['railwayZone'];
        $Project->workStatus = $inputData['workStatus'];
        $Project->fileNo = $inputData['fileNo'];
        $Project->tenderNo = $inputData['tenderNo'];
        $Project->tenderDate = $inputData['tenderDate'];
        $Project->tenderQty = $inputData['tenderQty'];
        $Project->poNoLoaNo = $inputData['poNoLoaNo'];
        $Project->poDateLoaDate = $inputData['poDateLoaDate'];
        $Project->poLoaQty = $inputData['poLoaQty'];
        $Project->unit = $inputData['unit']; 
        $Project->startDate = $inputData['startDate']; 
        $Project->completionDate = $inputData['completionDate'];       
        $Project->dpExtension = $inputData['dpExtension']; 
        $Project->dpExtensionRemark = $inputData['dpExtensionRemark']; 
        $Project->created_by = $inputData['user_id'];
             
        $Project->save();             
    
       $user = User::select('id','name','phone','email','fcm_token')->where('id',1)->first();
       $title = "New Project Onboard";
       $msg_body = "You joined ".$user->name;
       $fcm_token = $user->fcm_token;
       $route = 'projectOnBoard';
       $this->pushNotificationService->sendPushNotification($title,$msg_body,$fcm_token,$route);
       $notificationData = array();
       $notificationData['notification_by_id'] = $user->id;
       $notificationData['notification_by_name'] = $user->name;
       $notificationData['notification_to_id'] = $user->id;
       $notificationData['notification_to_name'] = $user->name;
       $notificationData['notification_to_type'] = 'user';
       $notificationData['notification_message'] = $msg_body;
       $notificationData['route'] = $route;
       $notificationData['created_at'] = date('Y-m-d H:i:s');
       $notificationData['updated_at'] = date('Y-m-d H:i:s');
       $notificationDetails = $this->internalNotificationService->storeNotification($notificationData);
       
       return $Project->id;

    }

    public function storeProjectSecond($inputData)
    {
       $projectId = $inputData['project_id'];

        $updatearray = array(
            'basicPerUnit' => $inputData['basicPerUnit'],
            'basicTotal' => $inputData['basicTotal'],
            'packagingPerUnit' => $inputData['packagingPerUnit'],
            'packegingTotal' => $inputData['packegingTotal'],
            'freightPerUnit' => $inputData['freightPerUnit'],
            'freightTotal' => $inputData['freightTotal'],
            'gstPerUnit' => $inputData['gstPerUnit'],
            'gstTotal' => $inputData['gstTotal'],
            'installationPerUnit' => $inputData['installationPerUnit'],
            'installationTotal' => $inputData['installationTotal'],
            'other' => $inputData['other'],
            'loaPoValue' => $inputData['loaPoValue']); 

            Project::where('id',$projectId)->update($updatearray);
       
       return $projectId;

    }

    public function storeProjectThird($inputData)
    {
       $projectId = $inputData['project_id'];

      
        $updatearray = array(

            'emdToPay' => $inputData['emdToPay'],
            'emdPaidStatus' => $inputData['emdPaidStatus'],
            'emdPaidAmount' => $inputData['emdPaidAmount'],
            'emdPaidDate' => $inputData['emdPaidDate'],
            'emdTransactionDetails' => $inputData['emdTransactionDetails'],
            'emdReturnAmount' => $inputData['emdReturnAmount'],
            'emdReturnDate' => $inputData['emdReturnDate'],
            'emdDue' => $inputData['emdDue'],
            'emdReturnRemark' => $inputData['emdReturnRemark']); 

            Project::where('id',$projectId)->update($updatearray);
       
       return $projectId;

    }
    public function storeProjectForth($inputData)
    {
       $projectId = $inputData['project_id'];
        $updatearray = array(
            'sdToPay' => $inputData['sdToPay'],
            'sdPaidStatus' => $inputData['sdPaidStatus'],
            'sdAmountPaid' => $inputData['sdAmountPaid'],
            'emdAdjustedAmount' => $inputData['emdAdjustedAmount'],
            'sdPaidThrough' => $inputData['sdPaidThrough'],
            'sdTransactionDetails' => $inputData['sdTransactionDetails'],
            'sdPaidDate' => $inputData['sdPaidDate'],
            'sdExpiryDate' => $inputData['sdExpiryDate'],
            'sdReturnAmount' => $inputData['sdReturnAmount'],
            'sdReturnDate' => $inputData['sdReturnDate'],
            'sdDue' => $inputData['sdDue'],
            'sdReturnRemark' => $inputData['sdReturnRemark']); 
            Project::where('id',$projectId)->update($updatearray);
       
       return $projectId;

    }

    public function storeProjectFifth($inputData)
    {
       $projectId = $inputData['project_id'];
        $updatearray = array(
            'pgToPay' => $inputData['pgToPay'],
            'pgPaidStatus' => $inputData['pgPaidStatus'],
            'pgPaidAmount' => $inputData['pgPaidAmount'],
            'pgPaidDate' => $inputData['pgPaidDate'],
            'pgTrasactionDetails' => $inputData['pgTrasactionDetails'],
            'pgPaidThrough' => $inputData['pgPaidThrough'],
            'pgReturnAmount' => $inputData['pgReturnAmount'],
            'pgReturnDate' => $inputData['pgReturnDate'],
            'pgDue' => $inputData['pgDue'],
            'pgReturnRemark' => $inputData['pgReturnRemark'],
           ); 
            Project::where('id',$projectId)->update($updatearray);
       
       return $projectId;

    }
    public function storeProjectSixth($inputData)
    {
        $projectId = $inputData['project_id'];
        $base64invoice = $inputData['invoiceDetailsFile'];
        $imageUploadPath = 'assets/images/Projects';
        $invoiceDetailsFile = str_replace(' ', '_', $projectId.'invoiceDef');         
        $uploadedinvoiceFile = $this->imageService->uploadImage($base64invoice, $imageUploadPath, $invoiceDetailsFile);
        $invoiceDetailsFile = $imageUploadPath . '/' . $uploadedinvoiceFile;
        
        $base64paymentTerms = $inputData['paymentTerms'];
        $paymentTerms = str_replace(' ', '_', $projectId.'paymentTerms');         
        $uploadedpaymenttermFile = $this->imageService->uploadImage($base64paymentTerms, $imageUploadPath, $paymentTerms);
        $paymentTerms = $imageUploadPath . '/' . $uploadedpaymenttermFile;
        $updatearray = array(
            'paymentTerms' => $paymentTerms,
            'contractSigningAuthority' => $inputData['contractSigningAuthority'],
            'inspectionAgency' => $inputData['inspectionAgency'],
            'InspectionCaseNo' => $inputData['InspectionCaseNo'],
            'inspectionDate' => $inputData['inspectionDate'],
            'ritesIcDetails' => $inputData['ritesIcDetails'],
            'ritesIcStatus' => $inputData['ritesIcStatus'],
            'invoiceNo' => $inputData['invoiceNo'],
            'invoiceDate' => $inputData['invoiceDate'],
            'invoiceQty' => $inputData['invoiceQty'],
            'invoiceAmount' => $inputData['invoiceAmount'],
            'materialAcceptedRejected' => $inputData['materialAcceptedRejected'],
            'invoiceDetailsFile' => $invoiceDetailsFile); 
            Project::where('id',$projectId)->update($updatearray);
       
       return $projectId;

    }
    public function storeProjectSeventh($inputData)
    {
       $projectId = $inputData['project_id'];
        $updatearray = array(
            'rNoteNo' => $inputData['rNoteNo'],
            'rNoteDate' => $inputData['rNoteDate'],
            'paymentStatus' => $inputData['paymentStatus'],
            'paymentReceivedDate' => $inputData['paymentReceivedDate'],
            'amountReceives' => $inputData['amountReceives'],
            'againstShortFitmentDeducted' => $inputData['againstShortFitmentDeducted'],
            'againstMaterialDeducted' => $inputData['againstMaterialDeducted'],
            'storeDepositDeducted' => $inputData['storeDepositDeducted'],
            'ldDeducted' => $inputData['ldDeducted'],
            'penaltyDeducted' => $inputData['penaltyDeducted'],
            'sdDeducted' => $inputData['sdDeducted'],
            'TDS' => $inputData['TDS'],
            'gstDeducted' => $inputData['gstDeducted'],
            'primaryCssSurcharge' => $inputData['primaryCssSurcharge'],
            'otherDeduction' => $inputData['otherDeduction'],
            'totalDeduction' => $inputData['totalDeduction'],
            'paymentDue' => $inputData['paymentDue'],
            'projectStatus' => 1,
            'is_completed' => 1); 
            Project::where('id',$projectId)->update($updatearray);
       
       return $projectId;

    }


    public function storeProject($inputData)
    {
        $Project = new Project;
        $Project->project_name = $inputData['project_name'];
        $Project->project_title = $inputData['project_title'];
        $Project->description = $inputData['description'];
        $Project->no_of_days = $inputData['no_of_days'];
        $Project->budget_rate = $inputData['budget_rate'];
        $Project->purchase_order = $inputData['purchase_order'];
        $Project->comment = $inputData['comment'];
        $Project->project_type = $inputData['project_type'];
        $Project->invoice_time = $inputData['invoice_time'];
        $Project->priority = $inputData['priority'];
        $Project->additional_fields = json_encode($inputData['additional_fields']);
        $Project->start_date = $inputData['start_date'];
        $Project->end_date = $inputData['end_date'];       
        $base64ImageCode = $inputData['image'];

        if(!empty($base64ImageCode)){
        $imageUploadPath = 'assets/images/projects';
        $newImageName = str_replace(' ', '_', $inputData['project_name']);
        $uploadedImageName = $this->imageService->uploadImage($base64ImageCode, $imageUploadPath, $newImageName);
        $uploadedImagePath = $imageUploadPath . '/' . $uploadedImageName;
        $Project->image = $uploadedImagePath;
        }
        $Project->save(); 
        if(!empty($inputData['project_member'])){
            $this->addAssignMemberData($Project->id, $inputData['project_member']);
        }       
    
       $user = User::select('id','name','phone','email','fcm_token')->where('id',1)->first();
       $title = "New Project Onboard";
       $msg_body = "You joined ".$user->name;
       $fcm_token = $user->fcm_token;
       $route = 'projectOnBoard';
       $this->pushNotificationService->sendPushNotification($title,$msg_body,$fcm_token,$route);
       $notificationData = array();
       $notificationData['notification_by_id'] = $user->id;
       $notificationData['notification_by_name'] = $user->name;
       $notificationData['notification_to_id'] = $user->id;
       $notificationData['notification_to_name'] = $user->name;
       $notificationData['notification_to_type'] = 'user';
       $notificationData['notification_message'] = $msg_body;
       $notificationData['route'] = $route;
       $notificationData['created_at'] = date('Y-m-d H:i:s');
       $notificationData['updated_at'] = date('Y-m-d H:i:s');
       $notificationDetails = $this->internalNotificationService->storeNotification($notificationData);
       return $Project->id;

    }

    public function addAssignMemberData($projectId,$project_member)
    {     
        foreach ($project_member as $key => $member) {
            $AssignMemberOnProject = new AssignMemberOnProject;
            $AssignMemberOnProject['project_id'] = $projectId;
            $AssignMemberOnProject['member_id'] = $member;          
            $AssignMemberOnProject->save();
        }

    }

    public function getProjectsDropDown($request){ 
        return  $projectData = Project::select('id','project_title')->where('is_deleted',0)->where('is_completed',1)->get();            
    } 


    public function getProjectsList($request){ 
        return  $projectData = Project::select('id','project_name','project_title','image','priority','purchase_order','start_date','end_date')->where('is_deleted',0)->get();            
    } 

    public function setDeleteProject($projectId)
    {
        return Project::where('id',$projectId)->update(['is_deleted'=>1]);
    }

    public function updateProjectImage($inputData)
    {

        $projectId = $inputData['project_id'];       
        $base64ImageCode = $inputData['image'];
        $imageUploadPath = 'assets/images/projects';
        $newImageName = str_replace(' ', '_', $projectId.'project');         
        $uploadedImageName = $this->imageService->uploadImage($base64ImageCode, $imageUploadPath, $newImageName);
        $uploadedImagePath = $imageUploadPath . '/' . $uploadedImageName;
       
        return Project::where('id',$projectId)->update(['image'=>$uploadedImagePath]);
        
      

    }


  
}
?>