<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Api\FrontController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Gallery;

class AboutUSController extends Controller
{
    public function aboutUSPage(){
        // $return = (app(FrontController::class)->getAboutUS())->getOriginalContent();
        // foreach ($return as $in => $re){
        //     if($in == 'data'){
        //         $about = (count($re))?$re[0]:'';
        //         return view('website.aboutUS',compact(['about']));
        //     }
        // }

        $sections = AboutUs::all();
        // $galleries = Gallery::limit(6)->get();

        return view('website.aboutUS',compact(['sections']));
    }
}
