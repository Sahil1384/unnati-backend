<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true
        ];

        if(!empty($message)){
            $response['message'] = $message;
        }
        if(!empty($result)){
            $response['response'] = $result;
        }
        return response()->json($response, 200);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 400)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['response'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
