<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatePassword;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $UserService;
    public function __construct(UserService $UserSer)
    {
        $this->UserService = $UserSer;
    }
    public function index()
    {
        if(auth()->user()->type == 'super_admin'){
            $data = $this->UserService->getUsersWhereType('admin');
            return view('admin.users.index' , compact('data'));
        }else{
            return abort('403');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->type == 'super_admin'){
            return view('admin.users.insert');
        }else{
            return abort('403');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(auth()->user()->type == 'super_admin'){
            $this->UserService->storeUser($request);
            session()->flash('success' , trans('admin.user-add-message'));
            return redirect()->route('users.index');
        }else{
            return abort('403');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(auth()->user()->type == 'super_admin'){
            $data = $this->UserService->showUser($user->id);
            return view('admin.users.show' , compact('data'));
        }else{
            return abort('403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(auth()->user()->type == 'super_admin'){
            $data = $this->UserService->showUser($user->id);
            return view('admin.users.edit' , compact('data'));
        }else{
            return abort('403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if(auth()->user()->type == 'super_admin'){
            $this->UserService->updateUser($user->id , $request);
            session()->flash('success' , trans('admin.user-edit-message'));
            return redirect()->route('users.index');
        }else{
            return abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->type == 'super_admin'){
            $this->UserService->destroyUser($id);
            session()->flash('success' , trans('admin.user-delete-message'));
            return redirect()->route('users.index');
        }else{
            return abort('403');
        }
    }

    public function showUserProfile(){
        return view('admin.users.profile');
    }

    public function updateUserProfile(UserRequest $request){
        $this->UserService->updateUser(auth()->user()->id , $request);
        session()->flash('success' , trans('admin.user-edit-profile'));
        return redirect()->back();
    }

    public function updatePasswordView(){
        return view('admin.users.password');
    }

    public function updatePassword(updatePassword $request){
        $data = $this->UserService->changePassword(auth()->user()->id , $request->old_password , $request->password);
        if($data){
            session()->flash('success' , trans('admin.update_password_message'));
        }else{
            session()->flash('failed' , trans('admin.old_password_wrong'));
        }
        return redirect()->back();
    }


    public function forgetPasswordView(){
        return view('auth.passwords.phone');
    }

    public function sendCode(Request $request){
        $data = $this->UserService->generatePasswordCode($request->phone);
        if($data){
            session()->flash('status' , trans('admin.code_sent'));
            return redirect()->route('check.code.get');
        }else{
            session()->flash('status' , trans('admin.wrong_phone_message'));
            return redirect()->back();
        }
    }

    public function checkCodeView(){
        return view('auth.passwords.reset');
    }

    public function checkCode(Request $request){
        $data = $this->UserService->verifyNewPhone($request);
        if($data){
            return redirect()->route('forget.password.view')->with( ['data' => $data] );;
        }else{
            session()->flash('status' , trans('admin.wrong_data'));
            return redirect()->back();
        }
    }

    public function resetPasswordView(){
        $data = session()->get('data');
        return view('auth.passwords.confirm' , compact('data'));
    }

    public function resetPassword(ForgetPasswordRequest $request){
        $data = $this->UserService->resetPassword($request);
        if($data){
            session()->flash('status' , trans('admin.change_password_successfully'));
            if($data->type == 'company'){
                return redirect()->route('company.login');
            }else{
                return redirect()->route('login');
            }
        }else{
            session()->flash('status' , trans('admin.wrong_data'));
            return redirect()->back();
        }
    }
}
