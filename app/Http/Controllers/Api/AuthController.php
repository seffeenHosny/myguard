<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\SettingService;
use Auth;
use App\Helpers\FileHelper;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\RequestCodeRequest;
use App\Http\Requests\SendCodeRequest;
use App\Http\Requests\UpdateNameRequest;
use App\Http\Requests\UpdateOldPasswordRequest;
use App\Http\Requests\UpdatePhoneRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Requests\VerifyUserCodeRequest;
use App\Services\CompanyTypeService;
use DateTime;

class AuthController extends Controller
{
    protected $UserService;
    protected $SettingService;
    protected $CompanyTypeService;
    public function __construct(UserService $UserSer , SettingService $SettingSer , CompanyTypeService $CompanyTypeSer)
    {
        $this->UserService = $UserSer;
        $this->SettingService = $SettingSer;
        $this->CompanyTypeService = $CompanyTypeSer;
    }


    public function register(UserRequest $request)
    {
        $this->UserService->storeUser($request);
        $this->UserService->generatePasswordCode($request->phone , trans('admin.use_code_verify'));
        $user = User::where('phone' , $request->phone)->first();

        //User created, return success response
        return response()->json([
            'status' => 1,
            'code'=>200,
            'message' => trans('admin.User_created_successfully'),
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function companyRegister(CompanyRequest $request)
    {
        $this->UserService->storeUser($request);
        $this->UserService->generatePasswordCode($request->phone , trans('admin.use_code_verify'));
        $user = User::where('phone' , $request->phone)->first();

        //User created, return success response
        return response()->json([
            'status' => 1,
            'code'=>200,
            'message' => trans('admin.User_created_successfully'),
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function requestCode(RequestCodeRequest $request)
    {
        $code = $this->UserService->generatePasswordCode($request->phone , trans('admin.use_code'));
        return response()->json(['status' => 1,'code'=>200,'message' => trans('admin.code_sent'),'data' => $code], Response::HTTP_OK);
    }

    public function verifyAccount(RequestCodeRequest $request)
    {
        if($this->UserService->verifyAccount($request)){
            return response()->json(['status' => 1,'code'=>200,'message' => trans('admin.verify_account'),'data'=>null], Response::HTTP_OK);
        }else{
            return response()->json(['status' => 0,'code'=>400,'message' => trans('admin.wrong_date'),'data'=>null], Response::HTTP_OK);
        }

    }

    public function login(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();
        if ($user != null) {
            if($user->type == 'admin' || $user->type == 'super_admin'){
                return response()->json(['status'=>0 , 'code'=>400 , 'message'=>trans('admin.You_have_entered_Wrong_Phone_number') , 'data'=>null]);
            }
            if($user->verify_phone == 0){
                return response()->json(['status'=>2 , 'code'=>400 , 'message'=>trans('admin.Phone_not_Verified') , 'data'=>null]);
            }
        }

        try {
            if (!$token = JWTAuth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
                if ($user != null) {
                    return response()->json(['status'=>0 , 'code'=>400 , 'message'=>trans('admin.You_have_entered_Wrong_Password') , 'data'=>null]);
                } else {
                    return response()->json(['status'=>0 , 'code'=>400 , 'message'=>trans('admin.You_have_entered_Wrong_Phone_number') , 'data'=>null]);
                }
            }
        } catch (JWTException $exception) {
            return response()->json(['status'=>0 , 'code'=>400 , 'message'=>trans('admin.something_went_wrong') , 'data'=>null]);
        }
        $user = Auth::user();
        $user->fcm_token = $request->fcm_token;
        $user->save();
        $data['token'] = $token ;
        $data['user'] = $user ;
        if($user->type == 'guard'){
            if(count($user->subscribe_guard_packages) > 0){
                $user->subscribe_packages = true;
            }else{
                $user->subscribe_packages = false;
            }
            unset($user->subscribe_guard_packages);
        }else{
            if(count($user->subscribe_company_packages) > 0){
                $user->subscribe_packages = true;
            }else{
                $user->subscribe_packages = false;
            }
            unset($user->subscribe_company_packages);
        }
        return response()->json(['status'=>1 , 'code'=>200 , 'message'=>trans('admin.You_have_logged_in_Successfully') , 'data'=>$data ]);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);
            return response()->json(['status' => 1, 'code'=>200, 'message' => trans('admin.User_has_been_logged_out') , 'data'=>null]);
        } catch (JWTException $exception) {
            return response()->json(['status' => 0,'code'=> 400,'message' => trans('admin.Sorry_user_cannot_be_logged_out') , 'data'=>null], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUser(Request $request)
    {
        $user = JWTAuth::authenticate($request->token);
        if($user->city_id != null){
            $user->city = $user->city->name;
        }else{
            $user->city = null;
        }

        if($user->district_id != null){
            $user->district = $user->district->name;
        }else{
            $user->district = null;
        }

        if($user->jop_type_id != null){
            $user->jop_type = $user->jop_type;
        }else{
            $user->jop_type = null;
        }

        if($user->company_type_id != null){
            $user->company_type = $user->company_type;
        }else{
            $user->company_type = null;
        }

        if($user->type == 'guard'){
            if(count($user->subscribe_guard_packages) > 0){
                $user->subscribe_packages = true;
                $reminder = [];
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
            if(count($user->subscribe_company_packages)){
                $user->subscribe_packages = true;
            }else{
                $user->subscribe_packages = false;
            }
            unset($user->subscribe_company_packages);
        }
        return response()->json([ 'status' => 1,'code'=>200 ,'message'=>trans('admin.user-profile'),'data' => $user]);
    }

    public function verifyCode(RequestCodeRequest $request)
    {
        $user = $this->UserService->verifyNewPhone($request);

        if($user){
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.succeeded'),'data'=>null], Response::HTTP_OK);
        }else{
            return response()->json(['status' => 0,'code'=>400,'message' => trans('admin.wrong_date'),'data'=>null], Response::HTTP_OK);
        }

    }

    public function resetPassword(ForgetPasswordRequest $request)
    {
        $user = $this->UserService->resetPassword($request);
        if($user){
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.change_password_successfully'),'data'=>$user,], Response::HTTP_OK);
        }else{
            return response()->json(['status' => 0,'code'=>400,'message' => trans('admin.wrong_date'),'data'=>null], Response::HTTP_OK);
        }
    }

    public function updatePassword(UpdateOldPasswordRequest $request)
    {
        $data = $this->UserService->changePassword(auth()->user()->id , $request->old_password , $request->password);
        if($data){
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.update_password_message'),'data'=>null], Response::HTTP_OK);
        }else{
            return response()->json(['status' => 0,'code'=>400,'message' => trans('admin.old_password_wrong'),'data'=>null], Response::HTTP_OK);
        }
    }

    public function updateName(UpdateNameRequest $request){
        $data = $this->UserService->updateUserData( 'name' , $request->name);

        if($data){
            $user = $this->UserService->showUser(auth()->user()->id);
            return response()->json([
                'status' => 1,
                'code'=>200,
                'message'=>trans('admin.update_name_message'),
                'data'=>$user,
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'status' => 0,
                'code'=>400,
            ], Response::HTTP_OK);
        }
    }

    public function updatePhoto(UpdatePhotoRequest $request){

        $image_path = FileHelper::upload_file('clients' , $request->image);

        $data = $this->UserService->updateUserData( 'image' , $image_path);

        if($data){
            $user = $this->UserService->showUser(auth()->user()->id);
            return response()->json([
                'status' => 1,
                'code'=>200,
                'message'=>trans('admin.update_image_message'),
                'data'=>$user,
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'status' => 0,
                'code'=>400,
            ], Response::HTTP_OK);
        }
    }

    public function sendCode(SendCodeRequest $request)
    {
        $code = $this->UserService->generatePhoneCode($request->phone , trans('admin.use_code_change_phone'));
        return response()->json([
            'status' => 1,
            'code'=>200,
            'message' => trans('admin.code_sent'),
            'data' => $code
        ], Response::HTTP_OK);
    }

    public function verifyUserCode(VerifyUserCodeRequest $request)
    {
        $user = $this->UserService->verifyCode($request->code);
        if($user){
            return response()->json([
                'status' => 1,
                'code'=>200,
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'status' => 0,
                'code'=>400,
                'message' => trans('admin.wrong_date'),
            ], Response::HTTP_OK);
        }
    }

    public function updatePhone(UpdatePhoneRequest $request){

        $data = $this->UserService->updateUserData( 'phone' , $request->phone , $request->code);

        if($data){
            return response()->json([
                'status' => 1,
                'code'=>200,
                'message'=>trans('admin.update_phone_message'),
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'status' => 0,
                'code'=>400,
                'message' => trans('admin.wrong_date'),
            ], Response::HTTP_OK);
        }
    }

    public function getTerms(Request $request){
        $terms = $this->SettingService->getSettingData('terms' ,app()->getLocale() );
        $policy = $this->SettingService->getSettingData('policy' ,app()->getLocale() );
        $data['terms']=$terms;
        $data['policy']=$policy;
        return response()->json([
                'status' => 1,
                'code'=>200,
                'message'=>'',
                'data'=>$data ,
            ], Response::HTTP_OK);
    }

    public function getPhone(){
        $data = $this->SettingService->getSettingData('phone');
        return response()->json([
                'status' => 1,
                'code'=>200,
                'data'=>$data ,
            ], Response::HTTP_OK);
    }

    public function getPrivacy(){
        $data = $this->SettingService->getSettingData('policy' ,app()->getLocale() );
        return response()->json([
                'status' => 1,
                'code'=>200,
                'message'=>'',
                'data'=>$data,
            ], Response::HTTP_OK);
    }

    public function companyType(){
        $data = $this->CompanyTypeService->index();
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.company_types'),'data'=>$data,], Response::HTTP_OK);
    }
}
