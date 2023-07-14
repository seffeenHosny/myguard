<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkNature;
class WorkNatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkNature::create(['nature_ar'=>'اخري' , 'nature_en'=>'other']);
    }
}
