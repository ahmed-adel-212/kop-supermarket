<?php

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Area;

class CitiesAndAreasTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        // FIXME: find other solution
        ini_set('memory_limit', '-1');

        $citiesJson = file_get_contents(__DIR__."/database/cities.json");
        $citiesJsonData = json_decode($citiesJson);
        $areasJson = file_get_contents(__DIR__."/database/districts.json");
        $areasJsonData = json_decode($areasJson);

        foreach($citiesJsonData as $city) {
            City::create([
                "id" => $city->city_id,
                "name_ar" => $city->name_ar,
                "name_en" => $city->name_en,
                "description_ar" => "",
                "description_en" => "",
            ]);
        }


        foreach($areasJsonData as $area) {

            Area::create([
                "id" => $area->district_id,
                "city_id" => $area->city_id,
                "name_ar" => $area->name_ar,
                "name_en" => $area->name_en,
                "description_ar" => $area->district_id,
                "description_en" => $area->district_id,
                "delivery_fees" => $area->district_id,
                "min_delivery_ammount" => $area->district_id,
            ]);
        }

    }
}
