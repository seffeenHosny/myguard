<?php

namespace App\Repositories;

use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use App\Models\CompanyGuard;
use App\Models\Holiday;
use App\Models\JobHoliday;
use App\Models\JobUser;
use App\Models\SubscribeCompanyPackage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
class JobRepository
{
    use CrudTrait, ResponseTraits, MainTrait;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        if(auth()->user()->type == 'company'){
            return $this->model
                        ->orderBy('id' , 'DESC')
                        ->where('user_id' , auth()->user()->id)
                        ->with('city')
                        ->with('jop_type')
                        ->with('district')
                        ->with('work_nature')
                        ->with(['company'=>function($q){$q->select('id' , 'name' , 'image');}])
                        ->withCount('job_users')
                        ->get();
        }elseif(auth()->user()->type == 'guard'){
            return JobUser::
                            select('id' , 'user_id' , 'job_id' , 'status')
                            ->orderBy('id' , 'DESC')
                            ->where('user_id' , auth()->user()->id)
                            ->where('status' , 'new')
                            ->with(['job' => function($q){
                                $q->with('city')
                                    ->with('jop_type')
                                    ->with('district')
                                    ->with('work_nature')
                                    ->with(['company'=>function($q){$q->select('id' , 'name' , 'image');}])
                                    ->with('holidays');
                            }])
                            ->get();
        }else{
            return $this->indexTrait($this->model);
        }
    }

    public function show($id)
    {
        return $this->showTrait($this->model, $id);
    }

    public function store($request){
        $data = $request->except('_method' , '_token' , 'users');
        $data['user_id'] = auth()->user()->id;
        $job = $this->storeTrait($this->model ,$data);
        foreach($request->users as $user_id){
            $job_user = new JobUser();
            $job_user->job_id = $job->id;
            $job_user->user_id =$user_id;
            $job_user->status = 'new';
            $job_user->save() ;
        }
        // if($request->has('holidays')){
        //     if($request->holidays != null){
        //         foreach($request->holidays as $holiday_id){
        //             $Job_holiday = new JobHoliday();
        //             $Job_holiday->job_id = $job->id;
        //             $Job_holiday->holiday_id =$holiday_id;
        //             $Job_holiday->save() ;
        //         }
        //     }
        // }
        return $job->job_users;
    }

    public function acceptOffer($id){
        $job = JobUser::where('user_id' , auth()->user()->id)->where('id' , $id)->where('status' , 'new')->first();
        if($job != null){
            $job->status = 'accept';
            $job->save();
            $user = User::where('id' ,  auth()->user()->id)->first();
            if($user != null){
                if($user->communication > 0){
                    $user->communication = $user->communication +1 ;
                }else{
                    $user->communication = 1;
                }
            }
                $user->save();
            return true;
        }
        return false;
    }

    public function rejectOffer($id){
        $job = JobUser::where('user_id' , auth()->user()->id)->where('id' , $id)->where('status' , 'new')->first();
        if($job != null){
            $job->status = 'reject';
            $job->save();
            return true;
        }
        return false;
    }

    public function holidays(){
        return Holiday::all();
    }

    public function employeesOfOffer($request){
        if($request->has('search') && !$request->has('filter')){
            $users = JobUser::where('job_id' , $request->offer_id)
                            ->whereHas('job' , function($q){return $q->where('user_id' , auth()->user()->id);})
                            ->select('id' , 'user_id' , 'job_id' , 'status')
                            ->whereHas('user' , function($q){return $q->where('name' , 'like' ,'%'.request('search').'%');})
                            ->with(['user'=>function($q){$q->select('id' , 'name' , 'updated_at' , 'image');}])
                            ->get();
        }elseif($request->has('filter') && !$request->has('search')){
            $users = JobUser::where('job_id' , $request->offer_id)
                            ->select('id' , 'user_id' , 'job_id' , 'status')
                            ->whereHas('job' , function($q){return $q->where('user_id' , auth()->user()->id);})
                            ->where('status' , $request->filter)
                            ->with(['user'=>function($q){$q->select('id' , 'name' , 'updated_at' , 'image');}])
                            ->get();
        }elseif($request->has('filter') && $request->has('search')){
            $users = JobUser::where('job_id' , $request->offer_id)
                            ->select('id' , 'user_id' , 'job_id' , 'status')
                            ->whereHas('job' , function($q){return $q->where('user_id' , auth()->user()->id);})
                            ->where('status' , $request->filter)
                            ->whereHas('user' , function($q){return $q->where('name' , 'like' ,'%'.request('search').'%');})
                            ->with(['user'=>function($q){$q->select('id' , 'name' , 'updated_at' , 'image');}])
                            ->get();
        }else{
            $users = JobUser::where('job_id' , $request->offer_id)
                            ->select('id' , 'user_id' , 'job_id' , 'status')
                            ->whereHas('job' , function($q){return $q->where('user_id' , auth()->user()->id);})
                            ->with(['user'=>function($q){$q->select('id' , 'name' , 'updated_at' , 'image');}])
                            ->get();
        }
        return $users;
    }

    public function buyCvs($request){
        $callBackStatus = [];
        $cvsCount =count($request->users);
        $packages = SubscribeCompanyPackage::where('user_id' , auth()->user()->id)->where('status' , 'active')->get();
        if(count($packages) > 0){
            $pointsCount = $packages->sum('rest_of_points');
            if($pointsCount >= $cvsCount){
                foreach($request->users as $user_id){
                    $guard = new CompanyGuard();
                    $guard->company_id = auth()->user()->id;
                    $guard->guard_id = $user_id;
                    $guard->the_number_of_days_left = 90 ;
                    $guard->save();
                }
                $this->pointsDiscount($cvsCount);
                $callBackStatus['code'] = 1;
                $callBackStatus['available'] = null;
                $callBackStatus['need'] = null;
            }else{
                $callBackStatus['code'] = 2;
                $callBackStatus['available'] =$pointsCount;
                $callBackStatus['need'] = $cvsCount - $pointsCount;
            }
        }else{
            $callBackStatus['code'] = 3;
            $callBackStatus['available'] = null;
            $callBackStatus['need'] = null;
        }

        return $callBackStatus;
    }

    public function companyGuards($request){
        $guard = CompanyGuard::query();
        $guard->where('company_id' , auth()->user()->id)
                ->select('id', 'company_id' , 'guard_id','the_number_of_days_left')
                ->with(['company_guard'=>function($q){$q->select('id' , 'name' , 'image' , 'updated_at');}])
                ->orderBy('the_number_of_days_left' , 'DESC');

        if($request->has('gender') && $request->gender != null){
            $guard->whereHas('company_guard' , function($q){return $q->where('gender' , request('gender'));});
        }

        if($request->has('age') && $request->age != null){
            $guard->whereHas('company_guard' , function($q){return $q->where('age' , request('age'));});
        }

        if($request->has('experience') && $request->experience != null){
            $guard->whereHas('company_guard' , function($q){return $q->where('experience' , request('experience'));});
        }

        if($request->has('qualification') && $request->qualification != null){
            $guard->whereHas('company_guard' , function($q){return $q->where('qualification' , request('qualification'));});
        }

        if($request->has('english') && $request->english != null){
            $guard->whereHas('company_guard' , function($q){return $q->where('english' , request('english'));});
        }

        if($request->has('city_id') && $request->city_id != null){
            $guard->whereHas('company_guard' , function($q){return $q->where('city_id' , request('city_id'));});
        }

        $guards =$guard->get();

        return $guards;
    }

    public function pointsDiscount($points){
        $package = SubscribeCompanyPackage::where('user_id' , auth()->user()->id)
                                            ->where('status' , 'active')
                                            ->where('rest_of_points' , '>' , 0)
                                            ->first();
        if($package != null){
            if($points > $package->rest_of_points){
                $package->rest_of_points = 0 ;
                $package->save();
                $restPoints = $points - $package->rest_of_points;
                $this->pointsDiscount($restPoints);
            }else{
                $package->rest_of_points = $package->rest_of_points - $points ;
                $package->save();
            }
        }
    }


}
