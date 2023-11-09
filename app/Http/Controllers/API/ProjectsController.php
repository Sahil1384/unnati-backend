<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\API\ProjectsServices;
use App\Http\Requests\API\ProjectsRequest;
use App\Models\Project;


class ProjectsController extends BaseController
{

    private $ProjectsServices;
    public function __construct(ProjectsServices $ProjectsServices)
    {
        $this->ProjectsServices = $ProjectsServices;
    }
    public function storeProjectFirst(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'serialNumber' => 'required',
            'project_title' => 'required',            
            'projectDescription' => 'required',
            'railwayZone' => 'required',
            'workStatus' => 'required',
            'fileNo' => 'required',
            'tenderNo' => 'required',
            'tenderDate' => 'required|date',
            'tenderQty' => 'required',
            'poNoLoaNo' => 'required',
            'poDateLoaDate' => 'required|date',
            'poLoaQty' => 'required',
            'unit' => 'required',            
            'startDate' => 'required|date',
            'completionDate' => 'required|date',
            'dpExtension' => 'required',
            'dpExtensionRemark' => 'required',
           
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $storeProjectFirst = $this->ProjectsServices->storeProjectFirst($request->all());

        if($storeProjectFirst['isSuccess']==true)
        {   
         return $this->sendResponse($storeProjectFirst, $storeProjectFirst['message']);
        }
        return $this->sendError('error', $storeProjectFirst['message']);       

    }


