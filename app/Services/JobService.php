<?php

namespace App\Services;

use App\Models\CompanyGuard;
use App\Models\Notification;
use App\Models\Job;
use App\Models\User;
use App\Repositories\JobRepository;
use Auth;
use DateTime;

class JobService
{

    protected $Job;
    public function __construct(Job $Job)
    {
        $this->Job = new JobRepository($Job);
    }

    public function index()
    {
        return $this->Job->index();
    }

    public function store($request)
    {
        $job_users =  $this->Job->store($request);
        foreach($job_users as $user_id){
            $user = User::where('id' , $user_id->user_id)->first();
            if($user != null){
                if($user->offer_me != null){
                    $user->offer_me = $user->offer_me + 1;
                }else{
                    $user->offer_me =1;
                }
                $user->save();
            }
        }

        return true;
    }

    public function show($id)
    {
        return $this->Job->show($id);
    }

    public function acceptOffer($id)
    {
        return $this->Job->acceptOffer($id);
    }

    public function rejectOffer($id)
    {
        return $this->Job->rejectOffer($id);
    }

    public function holidays()
    {
        return $this->Job->holidays();
    }

    public function employeesOfOffer($request){
        $users =  $this->Job->employeesOfOffer($request);
        foreach($users as $user_id){
            $user = CompanyGuard::where('guard_id' , $user_id->user_id)->first('the_number_of_days_left');

            if($user != null){
                $theNumberOfDaysLeft  = $user->the_number_of_days_left ;
            }else{
                $theNumberOfDaysLeft = 0;
            }
            $user_id->user->theNumberOfDaysLeft = $theNumberOfDaysLeft;
        }
        return $users;
    }

    public function buyCvs($request){
        return $this->Job->buyCvs($request);
    }

    public function companyGuards($request){
        $users =  $this->Job->companyGuards($request);
        $data['count'] = count($users);
        $data['guards'] = $users;
        return $data;
    }

}
