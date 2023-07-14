<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyUpdateProfile;
use App\Http\Requests\GuardFillterRequest;
use App\Http\Requests\updateCvRequest;
use App\Http\Requests\updateGuardProfileRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UserNotificationReadRequest;
use DateTime;

class UserController extends Controller
{
    private $UserService;
    public function __construct(UserService $UserSer){
        $this->UserService = $UserSer;
    }

    public function show($id){
        $user = $this->UserService->showUserWithRelation($id , ['city' , 'jop_type' , 'district']);
        if($user->type == 'guard'){
            if(count($user->subscribe_guard_packages) > 0){
                $user->subscribe_packages = true;
                $guardPackages = $user->subscribe_guard_packages->where('status' , 'active');
                if(count($guardPackages) > 0){
                    foreach($guardPackages as $package){
                        $packageDays = $package->guard_package->no_of_days;
                        $fDate = new DateTime($package->created_at);
                        $tDate = new DateTime();
                        $interval = $fDate->diff($tDate);
                        $days = $interval->format('%a');
                        $reminder[] = $packageDays - $days;
                    }
                    $user->subscribe_package_days = max($reminder);
                }else{
                    $user->subscribe_package_days = 0;
                }
            }else{
                $user->subscribe_packages = false;
                $user->subscribe_package_days = 0;
            }
            unset($user->subscribe_guard_packages);
        }else{
            if(count($user->subscribe_company_packages) > 0 ){
                $user->subscribe_packages = true;
            }else{
                $user->subscribe_packages = false;
            }
            unset($user->subscribe_company_packages);
        }
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.guard'),'data'=>$user ], Response::HTTP_OK);
    }

    public function updateCv(updateCvRequest $request){
        if(auth()->user()->type == 'guard'){
            $user = $this->UserService->updateCv( auth()->user()->id , $request);
            if(count($user->subscribe_guard_packages) > 0){
                $user->subscribe_packages = true;
            }else{
                $user->subscribe_packages = false;
            }
            unset($user->subscribe_guard_packages);
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.guard-edit-cv-message'),'data'=>$user ], Response::HTTP_OK);
        }else{
            return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
        }
    }

    public function updateGuardProfile(updateGuardProfileRequest $request){
        if(auth()->user()->type == 'guard'){
            $user =$this->UserService->updateCv( auth()->user()->id , $request);
            if(count($user->subscribe_guard_packages) > 0){
                $user->subscribe_packages = true;
            }else{
                $user->subscribe_packages = false;
            }
            unset($user->subscribe_guard_packages);
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.guard-edit-cv-message'),'data'=>$user ], Response::HTTP_OK);
        }else{
            return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
        }
        return $request->identification_id;
    }

    public function getGuards(GuardFillterRequest $request){
        $users = $this->UserService->getGuards($request);
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.guards'),'data'=>$users ], Response::HTTP_OK);
    }

    public function companyUpdateProfile(CompanyUpdateProfile $request, User $company)
    {
        $user = $this->UserService->updateUser(auth()->user()->id , $request);
        if(count($user->subscribe_company_packages) > 0){
            $user->subscribe_packages = true;
        }else{
            $user->subscribe_packages = false;
        }
        unset($user->subscribe_company_packages);
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.company-edit-message'),'data'=>$user ], Response::HTTP_OK);

    }

    public function getUserNotifications()
    {
        $notifications = $this->UserService->getUserNotifications();
        return response()->json(['status'=>1 , 'code'=>200 , 'message'=>trans('admin.notifications') , 'data'=>$notifications] ,Response::HTTP_OK);
    }


    /**
     * @param UserNotificationReadRequest $readRequest
     * @return mixed
     */
    public function markNotificationAsRead(UserNotificationReadRequest $readRequest)
    {
        $data = $this->UserService->markNotificationAsRead($readRequest);
        if($data){
            return response()->json(['status'=>1 , 'code'=>200 , 'message'=>trans('admin.notification_read') , 'data'=>null] ,Response::HTTP_OK);
        }else{
            return response()->json(['status'=>0 , 'code'=>400 , 'message'=>trans('admin.something_went_wrong') , 'data'=>null] ,Response::HTTP_OK);
        }
    }

    /**
     * @param UserNotificationReadRequest $readRequest
     * @return mixed
     */
    public function markAllNotificationAsRead()
    {
        $this->UserService->markAllNotificationAsRead();
        return response()->json(['status'=>1 , 'code'=>200 , 'message'=>trans('admin.notification__all_read') , 'data'=>null] ,Response::HTTP_OK);

    }

}
