<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Api\FrontController;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function AllBlogs(){
        $latest = News::latest()->limit(4)->get();
        $return = (app(FrontController::class)->getAllNews())->getOriginalContent();
        foreach ($return as $in => $re){
            if($in == 'data'){
                $articles = $re ;
                return view('website.page-blog',compact(['articles', 'latest']));
            }
        }
    }
    public function Blog($id){
        $latest = News::latest()->limit(4)->get();
        $return = (app(FrontController::class)->getNew($id))->getOriginalContent();
        foreach ($return as $in => $re){
            if($in == 'data'){
                $article = $re;
                return view('website.page-blog-article',compact(['article', 'latest']));
            }
        }
    }

}
