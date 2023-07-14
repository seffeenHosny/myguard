<?php

namespace App\Console\Commands;

use App\Models\CompanyGuard;
use Illuminate\Console\Command;

class CompanyGuardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:guards';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $guards = CompanyGuard::get();
        foreach($guards as $guard){
            if($guard->the_number_of_days_left == 0){
                $guard->delete();
            }else{
                $guard->the_number_of_days_left = $guard->the_number_of_days_left - 1;
                $guard->save();
            }
        }
        return Command::SUCCESS;
    }
}
