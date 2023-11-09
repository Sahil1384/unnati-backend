<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\API\EmdPaidServices;
use App\Models\EmdPaidModel;
use App\Http\Controllers\API\BaseController as BaseController;

class EmdPaidController extends BaseController
{
    private $EmdPaidServices;
    public function __construct(EmdPaidServices $EmdPaidServices)
    {
        $this->EmdPaidServices = $EmdPaidServices;
    }
    public function storeEmdPaid(Request $request)
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
        $storeEmdPaid = $this->EmdPaidServices->storeEmdPaid($request->all());

            if($storeEmdPaid['isSuccess']==true)
            {   
             return $this->sendResponse($storeEmdPaid, $storeEmdPaid['message']);
            }
            return $this->sendError('error', $storeEmdPaid['message']); 
    }

    public function getEmdPaidList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',           
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $EmdPaid =  $this->EmdPaidServices->getEmdPaidList();
         if($EmdPaid['isSuccess']==false)
        {
            return $this->sendError('error', $EmdPaid['message']);
        }
        return $this->sendResponse($EmdPaid, $EmdPaid['message']);
    }

    public function setDeleteEmdPaid(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'emdpaidId' => 'required|numeric|exists:App\Models\EmdPaidModel,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteEmdPaid = $this->EmdPaidServices->setDeleteEmdPaid($request->emdpaidId);
        if($setDeleteEmdPaid['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteEmdPaid['message']);
        }
        return $this->sendResponse($setDeleteEmdPaid, $setDeleteEmdPaid['message']);
    }

    public function editEmdPaid(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required',
            'emdpaidId' => 'required|unique:unti_EmdPaid,name,'.$request->name,            
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $editEmdPaid = $this->EmdPaidServices->editEmdPaid($request);
        if($editEmdPaid['isSuccess']==false)
        {
            return $this->sendError('error', $editEmdPaid['message']);
        }
        return $this->sendResponse($editEmdPaid, $editEmdPaid['message']);       
    }

}
