<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    private $JobService;
    public function __construct(JobService $JobSer){
        $this->JobService = $JobSer;
    }

    public function index(){
        $data = $this->JobService->index();
        return view('admin.job_offers.index' , compact('data'));
    }

    public function show(Job $job){
        $job = $this->JobService->show($job->id);
        $data = $job->job_users;
        return view('admin.job_offers.show' , compact('data'));
    }
}