    public function storeProjectSecond(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'project_id' =>'required|numeric|exists:App\Models\Project,id',
            'basicPerUnit' => 'required',        
            'basicTotal' => 'required',
            'packagingPerUnit' => 'required',
            'packegingTotal' => 'required',
            'freightPerUnit' => 'required',
            'freightTotal' => 'required',
            'gstPerUnit' => 'required',
            'gstTotal' => 'required',
            'installationPerUnit' => 'required',
            'installationTotal' => 'required',
            'other' => 'required',
            'loaPoValue' => 'required',
           
        ]);
        if ($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());
        }
        $storeProjectSecond = $this->ProjectsServices->storeProjectSecond($request->all());
        if($storeProjectSecond['isSuccess']==true)
        {   
         return $this->sendResponse($storeProjectSecond, $storeProjectSecond['message']);
        }
        return $this->sendError('error', $storeProjectSecond['message']);  
    }

    public function storeProjectThird(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'project_id' =>'required|numeric|exists:App\Models\Project,id',
            'emdToPay' => 'required',
            'emdPaidStatus' => 'required',
            'emdPaidAmount' => 'required',
            'emdPaidDate' => 'required|date',
            'emdTransactionDetails' => 'required',
            'emdReturnAmount' => 'required',
            'emdReturnDate' => 'required|date',
            'emdDue' => 'required',
            'emdReturnRemark' => 'required',
           
        ]);
        if ($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());
        }
        $storeProjectThird = $this->ProjectsServices->storeProjectThird($request->all());
        if($storeProjectThird['isSuccess']==true)
        {   
         return $this->sendResponse($storeProjectThird, $storeProjectThird['message']);
        }
        return $this->sendError('error', $storeProjectThird['message']);  
    }

    
    public function storeProjectForth(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'project_id' =>'required|numeric|exists:App\Models\Project,id',
            'sdToPay' => 'required',
            'sdPaidStatus' => 'required',
            'sdAmountPaid' => 'required',
            'emdAdjustedAmount' => 'required',
            'sdPaidThrough' => 'required',
            'sdTransactionDetails' => 'required',
            'sdPaidDate' => 'required|date',
            'sdExpiryDate' => 'required|date',
            'sdReturnAmount' => 'required',
            'sdReturnDate' => 'required|date',
            'sdDue' => 'required',
            'sdReturnRemark' => 'required',
           
        ]);
        if ($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());
        }
        $storeProjectForth = $this->ProjectsServices->storeProjectForth($request->all());
        if($storeProjectForth['isSuccess']==true)
        {   
         return $this->sendResponse($storeProjectForth, $storeProjectForth['message']);
        }
        return $this->sendError('error', $storeProjectForth['message']);  
    }

    public function storeProjectFifth(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'project_id' =>'required|numeric|exists:App\Models\Project,id',
            'pgToPay' => 'required',
            'pgPaidStatus' => 'required',
            'pgPaidAmount' => 'required',
            'pgPaidDate' => 'required|date',
            'pgTrasactionDetails' => 'required',
            'pgPaidThrough' => 'required',
            'pgReturnAmount' => 'required',
            'pgReturnDate' => 'required|date',
            'pgDue' => 'required',
            'pgReturnRemark' => 'required',           
           
        ]);
        if ($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());
        }
        $storeProjectFifth = $this->ProjectsServices->storeProjectFifth($request->all());
        if($storeProjectFifth['isSuccess']==true)
        {   
         return $this->sendResponse($storeProjectFifth, $storeProjectFifth['message']);
        }
        return $this->sendError('error', $storeProjectFifth['message']);  
    }
    public function storeProjectSixth(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'project_id' =>'required|numeric|exists:App\Models\Project,id',           
            'paymentTerms' => 'required',
            'contractSigningAuthority' => 'required',
            'inspectionAgency' => 'required',
            'InspectionCaseNo' => 'required',
            'inspectionDate' => 'required|date',
            'ritesIcDetails' => 'required',
            'ritesIcStatus' => 'required',
            'invoiceNo' => 'required',
            'invoiceDate' => 'required|date',
            'invoiceQty' => 'required',
            'invoiceAmount' => 'required',
            'materialAcceptedRejected' => 'required',
            'invoiceDetailsFile' => 'required',           
           
        ]);
        if ($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());
        }
        $storeProjectSixth = $this->ProjectsServices->storeProjectSixth($request->all());
        if($storeProjectSixth['isSuccess']==true)
        {   
         return $this->sendResponse($storeProjectSixth, $storeProjectSixth['message']);
        }
        return $this->sendError('error', $storeProjectSixth['message']);  
    }
    public function storeProjectSeventh(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'project_id' =>'required|numeric|exists:App\Models\Project,id',
            'rNoteNo' => 'required',
            'rNoteDate' => 'required|date',
            'paymentStatus' => 'required',
            'paymentReceivedDate' => 'required|date',
            'amountReceives' => 'required',
            'againstShortFitmentDeducted' => 'required',
            'againstMaterialDeducted' => 'required',
            'storeDepositDeducted' => 'required',
            'ldDeducted' => 'required',
            'penaltyDeducted' => 'required',
            'sdDeducted' => 'required',
            'TDS' => 'required',
            'gstDeducted' => 'required',
            'primaryCssSurcharge' => 'required',
            'otherDeduction' => 'required',
            'totalDeduction' => 'required',
            'paymentDue' => 'required',  
            
        ]);
        if ($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());
        }
        $storeProjectSeventh = $this->ProjectsServices->storeProjectSeventh($request->all());
        if($storeProjectSeventh['isSuccess']==true)
        {   
         return $this->sendResponse($storeProjectSeventh, $storeProjectSeventh['message']);
        }
        return $this->sendError('error', $storeProjectSeventh['message']);  
    }



    public function getProjectsList(Request $request){  

        $ProjectsList =  $this->ProjectsServices->getProjectsList($request);
         if($ProjectsList['isSuccess']==false)
        {
            return $this->sendError('error', $ProjectsList['message']);
        }
        return $this->sendResponse($ProjectsList, $ProjectsList['message']);
    }

    public function getProjectsDropDown(Request $request){  

        $getProjectsDropDown =  $this->ProjectsServices->getProjectsDropDown($request);
         if($getProjectsDropDown['isSuccess']==false)
        {
            return $this->sendError('error', $getProjectsDropDown['message']);
        }
        return $this->sendResponse($getProjectsDropDown, $getProjectsDropDown['message']);
    }
    public function setDeleteProject(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'project_id' => 'required|numeric|exists:App\Models\Project,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteProject = $this->ProjectsServices->setDeleteProject($request);
        if($setDeleteProject['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteProject['message']);
        }
        return $this->sendResponse($setDeleteProject, $setDeleteProject['message']);
    }


    public function updateProjectImage(Request $request)
    {

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [           
            'project_id' => 'required|numeric|exists:App\Models\Project,id',
            'image' => 'required'        
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }
        $updateProjectImage = $this->ProjectsServices->updateProjectImage($request->all());

            if($updateProjectImage['isSuccess']==true)
            {   
             return $this->sendResponse($updateProjectImage, $updateProjectImage['message']);
            }
            return $this->sendError('error', $updateProjectImage['message']); 
    }
}