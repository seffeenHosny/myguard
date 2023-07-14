<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companiesCount = User::where('type' , 'company')->count();
        $guardsCount = User::where('type' , 'guard')->count();
        $jobsCount = Job::count();
        $jobsInMonth = Job::whereYear('created_at' , date('Y'))
                                    ->whereMonth('created_at' , date('m'))
                                    ->count();
        $lats5Jobs = Job::orderBy('id','DESC')->limit(5)->get();


        $allJob = Job::whereYear('created_at', date('Y'))->get();
        $months = [12 , 11 , 10 , 9 , 8 , 7 , 6 , 5 , 4 , 3 , 2 , 1];
        $jobs = [];
        $jobs['12'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '12')->count();
        $jobs['11'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '11')->count();
        $jobs['10'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '10')->count();
        $jobs['09'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '09')->count();
        $jobs['08'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '08')->count();
        $jobs['07'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '07')->count();
        $jobs['06'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '06')->count();
        $jobs['05'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '05')->count();
        $jobs['04'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '04')->count();
        $jobs['03'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '03')->count();
        $jobs['02'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '02')->count();
        $jobs['01'] = Job::whereYear('created_at', date('Y'))->whereMonth( 'created_at' , '01')->count();
        $jobs = array_values($jobs);
        $jobOffersNew = JobUser::where('status' , 'new')->count();
        $jobOffersAccept = JobUser::where('status' , 'accept')->count();
        $jobOffersReject = JobUser::where('status' , 'reject')->count();
        $jobs = json_encode($jobs);
        return view('admin.home' , compact(
                                            'companiesCount' ,
                                                    'guardsCount' ,
                                                    'jobsCount' ,
                                                    'jobsInMonth' ,
                                                    'lats5Jobs' ,
                                                    'jobs' ,
                                                    'jobOffersNew',
                                                    'jobOffersAccept',
                                                    'jobOffersReject'
                                                ));
    }
}
