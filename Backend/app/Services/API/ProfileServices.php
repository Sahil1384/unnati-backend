<?php 
namespace app\Services\API;

use App\Interfaces\API\ProfileInterface;
use App\Interfaces\API\ProfileServiceInterface;

class ProfileServices implements  ProfileServiceInterface
{

private $ProfileInterface;


public function __construct(ProfileInterface $ProfileInterface) 
{
    $this->ProfileInterface = $ProfileInterface;
}

public function getUserProfile($request)
{
        $getUserProfile = $this->ProfileInterface->getUserProfile($request);
     
        if(!empty($getUserProfile))
        {
            $response['isSuccess'] = true;
            $response['message'] = 'User Profile';
            $response['userProfile'] = $getUserProfile;
            return $response;
        }
    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response;   
}




}

?>