<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Api\FrontController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function galleryPage(){
        $return = (app(FrontController::class)->getGallery())->getOriginalContent();
        foreach ($return as $in => $re){
            if($in == 'data'){
                $galleries = $re;
                return view('website.gallery',compact(['galleries']));
            }
        }
    }
}
