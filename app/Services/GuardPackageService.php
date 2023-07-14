<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\GuardPackage;
use App\Repositories\GuardPackageRepository;
use Auth;
use DateTime;

class GuardPackageService
{

    protected $GuardPackage;
    public function __construct(GuardPackage $GuardPackage)
    {
        $this->GuardPackage = new GuardPackageRepository($GuardPackage);
    }

    public function index()
    {
        return $this->GuardPackage->index();
    }

    public function store($request)
    {
        return $this->GuardPackage->store($request);
    }

    public function show($id)
    {
        return $this->GuardPackage->show($id);
    }

    public function update($id, $request)
    {
        return $this->GuardPackage->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->GuardPackage->destroy($id);
    }

    public function subscribeGuardPackages()
    {
        $packages = $this->GuardPackage->subscribeGuardPackages();
        $subscribePackages = [];
        foreach($packages as $package_id){
            $fDate = new DateTime($package_id->created_at);
            $tDate = new DateTime();
            $interval = $fDate->diff($tDate);
            $days = $interval->format('%a');
            if($days > $package_id->guard_package->no_of_days){
                $theNumberOfDaysLeft  = 0 ;
            }else{
                $theNumberOfDaysLeft = $package_id->guard_package->no_of_days - $days;
            }
            $subscribePackage = (object)[
                'subscribe_package_id'=>$package_id->id,
                'theNumberOfDaysLeft'=>$theNumberOfDaysLeft,
                'subscribe_package_title'=>$package_id->guard_package->title,
                'subscribe_package_description'=>$package_id->guard_package->description,
            ];
            $subscribePackages[]=$subscribePackage;
        }
        return $subscribePackages;

    }

}
