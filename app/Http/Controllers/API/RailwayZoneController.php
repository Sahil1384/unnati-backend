<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\API\RailwayZoneServices;
use App\Models\RailwayZoneModel;
use App\Http\Controllers\API\BaseController as BaseController;

class RailwayZoneController extends BaseController
{
    private $RailwayZoneServices;
    public function __construct(RailwayZoneServices $RailwayZoneServices)
    {
        $this->RailwayZoneServices = $RailwayZoneServices;
    }
    public function storeRailwayZone(Request $request)
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
        $storeRailwayZone = $this->RailwayZoneServices->storeRailwayZone($request->all());

            if($storeRailwayZone['isSuccess']==true)
            {   
             return $this->sendResponse($storeRailwayZone, $storeRailwayZone['message']);
            }
            return $this->sendError('error', $storeRailwayZone['message']); 
    }

    public function getRailwayZoneList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',           
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $RailwayZone =  $this->RailwayZoneServices->getRailwayZoneList();
         if($RailwayZone['isSuccess']==false)
        {
            return $this->sendError('error', $RailwayZone['message']);
        }
        return $this->sendResponse($RailwayZone, $RailwayZone['message']);
    }

    public function setDeleteRailwayZone(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'railwayZoneId' => 'required|numeric|exists:App\Models\RailwayZoneModel,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteRailwayZone = $this->RailwayZoneServices->setDeleteRailwayZone($request->railwayZoneId);
        if($setDeleteRailwayZone['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteRailwayZone['message']);
        }
        return $this->sendResponse($setDeleteRailwayZone, $setDeleteRailwayZone['message']);
    }

    public function editRailwayZone(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required',
            'railwayZoneId' => 'required|unique:unti_railway_zone,name,'.$request->name,            
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $editRailwayZone = $this->RailwayZoneServices->editRailwayZone($request);
        if($editRailwayZone['isSuccess']==false)
        {
            return $this->sendError('error', $editRailwayZone['message']);
        }
        return $this->sendResponse($editRailwayZone, $editRailwayZone['message']);       
    }




}
