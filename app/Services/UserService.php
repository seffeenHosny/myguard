<?php

namespace App\Services;

use App\Libraries\PushNotification;
use App\Models\Notification;
use App\Models\User;
use App\Repositories\UserRepository;
use Auth;

class UserService
{

    protected $user, $center_time, $user_service_department;
    public $push;
    public function __construct(User $user)
    {
        // $this->user = $user;
        $this->user = new UserRepository($user);
        $this->push = new PushNotification();
    }


    /************************************/
    /**
     * UnAuthenticated Users.
     */
    /************************************/

    /**
     * Forgot Password Email.
     *
     * @return mixed
     */

    public function generatePasswordCode($phone , $message = null )
    {
        return $this->user->generatePasswordCode($phone , $message);
    }

    public function generatePhoneCode($phone , $message = null)
    {
        return $this->user->generatePhoneCode($phone , $message);
    }

    /**
     * Reset password.
     *
     * @return mixed
     */

    public function resetPassword($request)
    {
        return $this->user->resetPassword($request);
    }
    /**
     * Verfiy Account.
     *
     * @return mixed
     */

    public function verifyAccount($request)
    {
        return $this->user->verifyAccount($request);
    }
    /************************************/
    /**
     * Authenticated Users.
     */
    /************************************/

    /**
     * change password.
     *
     * @return mixed
     */

    public function changePassword($id , $old_password, $new_password)
    {
        return $this->user->changePassword($id , $old_password, $new_password);
    }


    public function verifyNewPhone($request)
    {
        return $this->user->verifyNewPhone($request);
    }

    public function verifyCode($code)
    {
        return $this->user->verifyCode($code);
    }

    /************************************/
    /**
     *Users In Dashboard.
     */
    /************************************/
    /**
     *Get All Users With its Details.
     */
    public function getUsersWhereType($type)
    {
        return $this->user->getWhereType($type);
    }


    public function storeUser($request)
    {
        return $this->user->storeUser($request);

    }

    public function showUser($id)
    {
        return $this->user->showUser($id);
    }
    public function showUserWithRelation($id,$relation)
    {

        return $this->user->showUserWithRelation($id,$relation);
    }
    /**
     *Edit User By Id And Its Details.
     */
    public function updateUser($id, $request)
    {
        return $this->user->updateUser($id, $request);
    }

    public function updateCv($id, $request)
    {
        return $this->user->updateCv($id, $request);
    }
    /**
     *
     *Add provider Finance By Id And Its Details.
     */
    public function storeFinance($id, $data)
    {
        $user = $this->showUser($id);
        return $this->user->storeFinance($user, $data);
    }

    /**
     *Delete Users By Id And Its Details.
     */
    public function destroyUser($id)
    {
        return $this->user->destroy($id);
    }

    public function updateUserData($key , $value , $code = null ){
        return $this->user->updateUserData($key , $value , $code);
    }

    public function sendNotification($user_id, $title, $message , $data_id = null , $screen = '/')
    {
        $notification = Notification::create([
            'title' => $title,
            'message' => $message,
        ]);
        $tokens = User::where('id', $user_id)->first()->fcm_token;
        return $this->push->sendPushNotification('multi', [$tokens], $message, $title, $data_id, $notification->id, $screen);
    }

    public function getGuards($request){
        $users = $this->user->getGuards($request);
        foreach($users as $user){
            if($user->appear != null){
                $user->appear = $user->appear + 1;
            }else{
                $user->appear =1;
            }
            $user->save();
        }

        $data['count'] = count($users);
        $data['guards'] = $users;

        return $data;
    }

    public function getUserNotifications(){
        return $this->user->getUserNotifications();
    }

    public function markNotificationAsRead($readRequest){
        return $this->user->markNotificationAsRead($readRequest) ;
    }

    public function markAllNotificationAsRead(){
        return $this->user ->markAllNotificationAsRead();
    }
}
