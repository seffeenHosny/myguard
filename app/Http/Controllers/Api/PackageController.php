<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CompanyPackageService;
use App\Services\GuardPackageService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{

    private $GuardPackageService;
    private $CompanyPackageService;
    public function __construct(GuardPackageService $GuardPackageSer , CompanyPackageService $CompanyPackageSer ){
        $this->GuardPackageService = $GuardPackageSer;
        $this->CompanyPackageService = $CompanyPackageSer;
    }

    public function guardPackages(){
        $packages = $this->GuardPackageService->index();
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.guard_packages'),'data'=>$packages ], Response::HTTP_OK);
    }

    public function companyPackages(){
        $packages = $this->CompanyPackageService->index();
        return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.company_packages'),'data'=>$packages ], Response::HTTP_OK);
    }

    public function subscribeGuardPackages(){
        if(auth()->user()->type == 'guard'){
            $packages = $this->GuardPackageService->subscribeGuardPackages();
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.guard_packages'),'data'=>$packages ], Response::HTTP_OK);
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }

    public function subscribeCompanyPackages(){
        if(auth()->user()->type == 'company'){
            $packages = $this->CompanyPackageService->subscribeCompanyPackages();
            return response()->json(['status' => 1,'code'=>200,'message'=>trans('admin.company_packages'),'data'=>$packages ], Response::HTTP_OK);
        }
        return response()->json(['status' => 0,'code'=>400,'message'=>trans('admin.something_went_wrong'),'data'=>null ], Response::HTTP_OK);
    }
}
