<?php 
namespace app\Services\API;

use App\Interfaces\API\UserInterface;
use App\Interfaces\API\UserServiceInterface;



class UserServices implements  UserServiceInterface
{

private $UserInterface;

public function __construct(UserInterface $UserInterface) 
{
    $this->UserInterface = $UserInterface;
}


public function addNewUser($request)
{
   $addNewUser = $this->UserInterface->addNewUser($request);
   if(!empty($addNewUser))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'User Added';
      
       return $response;
   }

    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}

public function updateUserData($request)
{
   $updateUserData = $this->UserInterface->updateUserData($request);
   if(!empty($updateUserData))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'User Updated';      
       return $response;
   }

    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}

public function updatePassword($inputData)
{
    $userDetails = $this->UserInterface->getUserDetailsByEmail($inputData['email']);        
    if(empty($userDetails)){
        $response['isSuccess'] = false;
        $response['message'] = "This user is not valid or not registered.";
        return $response;
    }
    $updatePassword = $this->UserInterface->updateUserPassword($inputData);
    $response['isSuccess'] = true;
    $response['message'] = "password updated";
    return $response;
}

public function updateUserImage($request)
{
   $updateUserImage = $this->UserInterface->updateUserImage($request);
   if(!empty($updateUserImage))
   {
       $response['isSuccess'] = true;
       $response['message'] = 'image updated';      
       return $response;
   }
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, Something went wrong';
    return $response;   
}
public function getUserList($request)
{
    $getUserList = $this->UserInterface->getUserList($request);     
    if(!empty($getUserList))
        {
            $response['isSuccess'] = true;
            $response['message'] = 'User List';
            $response['userList'] = $getUserList;
            return $response;
        }
    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response;   
}
public function getUserDropDown($roleId)
{
        $getUserDropDown = $this->UserInterface->getUserDropDown($roleId);     
        if(!empty($getUserDropDown))
        {
            $response['isSuccess'] = true;
            $response['message'] = 'User List';
            $response['userList'] = $getUserDropDown;
            return $response;
        }    
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response;   
}

public function setDeleteUser($request)
{
    $isUserDeleted = $this->UserInterface->setDeleteUser($request->duser_id);
    if($isUserDeleted==1)
    {
        $response['isSuccess'] = true;
        $response['message'] = 'user is deleted';
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Not able to delete user';
    return $response;
}

public function getUserEditDetails($request)
{
    $getUserEditDetails = $this->UserInterface->getUserEditDetails($request->user_id);
    if(!empty($getUserEditDetails))
    {
        $response['isSuccess'] = true;
        $response['message'] = 'single user data';
        $response['editData'] = $getUserEditDetails;
        return $response;
    }
    $response['isSuccess'] = false;
    $response['message'] = 'Sorry, No record found';
    return $response;
}




}

?>