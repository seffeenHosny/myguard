<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JopType;
class JopTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JopType::create(['name_ar'=>'حارس أمن' , 'name_en'=>'security guard']);
        JopType::create(['name_ar'=>'منظم' , 'name_en'=>'organizer']);
        JopType::create(['name_ar'=>'متطوع' , 'name_en'=>'volunteer']);
    }
}
