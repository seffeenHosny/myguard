<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Holiday::create(['day_ar'=>'السبت' , 'day_en'=>'Saturday']);
        Holiday::create(['day_ar'=>'الأحد' , 'day_en'=>'Sunday']);
        Holiday::create(['day_ar'=>'الاثنين' , 'day_en'=>'Monday']);
        Holiday::create(['day_ar'=>'الثلاثاء' , 'day_en'=>'Tuesday']);
        Holiday::create(['day_ar'=>'الأربعاء' , 'day_en'=>'Wednesday']);
        Holiday::create(['day_ar'=>'الخميس' , 'day_en'=>'Thursday']);
        Holiday::create(['day_ar'=>'الجمعة' , 'day_en'=>'Friday']);
    }
}
