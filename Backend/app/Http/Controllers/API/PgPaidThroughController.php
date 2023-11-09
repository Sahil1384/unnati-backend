<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\API\PgPaidThroughServices;
use App\Models\PgPaidThroughModel;
use App\Http\Controllers\API\BaseController as BaseController;

class PgPaidThroughController extends BaseController
{
    private $PgPaidThroughServices;
    public function __construct(PgPaidThroughServices $PgPaidThroughServices)
    {
        $this->PgPaidThroughServices = $PgPaidThroughServices;
    }
    public function storePgPaidThrough(Request $request)
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
        $storePgPaidThrough = $this->PgPaidThroughServices->storePgPaidThrough($request->all());

            if($storePgPaidThrough['isSuccess']==true)
            {   
             return $this->sendResponse($storePgPaidThrough, $storePgPaidThrough['message']);
            }
            return $this->sendError('error', $storePgPaidThrough['message']); 
    }

    public function getPgPaidThroughList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',           
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $PgPaidThrough =  $this->PgPaidThroughServices->getPgPaidThroughList();
         if($PgPaidThrough['isSuccess']==false)
        {
            return $this->sendError('error', $PgPaidThrough['message']);
        }
        return $this->sendResponse($PgPaidThrough, $PgPaidThrough['message']);
    }

    public function setDeletePgPaidThrough(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'pgpaidthroughId' => 'required|numeric|exists:App\Models\PgPaidThroughModel,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeletePgPaidThrough = $this->PgPaidThroughServices->setDeletePgPaidThrough($request->pgpaidthroughId);
        if($setDeletePgPaidThrough['isSuccess']==false)
        {
            return $this->sendError('error', $setDeletePgPaidThrough['message']);
        }
        return $this->sendResponse($setDeletePgPaidThrough, $setDeletePgPaidThrough['message']);
    }

    public function editPgPaidThrough(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required',
            'pgpaidthroughId' => 'required|unique:unti_pgpaidthrough,name,'.$request->name,            
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $editPgPaidThrough = $this->PgPaidThroughServices->editPgPaidThrough($request);
        if($editPgPaidThrough['isSuccess']==false)
        {
            return $this->sendError('error', $editPgPaidThrough['message']);
        }
        return $this->sendResponse($editPgPaidThrough, $editPgPaidThrough['message']);       
    }

}
