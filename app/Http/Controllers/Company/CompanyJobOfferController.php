<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyCvsRequest;
use App\Http\Requests\CompanyGuardFilterRequest;
use App\Http\Requests\CreateJobOfferRequest;
use App\Http\Requests\GuardFillterRequest;
use App\Http\Requests\JobOfferRequest;
use App\Models\Holiday;
use App\Models\Job;
use App\Models\JopType;
use App\Models\User;
use App\Services\CityService;
use App\Services\DistrictService;
use App\Services\JobService;
use App\Services\UserService;
use App\Services\WorkNatureService;
use DateTime;
use Illuminate\Http\Request;

class CompanyJobOfferController extends Controller
{
    private $CityService;
    private $UserService;
    private $JobService;
    protected $WorkNatureService;
    public function __construct(JobService $JobSer , CityService $CitySer , UserService $UserSer , WorkNatureService $WorkNatureSer)
    {
        $this->JobService = $JobSer;
        $this->CityService = $CitySer;
        $this->UserService = $UserSer;
        $this->WorkNatureService = $WorkNatureSer;
    }

    public function viewFilter(){
        $cities = $this->CityService->index()->pluck('name' , 'id');
        $job_types = JopType::get()->pluck('name' , 'id');
        return view('company.filter.index' , compact('cities' , 'job_types'));
    }

    public function filter(GuardFillterRequest $request){
        $cities = $this->CityService->index()->pluck('name' , 'id');
        $job_types = JopType::get()->pluck('name' , 'id');
        $data = $this->UserService->getGuards($request);
        return view('company.filter.index' , compact('data' ,'request' , 'cities' , 'job_types'));
    }

    public function guardProfile($id){
        $data = User::findOrFail($id);
        $guardPackages = $data->subscribe_guard_packages->where('status' , 'active');
        if(count($guardPackages) > 0){
            foreach($guardPackages as $package){
                $packageDays = $package->guard_package->no_of_days;
                $fDate = new DateTime($package->created_at);
                $tDate = new DateTime();
                $interval = $fDate->diff($tDate);
                $days = $interval->format('%a');
                $reminder[] = $packageDays - $days;
            }
            $data->subscribe_package_days = max($reminder);
        }else{
            $data->subscribe_package_days = 0;
        }
        return view('company.filter.guard_profile' , compact('data' ));
    }

    public function guards(Request $request){
        $data = $this->JobService->companyGuards($request);
        return view('company.guards.index' , compact('data'));
    }

    public function jobOffers(){
        $data = $this->JobService->index();
        return view('company.job_offers.index' , compact('data'));
    }

    public function guardsOfOffer(Request $request){
        $job = Job::findOrFail($request->offer_id);
        if($job != null){
            if($job->user_id == auth()->user()->id){
                $guards = $this->JobService->employeesOfOffer($request);
                $data['count'] = count($guards);
                $data['guards'] = $guards;
                $jop_type_id = User::where('id' , $guards[0]->user_id)->first('jop_type_id')->jop_type_id;
                // dd($guards->toArray());
                return view('company.job_offers.show' , compact('data' , 'jop_type_id'));
            }
        }
        return redirect()->back();
    }

    public function buyCvs(BuyCvsRequest $request){
        $backMessage = $this->JobService->buyCvs($request);
        if($backMessage['code'] == 1){
            session()->flash('success' , trans('admin.buy_done'));
            return redirect()->route('company.guards');
        }elseif($backMessage['code'] == 2){
            session()->flash('error' , trans('admin.Your balance is not enough to purchase this number of employees. Please buy another package and try again'));
            return redirect()->route('company.packages');
        }elseif($backMessage['code'] == 3){
            session()->flash('error' , trans('admin.You are not subscribed to any package, subscribe and try again'));
            return redirect()->route('company.packages');
        }
    }

    public function createJobOffer(CreateJobOfferRequest $request){
        if(session()->has('job_offer_users')){
            $jobOfferUser = session()->get('job_offer_users');

        }else{
            $jobOfferUser = [];
        }
        $jobOfferUser[auth()->user()->id] = $request->users;
        session()->put('job_offer_users' , $jobOfferUser);
        return redirect()->route('company.create_job_offer.view');
    }

    public function createJobOfferView(){
        $cities = $this->CityService->index()->pluck('name' , 'id');
        $work_natures = $this->WorkNatureService->index()->pluck('nature' , 'id');
        $job_types = JopType::get()->pluck('name' , 'id');
        $holidays = Holiday::get()->pluck('day' , 'id');
        $jop_type_id = null ;
        if(session()->has('job_offer_users')){
            $jobOfferUser = session()->get('job_offer_users');
            if(isset($jobOfferUser[auth()->user()->id])){
                $users = $jobOfferUser[auth()->user()->id];
                $jop_type = User::where('id' , array_values($users)[0])->first('jop_type_id');
                $jop_type_id = $jop_type->jop_type_id;
            }else{
                $users = [];
            }

        }else{
            $users = [];
        }
        return view('company.job_offers.create' , compact('users' , 'cities' , 'job_types' , 'holidays' , 'jop_type_id' , 'work_natures'));
    }

    public function sendJobOffer(JobOfferRequest $request){
        $data = $this->JobService->store($request);
        if($data){
            foreach($request->users as $user_id){
                $this->UserService->sendNotification($user_id, trans('admin.new_job_offer_title'), trans('admin.new_job_offer_body') , null ,'new_job_offer');
            }
            session()->flash('success' , trans('admin.job_offer_add_message'));
            if(session()->has('job_offer_users')){
                $jobOfferUser = session()->get('job_offer_users');
                if(isset($jobOfferUser[auth()->user()->id])){
                    $jobOfferUser[auth()->user()->id] = null;
                    session()->put('job_offer_users' ,$jobOfferUser);
                }
            }
        }
        return redirect()->route('company.jobOffers');
    }

    public function guardsFilter(){
        $cities = $this->CityService->index()->pluck('name' , 'id');
        return view('company.guards.filter' , compact('cities'));
    }

    public function guardsFilterGet(CompanyGuardFilterRequest $request){
        $data = $this->JobService->companyGuards($request);
        $cities = $this->CityService->index()->pluck('name' , 'id');
        return view('company.guards.filter' , compact('data' , 'cities' , 'request'));
    }
}
