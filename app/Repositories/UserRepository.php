<?php

namespace App\Repositories;

use App\Helpers\FileHelper;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use App\Models\User;
use App\Models\UserCity;
use Auth;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\SMSHelper;
use App\Models\UserNotification;

class UserRepository
{
    use CrudTrait, ResponseTraits, MainTrait;
    /**
     * @var User
     */
    protected $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * Get all users with type.
     *
     * @return User $user
     */
    public function getWhereType($type)
    {
        return $this->indexWhitConditionTrait($this->model, ['type' => $type]);
    }
    /**
     * Get user by id
     *
     * @param $id
     * @return mixed
     */

    public function showUser($id)
    {
        return $this->showTrait($this->model, $id);
    }
    /**
     * Get user by id
     *
     * @param $id
     * @return mixed
     */
    public function showUserWithRelation($id, $relation)
    {
        return $this->showWithRelationTrait($this->model, $id, $relation);
    }

    public function storeUser($request){
        $data = $request->except('_method' , '_token' , 'image' , 'password' ,'password_confirmation');
        $data['password'] = bcrypt($request->password);
        if($request->type == 'admin'){
            $data['verify_phone'] = 1;
            $data['verify_email'] = 1;
        }
        if($request->hasFile('image')){
            if($request->type == 'admin'){
                $data['verify_phone'] = 1;
                $data['verify_email'] = 1;
                $image_path = FileHelper::upload_file('admins' , $request->image);
            }elseif($request->type == 'guard'){
                $image_path = FileHelper::upload_file('guards' , $request->image);
            }else{
                $image_path = FileHelper::upload_file('companies' , $request->image);
            }
            $data['image'] = $image_path;
        }
        if($request->hasFile('commercial_registration_image')){
            $image_path = FileHelper::upload_file('companies/commercial_registration_image' , $request->commercial_registration_image);
            $data['commercial_registration_image'] = $image_path;
        }
        return $this->storeTrait($this->model ,$data);
    }

    public function updateUser($id, $request){
        $data = $request->except('_method' , '_token' , 'image');
        $user = $this->model->where('id',$id)->first();
        if($request->hasFile('image')){
            if($request->type == 'admin' || $request->type == 'super_admin'){
                $image_path = FileHelper::update_file('admins' , $request->image ,$user->image );
            }elseif($request->type == 'guard'){
                $image_path = FileHelper::update_file('guards' , $request->image ,$user->image);
            }else{
                $image_path = FileHelper::update_file('companies' , $request->image ,$user->image);
            }
            $data['image'] = $image_path;
        }

        if($request->hasFile('commercial_registration_image')){
            $image_path = FileHelper::update_file('companies/commercial_registration_image' , $request->commercial_registration_image ,$user->commercial_registration_image);
            $data['commercial_registration_image'] = $image_path;
        }

        if($request->type == 'super_admin'){
            unset($data['type']);
        }
        return $this->updateTrait($this->model, $id, $data);
    }


    public function updateCv($id, $request){
        $data = $request->except('_method' , '_token' , 'image' , 'identification_id' , 'experience_type');
        $user = $this->model->where('id',$id)->with('cities')->first();

        if($request->experience_type == 'no_experience'){
            $data['no_experience']=1;
            $data['military_experience']=0;
            $data['experience_of_the_filed_of_security']=0;
        }elseif($request->experience_type == 'military_experience'){
            $data['no_experience']=0;
            $data['military_experience']=1;
            $data['experience_of_the_filed_of_security']=0;
        }elseif($request->experience_type == 'experience_of_the_filed_of_security'){
            $data['no_experience']=0;
            $data['military_experience']=0;
            $data['experience_of_the_filed_of_security']=1;
        }

        if($request->hasFile('image')){
            $image_path = FileHelper::update_file('guards' , $request->image ,$user->image);
            $data['image'] = $image_path;
        }

        if($request->hasFile('identification_id')){
            $image_path = FileHelper::update_file('guards/identification_id' , $request->identification_id ,$user->identification_id);
            $data['identification_id'] = $image_path;
        }


        $data['type'] = 'guard';
        return $this->updateTrait($this->model, $id, $data);
    }

    /**
     * Update User
     *
     * @param $data
     * @return User
     */
    public function destroy($id)
    {
        $user = $this->model->where('id',$id)->first();
        if($user->image != null){
            FileHelper::delete_picture($user->image);
        }
        return $this->destroyTrait($this->model, $id);
    }

    /**
     * Forgot Password Email.
     * Generate random password and send it with message
     * @param array $data
     * @return String
     */

    public function generatePasswordCode($phone , $text = null)
    {
        $user = $this->model->where('phone', $phone)->first();
        if ($user != null) {
            $user->code = rand(100000, 999999);
            $user->save();
            $message = new SMSHelper();
            if($text != null){
                $message->sendMessage($text.' '.$user->code , $user->phone);
            }else{
                $message->sendMessage(trans('admin.use_code_change_password').' '.$user->code , $user->phone);
            }
            return $user->code;
        } else {
            return false;
        }
    }

    public function generatePhoneCode($phone , $text = null)
    {
        $user = $this->model->where('id', auth()->user()->id)->first();
        if ($user != null) {
            $user->code = rand(100000, 999999);
            $user->save();
            $message = new SMSHelper();
            if($text != null){
                $message->sendMessage($text.' '.$user->code , $user->phone);
            }else{
                $message->sendMessage(trans('admin.use_code_change_phone').' '.$user->code , $user->phone);
            }
            return $user->code;
        } else {
            return false;
        }
    }

