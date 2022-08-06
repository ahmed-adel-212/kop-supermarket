<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Api\FrontController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUSController extends Controller
{
    public function aboutUSPage(){
        $return = (app(FrontController::class)->getAboutUS())->getOriginalContent();
        foreach ($return as $in => $re){
            if($in == 'data'){
                $about = (count($re))?$re[0]:'';
                return view('website.aboutUS',compact(['about']));
            }
        }
    }
}
