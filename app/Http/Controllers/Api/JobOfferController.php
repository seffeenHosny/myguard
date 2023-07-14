<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyCvsRequest;
use App\Http\Requests\CompanyGuardFilterRequest;
use App\Http\Requests\JobOfferRequest;
use App\Models\Job;
use App\Models\JobUser;
use App\Services\JobService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobOfferController extends Controller
{
    private $JobService;
    private $UserService;
    public function __construct(JobService $JobSer , UserService $UserSer){
        $this->JobService = $JobSer;
        $this->UserService = $UserSer;
    }

    public function store(JobOfferRequest $request){
        if(auth()->user()->type == 'company'){
            $data = $this->JobService->store($request);
            if($data){
                foreach($request->users as $user_id){
                    $this->UserService->sendNotification($user_id, trans('admin.new_job_offer_title'), trans('admin.new_job_offer_body') , null ,'new_job_offer');
                }
                return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.job_offer_add_message'),'data'=>null ], Response::HTTP_OK);
            }
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function companyOffer(){
        if(auth()->user()->type == 'company'){
            $data = $this->JobService->index();
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.job_offers'),'data'=>$data ], Response::HTTP_OK);
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function guardOffer(){
        if(auth()->user()->type == 'guard'){
            $data = $this->JobService->index();
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.job_offers'),'data'=>$data ], Response::HTTP_OK);
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function holidays(){
        $holidays = $this->JobService->holidays();
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.holidays'),'data'=>$holidays ], Response::HTTP_OK);
    }

    public function acceptOffer($id){
        if(auth()->user()->type == 'guard'){
            $data = $this->JobService->acceptOffer($id);
            if($data){
                $jobUser = JobUser::where('id' , $id)->first();
                $job = Job::where('id' , $jobUser->job_id)->first();
                $this->UserService->sendNotification($job->user_id, trans('admin.accept_job_offer_title'), trans('admin.accept_job_offer_body') , null ,'accept_job_offer');
                return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.accept_job_offers_message'),'data'=>$data ], Response::HTTP_OK);
            }
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function rejectOffer($id){
        if(auth()->user()->type == 'guard'){
            $data = $this->JobService->rejectOffer($id);
            if($data){
                $jobUser = JobUser::where('id' , $id)->first();
                $job = Job::where('id' , $jobUser->job_id)->first();
                $this->UserService->sendNotification($job->user_id, trans('admin.reject_job_offer_title'), trans('admin.reject_job_offer_body') , null ,'reject_job_offer');
                return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.reject_job_offers_message'),'data'=>$data ], Response::HTTP_OK);
            }
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function employeesOfOffer(Request $request){
        $guards = $this->JobService->employeesOfOffer($request);
        $data['guardsCount'] = count($guards);
        $data['guards'] = $guards;
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.guards'),'data'=>$data ], Response::HTTP_OK);
    }

    public function buyCvs(BuyCvsRequest $request){
        $backMessage = $this->JobService->buyCvs($request);
        if($backMessage['code'] == 1){
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.buy_done'),'data'=>null ], Response::HTTP_OK);
        }elseif($backMessage['code'] == 2){
            return response()->json(['status' => 2,'code'=>400,'message'=>trans('admin.Purchase_customer_failed').'. '.trans('admin.Available_points_in_credit').' '.$backMessage['available'],'data'=>null ], Response::HTTP_OK);
        }elseif($backMessage['code'] == 3){
            return response()->json(['status' => 3,'code'=>400,'message'=>trans('admin.Not_subscribed_to_any_package'),'data'=>null ], Response::HTTP_OK);
        }
    }

    public function companyGuards(CompanyGuardFilterRequest $request){
        $data = $this->JobService->companyGuards($request);
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.guards'),'data'=>$data ], Response::HTTP_OK);
    }

}
