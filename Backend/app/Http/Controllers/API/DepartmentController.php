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
use App\Services\API\DepartmentServices;
use App\Http\Requests\API\DepartmentRequest;
use App\Models\Department;


class DepartmentController extends BaseController
{

    private $DepartmentServices;
    public function __construct(DepartmentServices $DepartmentServices)
    {
        $this->DepartmentServices = $DepartmentServices;
    }

    public function storeDepartment(Request $request)
    {

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'email' => 'required|email|max:255|regex:/(.*)@acmeindia\.co/i|unique:departments',
            'description' => 'required',
            'department_member' => 'nullable',
            'department_project' => 'nullable',
            'department_head' => 'required|numeric',      
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }
        $storeDepartment = $this->DepartmentServices->storeDepartment($request->all());

            if($storeDepartment['isSuccess']==true)
            {   
             return $this->sendResponse($storeDepartment, $storeDepartment['message']);
            }
            return $this->sendError('error', $storeDepartment['message']); 
    }

    public function getDepartmentList(Request $request){  

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [           
            'user_id' => 'required|numeric|exists:App\Models\User,id'
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        $DepartmentList =  $this->DepartmentServices->getDepartmentList($request);
         if($DepartmentList['isSuccess']==false)
        {
            return $this->sendError('error', $DepartmentList['message']);
        }
        return $this->sendResponse($DepartmentList, $DepartmentList['message']);
    }

    public function setDeleteDepartment(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'Department_id' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteDepartment = $this->DepartmentServices->setDeleteDepartment($request);
        if($setDeleteDepartment['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteDepartment['message']);
        }
        return $this->sendResponse($setDeleteDepartment, $setDeleteDepartment['message']);
    }

    public function updateDepartmentImage(Request $request)
    {

        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [           
            'user_id' => 'required|numeric',
            'image' => 'required'        
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }
        $updateDepartmentImage = $this->DepartmentServices->updateDepartmentImage($request->all());

            if($updateDepartmentImage['isSuccess']==true)
            {   
             return $this->sendResponse($updateDepartmentImage, $updateDepartmentImage['message']);
            }
            return $this->sendError('error', $updateDepartmentImage['message']); 
    }






}