<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Api\FrontController;
use App\Http\Controllers\Controller;

class HealthInfo extends Controller
{
    public function Infos(){
        $return = (app(FrontController::class)->getAllHealthInfo())->getOriginalContent();
        foreach ($return as $in => $re){
            if($in == 'data'){
                $infos = $re ;
                return view('website.page-health-info',compact(['infos']));
            }
        }
    }


}
