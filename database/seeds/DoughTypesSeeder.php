<?php

use App\Models\DoughType;
use Illuminate\Database\Seeder;

class DoughTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doughTypes = [
            ['dough_type_id' => 1, 'name_ar' => 'بر', 'name_en' => 'Borr'],
            ['dough_type_id' => 1, 'name_ar' => 'عادي', 'name_en' => 'Normal'],
            ['dough_type_id' => 2, 'name_ar' => 'سميكه', 'name_en' => 'Thick'],
            ['dough_type_id' => 2, 'name_ar' => 'رقيقة', 'name_en' => 'Thin'],
        ];

        foreach ($doughTypes as $doughType) {

            DoughType::create($doughType);

        }//end of for each

    }//end of run

}
