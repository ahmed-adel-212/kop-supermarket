<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                "name_ar" => "",
                "name_en" => "Solasia",
                "description_ar" => '',
                "description_en" => ''
            ],
            [
                "name_ar" => "",
                "name_en" => "Mubraz",
                "description_ar" => '',
                "description_en" => ''
            ],
            [
                "name_ar" => "",
                "name_en" => "Nakhil",
                "description_ar" => '',
                "description_en" => ''
            ],
            [
                "name_ar" => "",
                "name_en" => "Steen",
                "description_ar" => '',
                "description_en" => ''
            ]
        ];

        foreach ($cities as $city) {
            City::firstOrCreate($city);
        }
    }
}
