<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyUpdateProfile;
use App\Http\Requests\RequestCodeRequest;
use App\Http\Requests\UpdatePassword;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\CompanyType;
use App\Models\HomeImage;
use App\Models\User;
use App\Services\CityService;
use App\Services\CompanyTypeService;
use App\Services\NewsService;
use App\Services\SettingService;
use App\Services\UserService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $UserService;
    protected $CompanyTypeService;
    protected $SettingService;
    protected $NewsService;
    protected $CityService;
    public function __construct(UserService $UserSer , CompanyTypeService $CompanyTypeSer , SettingService $SettingSer ,NewsService $NewsSer , CityService $CitySer)
    {
        $this->UserService = $UserSer;
        $this->CompanyTypeService = $CompanyTypeSer;
        $this->SettingService = $SettingSer;
        $this->NewsService = $NewsSer;
        $this->CityService = $CitySer;
    }



    public function index()
    {
        $data = $this->UserService->getUsersWhereType('company');
        return view('admin.companies.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_types = $this->CompanyTypeService->index()->pluck('name' , 'id');
        $cities = $this->CityService->index()->pluck('name' , 'id');
        return view('admin.companies.insert' , compact('company_types' , 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $this->UserService->storeUser($request);
        session()->flash('success' , trans('admin.company-add-message'));
        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $company)
    {
        $data = $this->UserService->showUser($company->id);
        return view('admin.companies.show' , compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $company)
    {
        $data = $this->UserService->showUser($company->id);
        $company_types = $this->CompanyTypeService->index()->pluck('name' , 'id');
        $cities = $this->CityService->index()->pluck('name' , 'id');
        return view('admin.companies.edit' , compact('data' , 'company_types' , 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, User $company)
    {
        $this->UserService->updateUser($company->id , $request);
        session()->flash('success' , trans('admin.company-edit-message'));
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $company)
    {
        $this->UserService->destroyUser($company->id);
        session()->flash('success' , trans('admin.company-delete-message'));
        return redirect()->route('companies.index');
    }

    public function companyLoginView(){
        return view('auth.company_login');
    }

    public function companyLogin(){
        $rem = request()->has('remember') ? true : false;
        $user = User::where('phone' , request('phone') )->where('type' , 'company')->first();

        if($user == null){
            session()->flash('error' , 'بيانات الاعتماد التي ادخلتها غير صحيحة');
            return redirect()->back();
        }

        if($user->verify_phone != 1){
            session()->flash('error' , 'رقم الجوال غير مفعل');
            $this->UserService->generatePasswordCode(request('phone') , trans('admin.use_code_verify'));
            return redirect()->route('company.verify')->with( ['data' => $user] );
        }

        if(auth()->attempt(['phone'=>request('phone') ,'password'=>request('password') , 'type'=>'company'] , $rem)){
            return redirect()->route('company.home');
        }else{
            session()->flash('error' , 'بيانات الاعتماد التي ادخلتها غير صحيحة');
            return redirect()->back();
        }
    }

    public function companyLogout(){
        auth()->logout();
        return redirect()->route('company.login');
    }

    public function companyRegister(){
        $company_types = CompanyType::all()->pluck('name' , 'id');
        $cities = City::all()->pluck('name' , 'id');
        return view('auth.company_register' , compact('company_types' , 'cities'));
    }

    public function companyRegisterPost(CompanyRequest $request)
    {
        $this->UserService->storeUser($request);
        $this->UserService->generatePasswordCode($request->phone , trans('admin.use_code_verify'));
        $user = User::where('phone' , $request->phone)->first();
        if($user){
            return redirect()->route('company.verify')->with( ['data' => $user] );
        }else{
            return redirect()->back();
        }

    }

    public function companyVerify(){
        $user = session()->get('data');
        return view('auth.verify' , compact('user'));
    }

    public function companyVerifyPost(RequestCodeRequest $request)
    {
        if($this->UserService->verifyAccount($request)){
            session()->flash('status' , 'تم تفعيل الحساب بنجاح');
            return redirect()->route('company.login');
        }else{
            session()->flash('error' , 'بيانات الاعتماد التي ادخلتها غير صحيحه');
            return redirect()->back();
        }
    }

    public function requestCode(RequestCodeRequest $request)
    {
        $code = $this->UserService->generatePasswordCode($request->phone , trans('admin.use_code'));
        return response()->json('true');
    }

    public function home(){
        $aboutUs = $this->SettingService->getSettingData('aboutUs' ,app()->getLocale() );
        $images = HomeImage::select('path' , 'type')->get();
        $news = $this->NewsService->indexWithRelation('images' , ['id' ,'imageable_id', 'path']);
        // dd($aboutUs , $images->toArray() , $news->toArray() );
        return view('company.home' , compact('aboutUs' , 'images' , 'news'));
    }


    public function showUserProfile(){
        $company_types = $this->CompanyTypeService->index()->pluck('name' , 'id');
        $cities = $this->CityService->index()->pluck('name' , 'id');
        return view('company.profile' , compact('company_types' , 'cities'));
    }

    public function updateUserProfile(CompanyUpdateProfile $request){
        $this->UserService->updateUser(auth()->user()->id , $request);
        session()->flash('success' , trans('admin.user-edit-profile'));
        return redirect()->back();
    }

    public function updatePasswordView(){
        return view('company.password');
    }

    public function updatePassword(UpdatePassword $request){
        $data = $this->UserService->changePassword(auth()->user()->id , $request->old_password , $request->password);
        if($data){
            session()->flash('success' , trans('admin.update_password_message'));
        }else{
            session()->flash('failed' , trans('admin.old_password_wrong'));
        }
        return redirect()->back();
    }

}
