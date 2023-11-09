<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\API\ProjectTypeServices;
use App\Models\ProjectTypeModel;
use App\Http\Controllers\API\BaseController as BaseController;

class ProjectTypeController extends BaseController
{
    private $ProjectTypeServices;
    public function __construct(ProjectTypeServices $ProjectTypeServices)
    {
        $this->ProjectTypeServices = $ProjectTypeServices;
    }
    public function storeProjectType(Request $request)
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
        $storeProjectType = $this->ProjectTypeServices->storeProjectType($request->all());

            if($storeProjectType['isSuccess']==true)
            {   
             return $this->sendResponse($storeProjectType, $storeProjectType['message']);
            }
            return $this->sendError('error', $storeProjectType['message']); 
    }

    public function getProjectTypeList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',           
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $ProjectType =  $this->ProjectTypeServices->getProjectTypeList();
         if($ProjectType['isSuccess']==false)
        {
            return $this->sendError('error', $ProjectType['message']);
        }
        return $this->sendResponse($ProjectType, $ProjectType['message']);
    }

    public function setDeleteProjectType(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'projecttypeId' => 'required|numeric|exists:App\Models\ProjectTypeModel,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteProjectType = $this->ProjectTypeServices->setDeleteProjectType($request->projecttypeId);
        if($setDeleteProjectType['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteProjectType['message']);
        }
        return $this->sendResponse($setDeleteProjectType, $setDeleteProjectType['message']);
    }

    public function editProjectType(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required',
            'projecttypeId' => 'required|unique:unti_projecttype,name,'.$request->name,            
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $editProjectType = $this->ProjectTypeServices->editProjectType($request);
        if($editProjectType['isSuccess']==false)
        {
            return $this->sendError('error', $editProjectType['message']);
        }
        return $this->sendResponse($editProjectType, $editProjectType['message']);       
    }

}
