<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\API\UserServices;
use App\Models\User;

class UserController extends BaseController
{
    
    private $UserServices;
    public function __construct(UserServices $UserServices)
    {
        $this->UserServices = $UserServices;
    }

    public function addNewUser(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email|max:255|regex:/(.*)@acmeindia\.co/i|unique:users',           
            'designation' => 'required|numeric',
            'profileimage' => 'required',
            'phone' => 'required|numeric|digits:10',
            'reporting_person' => 'required|numeric',
            'joining_date' => 'nullable',  
            'assignProject' => 'nullable',            
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }
        $addNewUser = $this->UserServices->addNewUser($request->all());
            if($addNewUser['isSuccess']==true)
            {   
             return $this->sendResponse($addNewUser, $addNewUser['message']);
            }
            return $this->sendError('error', $addNewUser['message']); 
    }

    public function updateUserData(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'id' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email|max:255|regex:/(.*)@acmeindia\.co/i|unique:users,email,'.$request->id,           
            'designation' => 'required|numeric',
            'profileimage' => 'nullable',
            'phone' => 'required|numeric|digits:10',
            'reporting_person' => 'required|numeric',
            'joining_date' => 'nullable',               
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }
        $updateUserData = $this->UserServices->updateUserData($request->all());
            if($updateUserData['isSuccess']==true)
            {   
             return $this->sendResponse($updateUserData, $updateUserData['message']);
            }
            return $this->sendError('error', $updateUserData['message']); 
    }

    public function updateUserImage(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [           
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'image' => 'required'        
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }
        $updateUserImage = $this->UserServices->updateUserImage($request->all());
            if($updateUserImage['isSuccess']==true)
            {   
             return $this->sendResponse($updateUserImage, $updateUserImage['message']);
            }
            return $this->sendError('error', $updateUserImage['message']); 
    }
    public function setDeleteUser(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
            'duser_id' => 'required|numeric|exists:App\Models\User,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $setDeleteUser = $this->UserServices->setDeleteUser($request);
        if($setDeleteUser['isSuccess']==false)
        {
            return $this->sendError('error', $setDeleteUser['message']);
        }
        return $this->sendResponse($setDeleteUser, $setDeleteUser['message']);
    }

    public function getUserList(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
       
        $getUserList = $this->UserServices->getUserList($request->search);
        if($getUserList['isSuccess']==false)
        {
            return $this->sendError('error', $getUserList['message']);
        }
        return $this->sendResponse($getUserList, $getUserList['message']);       
    }

    public function getUserDropDown(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }
        $roleId = 'user';
        $getUserDropDown = $this->UserServices->getUserDropDown($roleId);
        if($getUserDropDown['isSuccess']==false)
        {
            return $this->sendError('error', $getUserDropDown['message']);
        }
        return $this->sendResponse($getUserDropDown, $getUserDropDown['message']);       
    }

    public function getUserEditDetails(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'user_id' => 'required|numeric|exists:App\Models\User,id',
        ]);

        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $getUserEditDetails = $this->UserServices->getUserEditDetails($request);
        if($getUserEditDetails['isSuccess']==false)
        {
            return $this->sendError('error', $getUserEditDetails['message']);
        }
        return $this->sendResponse($getUserEditDetails, $getUserEditDetails['message']);       
    }
}
