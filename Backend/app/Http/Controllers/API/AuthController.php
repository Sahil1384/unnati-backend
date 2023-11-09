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
use App\Services\API\AccountServices;


class AuthController extends BaseController
{

    private $AccountServices;
    public function __construct(AccountServices $AccountServices)
    {
        $this->AccountServices = $AccountServices;
    }


    public function register(Request $request)
    {
    	 $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
           // 'email' => 'required|email|max:255|regex:/(.*)@acmeindia\.co/i|unique:users',    
            'email' => 'required|email|unique:users',            
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => md5($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }


    public function userLogin(Request $request)
    {
        if (empty($request->all())){
            return $this->sendError('error', 'json is not valid');
        }
        $validation = Validator::make($request->all(), [
           // 'email' =>'required|max:255|regex:/(.*)@acmeindia\.co/i',   
            'email' =>'required|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',            
            'password' => 'required|string|min:6|max:40|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/',
             ]);
        if ($validation->fails()) {
            return $this->sendError('Error validation', $validation->errors());
        }

        $user = User::where('email', $request->email)->first(); 
        if($user==null){                   
            return $this->sendError('error','Account not found.'); 
        }  
        if($user->password !== md5($request->password))
        {
            return $this->sendError('error','Incorrect Password.'); 
        }
        $token = JWTAuth::fromUser($user); // Generate the token  
       
        if($user->first_time == 0)
        {
            $success["token"] = $token;
            $success["userDetails"] = $user;
            return $this->sendResponse($success, 'firstTime'); 
        }

            
        $success["token"] = $token;
        $success["userDetails"] = $user;
        return $this->sendResponse($success, 'user logedin');

    }
 
    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

		//Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 
    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }

    public function forgetPassword(Request $request)
    {
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }        
        $validation = Validator::make($request->all(), [
             'email' =>'required|min:6|max:40|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
              
        ]);
        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        }

        
        $forgetPassword = $this->AccountServices->forgetPassword($request->all());
        
        if($forgetPassword['isSuccess']==true)
        {
            return $this->sendResponse('', $forgetPassword['message']);
        }
        return $this->sendError('error', $forgetPassword['message']);
    }
    public function otpVerification(Request $request){
     
        if (empty($request->all())) {
            return $this->sendError('error', 'json is not valid');
        }
        
        $validation = Validator::make($request->all(), [
            'email' =>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'otp' => 'required|digits:6',
            ]);

        if($validation->fails()){
            return $this->sendError('Error validation', $validation->errors());       
        } 

        $checkOtp = $this->AccountServices->checkOtp($request->all());
        if($checkOtp['isSuccess']==true)
        {   
            return $this->sendResponse('', $checkOtp['message']);
        }
        return $this->sendError('error', $checkOtp['message']);
    }
    public function updatePassword(Request $request)
    {  
            if (empty($request->all())) {
                return $this->sendError('error', 'json is not valid');
            }
            
            $validation = Validator::make($request->all(), [
                'email' =>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'newPassword' => 'required|string|min:6|max:40|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/',
                'confirmPassword' => 'required_with:newPassword|same:newPassword|string|min:6|max:40|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/',
            ]);
    
            if($validation->fails()){
                return $this->sendError('Error validation', $validation->errors());       
            } 
            $updatePassword = $this->AccountServices->updatePassword($request->all()); 

            if($updatePassword['isSuccess']==true)
            {   
             return $this->sendResponse('', $updatePassword['message']);
            }
            return $this->sendError('error', $updatePassword['message']); 
    }

}