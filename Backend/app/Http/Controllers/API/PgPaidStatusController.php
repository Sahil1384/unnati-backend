<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\API\PgPaidStatusServices;
use App\Models\PgPaidStatusModel;
use App\Http\Controllers\API\BaseController as BaseController;

class PgPaidStatusController extends BaseController
{
    private $PgPaidStatusServices;
    public function __construct(PgPaidStatusServices $PgPaidStatusServices)
    {
        $this->PgPaidStatusServices = $PgPaidStatusServices;
    }
    public function storePgPaidStatus(Request $request)
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
        $storePgPaidStatus = $this->PgPaidStatusServices->storePgPaidStatus($request->all());

            if($storePgPaidStatus['isSuccess']==true)
            {   
             return $this->sendResponse($storePgPaidStatus, $storePgPaidStatus['message']);
            }
            return $this->sendError('error', $storePgPaidStatus['message']); 
    }

    public function getPgPaidStatusList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',           
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $PgPaidStatus =  $this->PgPaidStatusServices->getPgPaidStatusList();
         if($PgPaidStatus['isSuccess']==false)
        {
            return $this->sendError('error', $PgPaidStatus['message']);
        }
        return $this->sendResponse($PgPaidStatus, $PgPaidStatus['message']);
    }

    public function setDeletePgPaidStatus(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'pgpaidstatusId' => 'required|numeric|exists:App\Models\PgPaidStatusModel,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeletePgPaidStatus = $this->PgPaidStatusServices->setDeletePgPaidStatus($request->pgpaidstatusId);
        if($setDeletePgPaidStatus['isSuccess']==false)
        {
            return $this->sendError('error', $setDeletePgPaidStatus['message']);
        }
        return $this->sendResponse($setDeletePgPaidStatus, $setDeletePgPaidStatus['message']);
    }

    public function editPgPaidStatus(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required',
            'pgpaidstatusId' => 'required|unique:unti_pgpaidstatus,name,'.$request->name,            
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $editPgPaidStatus = $this->PgPaidStatusServices->editPgPaidStatus($request);
        if($editPgPaidStatus['isSuccess']==false)
        {
            return $this->sendError('error', $editPgPaidStatus['message']);
        }
        return $this->sendResponse($editPgPaidStatus, $editPgPaidStatus['message']);       
    }

}
