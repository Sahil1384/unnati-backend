<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\API\SdPaidStatusServices;
use App\Models\SdPaidStatusModel;
use App\Http\Controllers\API\BaseController as BaseController;

class SdPaidStatusController extends BaseController
{
    private $SdPaidStatusServices;
    public function __construct(SdPaidStatusServices $SdPaidStatusServices)
    {
        $this->SdPaidStatusServices = $SdPaidStatusServices;
    }
    public function storeSdPaidStatus(Request $request)
    {

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',             
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }
        $storeSdPaidStatus = $this->SdPaidStatusServices->storeSdPaidStatus($request->all());

            if($storeSdPaidStatus['isSuccess']==true)
            {   
             return $this->sendResponse($storeSdPaidStatus, $storeSdPaidStatus['message']);
            }
            return $this->sendError('error', $storeSdPaidStatus['message']); 
    }

    public function getSdPaidStatusList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',           
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $SdPaidStatus =  $this->SdPaidStatusServices->getSdPaidStatusList();
         if($SdPaidStatus['isSuccess']==false)
        {
            return $this->sendError('error', $SdPaidStatus['message']);
        }
        return $this->sendResponse($SdPaidStatus, $SdPaidStatus['message']);
    }

    public function setDeleteSdPaidStatus(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'sdpaidstatusId' => 'required|numeric|exists:App\Models\SdPaidStatusModel,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteSdPaidStatus = $this->SdPaidStatusServices->setDeleteSdPaidStatus($request->sdpaidstatusId);
        if($setDeleteSdPaidStatus['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteSdPaidStatus['message']);
        }
        return $this->sendResponse($setDeleteSdPaidStatus, $setDeleteSdPaidStatus['message']);
    }

    public function editSdPaidStatus(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required',
            'sdpaidstatusId' => 'required|unique:unti_sdpaidstatus,name,'.$request->name,            
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $editSdPaidStatus = $this->SdPaidStatusServices->editSdPaidStatus($request);
        if($editSdPaidStatus['isSuccess']==false)
        {
            return $this->sendError('error', $editSdPaidStatus['message']);
        }
        return $this->sendResponse($editSdPaidStatus, $editSdPaidStatus['message']);       
    }

}
