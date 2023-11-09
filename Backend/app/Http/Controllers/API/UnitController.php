<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\API\UnitServices;
use App\Models\UnitModel;
use App\Http\Controllers\API\BaseController as BaseController;

class UnitController extends BaseController
{
    private $UnitServices;
    public function __construct(UnitServices $UnitServices)
    {
        $this->UnitServices = $UnitServices;
    }
    public function storeUnit(Request $request)
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
        $storeUnit = $this->UnitServices->storeUnit($request->all());

            if($storeUnit['isSuccess']==true)
            {   
             return $this->sendResponse($storeUnit, $storeUnit['message']);
            }
            return $this->sendError('error', $storeUnit['message']); 
    }

    public function getUnitList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',           
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $Unit =  $this->UnitServices->getUnitList();
         if($Unit['isSuccess']==false)
        {
            return $this->sendError('error', $Unit['message']);
        }
        return $this->sendResponse($Unit, $Unit['message']);
    }

    public function setDeleteUnit(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'unitId' => 'required|numeric|exists:App\Models\UnitModel,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteUnit = $this->UnitServices->setDeleteUnit($request->unitId);
        if($setDeleteUnit['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteUnit['message']);
        }
        return $this->sendResponse($setDeleteUnit, $setDeleteUnit['message']);
    }

    public function editUnit(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required',
            'unitId' => 'required|unique:unti_units,name,'.$request->name,            
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $editUnit = $this->UnitServices->editUnit($request);
        if($editUnit['isSuccess']==false)
        {
            return $this->sendError('error', $editUnit['message']);
        }
        return $this->sendResponse($editUnit, $editUnit['message']);       
    }

}
