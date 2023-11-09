<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\API\SdPaidThroughServices;
use App\Models\SdPaidThroughModel;
use App\Http\Controllers\API\BaseController as BaseController;

class SdPaidThroughController extends BaseController
{
    private $SdPaidThroughServices;
    public function __construct(SdPaidThroughServices $SdPaidThroughServices)
    {
        $this->SdPaidThroughServices = $SdPaidThroughServices;
    }
    public function storeSdPaidThrough(Request $request)
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
        $storeSdPaidThrough = $this->SdPaidThroughServices->storeSdPaidThrough($request->all());

            if($storeSdPaidThrough['isSuccess']==true)
            {   
             return $this->sendResponse($storeSdPaidThrough, $storeSdPaidThrough['message']);
            }
            return $this->sendError('error', $storeSdPaidThrough['message']); 
    }

    public function getSdPaidThroughList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',           
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $SdPaidThrough =  $this->SdPaidThroughServices->getSdPaidThroughList();
         if($SdPaidThrough['isSuccess']==false)
        {
            return $this->sendError('error', $SdPaidThrough['message']);
        }
        return $this->sendResponse($SdPaidThrough, $SdPaidThrough['message']);
    }

    public function setDeleteSdPaidThrough(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'sdpaidthroughId' => 'required|numeric|exists:App\Models\SdPaidThroughModel,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteSdPaidThrough = $this->SdPaidThroughServices->setDeleteSdPaidThrough($request->sdpaidthroughId);
        if($setDeleteSdPaidThrough['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteSdPaidThrough['message']);
        }
        return $this->sendResponse($setDeleteSdPaidThrough, $setDeleteSdPaidThrough['message']);
    }

    public function editSdPaidThrough(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required',
            'sdpaidthroughId' => 'required|unique:unti_sdpaidThrough,name,'.$request->name,            
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $editSdPaidThrough = $this->SdPaidThroughServices->editSdPaidThrough($request);
        if($editSdPaidThrough['isSuccess']==false)
        {
            return $this->sendError('error', $editSdPaidThrough['message']);
        }
        return $this->sendResponse($editSdPaidThrough, $editSdPaidThrough['message']);       
    }

}
