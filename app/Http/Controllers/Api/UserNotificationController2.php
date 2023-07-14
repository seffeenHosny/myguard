<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserNotificationReadRequest;
use App\Http\Traits\ResponseTraits;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;


/**
 * @method prepare_response_json($prepare_response)
 */
class UserNotificationController extends Controller
{

    use ResponseTraits;

    /**
     * @return mixed
     */

    private $UserService;
    public function __construct(UserService $UserSer){
        $this->UserService = $UserSer;
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
