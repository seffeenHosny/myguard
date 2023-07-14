<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubscribeGuardPackage;
use App\Services\UserService;
use Carbon\Carbon;

class CheckGuardPackageStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guard:package';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $UserService;
    public function __construct(UserService $UserSer)
    {
        $this->UserService = $UserSer;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $packages = SubscribeGuardPackage::with('guard_package')->where('status' , 'active')->get();
        foreach($packages as $package){
            $date = Carbon::parse($package->created_at);
            $now = Carbon::now();
            $diff = $date->diffInDays($now);
            if(($package->guard_package->no_of_days - $diff) == 0 ){
                $this->UserService->sendNotification($package->user_id, trans('admin.package_almost_done_title'), trans('admin.package_almost_done_body') , null ,'/');
            }

            if($diff > $package->guard_package->no_of_days){
                $package->status = 'inactive';
                $package->save();
                $this->UserService->sendNotification($package->user_id, trans('admin.package_done_title'), trans('admin.package_done_body') , null ,'guard_packages');
            }
        }
        return Command::SUCCESS;
    }
}
