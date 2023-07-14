<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\CompanyPackage;
use App\Repositories\CompanyPackageRepository;
use Auth;
use DateTime;

class CompanyPackageService
{

    protected $CompanyPackage;
    public function __construct(CompanyPackage $CompanyPackage)
    {
        $this->CompanyPackage = new CompanyPackageRepository($CompanyPackage);
    }

    public function index()
    {
        return $this->CompanyPackage->index();
    }

    public function store($request)
    {
        return $this->CompanyPackage->store($request);
    }

    public function show($id)
    {
        return $this->CompanyPackage->show($id);
    }

    public function update($id, $request)
    {
        return $this->CompanyPackage->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->CompanyPackage->destroy($id);
    }

    public function subscribeCompanyPackages()
    {
        $packages = $this->CompanyPackage->subscribeCompanyPackages();
        $subscribePackages = [];
        foreach($packages as $package_id){
            $fDate = new DateTime($package_id->created_at);
            $tDate = new DateTime();
            $interval = $fDate->diff($tDate);
            $days = $interval->format('%a');
            if($days > $package_id->company_package->no_of_days){
                $theNumberOfDaysLeft  = 0 ;
            }else{
                $theNumberOfDaysLeft = $package_id->company_package->no_of_days - $days;
            }
            $subscribePackage = (object)[
                'subscribe_package_id'=>$package_id->id,
                'theNumberOfDaysLeft'=>$theNumberOfDaysLeft,
                'subscribe_package_title'=>$package_id->company_package->title,
                'subscribe_package_description'=>$package_id->company_package->description,
            ];
            $subscribePackages[]=$subscribePackage;
        }
        return $subscribePackages;
    }

}
