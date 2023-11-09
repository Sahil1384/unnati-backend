<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\API\ProfileServices;

class ProfileController extends BaseController
{

    private $ProfileServices;
    public function __construct(ProfileServices $ProfileServices)
    {
        $this->ProfileServices = $ProfileServices;
    }


    public function getUserProfile(Request $request)
    {
        if (empty($request->all())){
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
            'userId' =>'required|numeric'
        ]);
        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $getUserProfile = $this->ProfileServices->getUserProfile($request);
        if($getUserProfile['isSuccess']==false)
        {
            return $this->sendError('error', $getUserProfile['message']);
        }
        return $this->sendResponse($getUserProfile, $getUserProfile['message']);
    }

    
   

}