    /**
     * Reset Password
     *
     * @param array $data
     * @return String
     */

    public function resetPassword($request)
    {
        $user = $this->model->where('phone', $request->phone)->where('code' , $request->code)->first();
        if($user != null){
            $user->password = bcrypt($request->password);
            $user->code='';
            $user->save();
            return $user;
        }else{
            return false;
        }
    }
    /**
     * Verfiy Account.
     *
     * @param array $data
     * @return True
     */

    public function verifyAccount($request)
    {
        $user = User::where('phone', $request->phone)
            ->where('code', $request->code)
            ->first();
        if ($user != null) {
            $user->verify_phone= 1;
            $user->code='';
            $user->save();
            return true;
        } else {
            return false;
        }
    }
    /**
     * Authenticated Users.
     */
    /**
     * Change password for user by calling ChangePasswordTrait
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function changePassword($id, $old_password, $new_password)
    {

        return $this->ChangePasswordTrait($this->model, $id, $old_password, $new_password);
    }
    /**
     * Update Profile
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */

    public function storeFinance($user, $data)
    {
        if (array_key_exists('image', $data)) {
            $image_path = FileHelper::upload_file('/users/' . $user['id'] . '/financialTransactions/', $data['image']);
            $data['image'] = $image_path;
        }
        $user->ProviderFinance()->create($data);
        return $user;
    }

    /**
     * update user type to provider .
     *
     * @param array $data
     * @return String
     */

    public function updateToProvider($user, $request)
    {
        $user->provider_type = $request['provider_type'];
        $user->type = 'provider';
        if ($request->hasFile('id_photo')) {
            // upload_file('/orders/temp/', $image)
            $id_photo = FileHelper::upload_file('/users/' . $user['id'] . '/id_photos/', $request['id_photo']);
            $user->id_photo = $id_photo;
            // dd($user->id_photo);
        }
        if ($request->hasFile('profession_license')) {
            $profession_license = FileHelper::upload_file('/users/' . $user['id'] . '/profession_licenses/', $request['profession_license']);
            $user->profession_license = $profession_license;
        }
        if ($request->hasFile('university_certificate')) {
            $university_certificate = FileHelper::upload_file('/users/' . $user['id'] . '/university_certificate/', $request['university_certificate']);
            $user->university_certificate = $university_certificate;
        }
        $user->save();
        if ($request->has('city_id')) {
            foreach ($request->city_id as $city_id) {
                $user->cities()->attach([
                    'city_id' => $city_id,
                ]);
            }
        }

        return $user;
    }

    /**
     * Stop the service temporarily
     *
     * @param array $data
     * @return String
     */

    public function stopService($user, $request)
    {
        $user->stop_service = $request->stop_service;
        $user->save();
        return $user->stop_service;
    }
    /**
     *  change activation status.
     *
     * @param array $data
     * @return String
     */

    public function activationStatus($user, $request)
    {
        $user->active_status = $request->active_status;
        $user->save();
        return $user->active_status;
    }

    /**
     * Verfiy New Phone.
     *
     * @param array $data
     * @return True
     */

    public function verifyNewPhone($request)
    {
        return $this->model->where('phone', $request->phone)
                            ->where('code', $request->code)
                            ->first();
    }

    public function verifyCode($code)
    {
        return $this->model->where('id', auth()->user()->id)->where('code', $code)->first();

    }

    public function updateUserData($key , $value , $code = null){
        if($code != null){
            return  $this->model
                        ->where('id' , auth()->user()->id)
                        ->where('code' , $code)
                        ->update([$key=>$value , 'code'=>'']);
        }else{
            return  $this->model->where('id' , auth()->user()->id)->update([$key=>$value]);
        }
    }

    public function getGuards($request){
        $user = $this->model->query();
        $user->where('type' , 'guard')
                        ->inRandomOrder()
                        ->whereHas('subscribe_guard_packages' , function($q){
                            return $q->where('status' , 'active');
                        })
                        ->select('id' , 'name' , 'image' , 'updated_at' , 'appear')->get();

        if($request->has('jop_type_id') && $request->jop_type_id != null){
            $user->where('jop_type_id' , $request->jop_type_id);
        }
        if($request->has('gender') && $request->gender != null){
            $user->where('gender' , $request->gender);
        }
        if($request->has('age_from') && $request->age_from != null){
            $user->where('age' , '>=',$request->age_from);
        }
        if($request->has('age_to') && $request->age_to != null){
            $user->where('age' , '<=',$request->age_to);
        }
        if($request->has('experience') && $request->experience != null){
            $user->where('experience' , $request->experience);
        }
        if($request->has('qualification') && $request->qualification != null){
            $user->where('qualification' , $request->qualification);
        }
        if($request->has('english') && $request->english != null){
            $user->where('english' , $request->english);
        }
        if($request->has('city_id') && $request->city_id != null){
            $user->where(function ($q) {$q->where('city_id', request('city_id'))->orWhere('other_cities', 'yes');});
        }
        $users = $user->take( $request->number_of_guards)->get();
        return $users;
    }

    public function getUserNotifications(){
        return UserNotification::with('notification')->where('user_id', auth()->user()->id)->orderBy('id' , 'DESC')->get();
    }

    public function markNotificationAsRead($readRequest){
        $userNotification = UserNotification::where('id', $readRequest->id)->where('user_id',auth()->user()->id)->first();
        if($userNotification){
            $userNotification->is_read = 1;
            $userNotification->save();
        }
        return $userNotification;
    }

    public function markAllNotificationAsRead(){
        return UserNotification::where('user_id',auth()->user()->id)->update(['is_read' => 1]);
    }

}
