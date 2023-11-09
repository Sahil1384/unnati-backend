<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ProjectsController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\RailwayZoneController;
use App\Http\Controllers\API\UnitController;
use App\Http\Controllers\API\EmdPaidController;
use App\Http\Controllers\API\SdPaidStatusController;
use App\Http\Controllers\API\PgPaidStatusController;
use App\Http\Controllers\API\SdPaidThroughController;
use App\Http\Controllers\API\PgPaidThroughController;
use App\Http\Controllers\API\ProjectTypeController;




Route::post('login', [AuthController::class, 'userLogin']);
Route::post('register', [AuthController::class, 'register']);
Route::post('forgetpassword', [AuthController::class, 'forgetPassword']);
Route::post('otpverification', [AuthController::class, 'otpVerification']);
Route::post('updatepassword', [AuthController::class, 'updatePassword']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('get_user', [AuthController::class, 'get_user']);   
    Route::post('getuserprofile', [ProfileController::class, 'getUserProfile']);  
    
    Route::post('storeprojectfirst', [ProjectsController::class, 'storeProjectFirst']);
    Route::post('storeprojectsecond', [ProjectsController::class, 'storeProjectSecond']);
    Route::post('storeprojectthird', [ProjectsController::class, 'storeProjectThird']);
    Route::post('storeprojectforth', [ProjectsController::class, 'storeProjectForth']);
    Route::post('storeprojectfifth', [ProjectsController::class, 'storeProjectFifth']);
    Route::post('storeprojectsixth', [ProjectsController::class, 'storeProjectSixth']);
    Route::post('storeprojectseventh', [ProjectsController::class, 'storeProjectSeventh']);   
    Route::post('getprojectslist', [ProjectsController::class, 'getProjectsList']);
    Route::post('getprojectsdropdown', [ProjectsController::class, 'getProjectsDropDown']);
    
    Route::post('setdeleteproject', [ProjectsController::class, 'setDeleteProject']);
    Route::post('updateprojectimage', [ProjectsController::class, 'updateProjectImage']);
    Route::post('getrolelist', [RoleController::class, 'getRoleList']);
    Route::post('addnewuser', [UserController::class, 'addNewUser']); 
    Route::post('updateuserimage', [UserController::class, 'updateUserImage']); 
    Route::post('getuserlist', [UserController::class, 'getUserList']); 
    Route::post('getuserdropdown', [UserController::class, 'getUserDropDown']); 
    Route::post('setdeleteuser', [UserController::class, 'setDeleteUser']);
    Route::post('getusereditdetails', [UserController::class, 'getUserEditDetails']);
    Route::post('updateuserdata', [UserController::class, 'updateUserData']);       
    Route::post('storedepartment', [DepartmentController::class, 'storeDepartment']); 
    Route::post('getdepartmentlist', [DepartmentController::class, 'getDepartmentList']);
    Route::post('storerailwayzone', [RailwayZoneController::class, 'storeRailwayZone']);
    Route::post('getrailwayzonelist', [RailwayZoneController::class, 'getRailwayZoneList']);
    Route::post('editrailwayzone', [RailwayZoneController::class, 'editRailwayZone']);
    Route::post('deleterailwayzone', [RailwayZoneController::class, 'setDeleteRailwayZone']);

    Route::post('storeunit', [UnitController::class, 'storeUnit']);
    Route::post('getunitlist', [UnitController::class, 'getUnitList']);
    Route::post('editunit', [UnitController::class, 'editUnit']);
    Route::post('deleteunit', [UnitController::class, 'setDeleteUnit']);
    
    Route::post('storeemdpaid', [EmdPaidController::class, 'storeEmdPaid']);
    Route::post('getemdpaidlist', [EmdPaidController::class, 'getEmdPaidList']);
    Route::post('editemdpaid', [EmdPaidController::class, 'editEmdPaid']);
    Route::post('deleteemdpaid', [EmdPaidController::class, 'setDeleteEmdPaid']);
    
    Route::post('storesdpaidstatus', [SdPaidStatusController::class, 'storeSdPaidStatus']);
    Route::post('getsdpaidstatuslist', [SdPaidStatusController::class, 'getSdPaidStatusList']);
    Route::post('editsdpaidstatus', [SdPaidStatusController::class, 'editSdPaidStatus']);
    Route::post('deletesdpaidstatus', [SdPaidStatusController::class, 'setDeleteSdPaidStatus']);

    Route::post('storesdpaidthrough', [SdPaidThroughController::class, 'storeSdPaidThrough']);
    Route::post('getsdpaidthroughlist', [SdPaidThroughController::class, 'getSdPaidThroughList']);
    Route::post('editsdpaidthrough', [SdPaidThroughController::class, 'editSdPaidThrough']);
    Route::post('deletesdpaidthrough', [SdPaidThroughController::class, 'setDeleteSdPaidThrough']);

    Route::post('storepgpaidstatus', [PgPaidStatusController::class, 'storePgPaidStatus']);
    Route::post('getpgpaidstatuslist', [PgPaidStatusController::class, 'getPgPaidStatusList']);
    Route::post('editpgpaidstatus', [PgPaidStatusController::class, 'editPgPaidStatus']);
    Route::post('deletepgpaidstatus', [PgPaidStatusController::class, 'setDeletePgPaidStatus']);

    Route::post('storepgpaidthrough', [PgPaidThroughController::class, 'storePgPaidThrough']);
    Route::post('getpgpaidthroughlist', [PgPaidThroughController::class, 'getPgPaidThroughList']);
    Route::post('editpgpaidthrough', [PgPaidThroughController::class, 'editPgPaidThrough']);
    Route::post('deletepgpaidthrough', [PgPaidThroughController::class, 'setDeletePgPaidThrough']);


    Route::post('storeprojecttype', [ProjectTypeController::class, 'storeProjectType']);
    Route::post('getprojecttypelist', [ProjectTypeController::class, 'getProjectTypeList']);
    Route::post('editprojecttype', [ProjectTypeController::class, 'editProjectType']);
    Route::post('deleteprojecttype', [ProjectTypeController::class, 'setDeleteProjectType']);

    

    
    


    
    
       
});