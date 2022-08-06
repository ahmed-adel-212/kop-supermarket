<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Api\FrontController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function videoPage($videoID = null){
        $return = (app(FrontController::class)->getVideo($videoID))->getOriginalContent();
        foreach ($return as $in => $re){
            if($in == 'data'){
                $videos = $re;
                return view('website.video',compact(['videos']));
            }
        }

    }
}
