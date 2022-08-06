@extends('layouts.website.app')

@section('title') Page blog @endsection

@section('styles')
    <style>
        body.dm-light .article-intro__body {
            border: 1px solid #d6d6d6;
        }
        div.article-intro__body:hover{
            border: 1px solid #888585;
        }
        .article-full__body, .article-intro__body {
            padding: 15px 30px 40px;
            border-top: none !important;
        }
        .line-clamp2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp5 {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
@section('pageName')
    <body class="page-blog dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url({{asset('website-assets/img/pages/contacts/latest.jpg')}}"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">{{__('general.Latest News')}}</h2>
                            <div class="first-screen__breadcrumb">
                                <ul class="uk-breadcrumb">
                                    <li><a href="/">{{__('menu.Home')}}</a></li>
                                    <li><span>{{__('general.News Blog')}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                @if(isset($articles))
                <div class="uk-margin-large-top uk-container text-center d-flex row m-auto">
                @foreach($articles as $article)
                    <article class="col-md-4 col-sm-12 article-intro m-0 mt-3">
                        <div class="article-intro__image">
                            <a href="{{route('get.new',$article->id)}}">
                                <img style="height:262px;" src="{{$article->image}}" alt="img-article">
                            </a>
                        </div>
                        <div class="article-intro__body" style="height:370px;">
                            <h2 class="article-intro__title line-clamp2">{{$article['title_'.app()->getLocale()]}}</h2>
                            <div class="article-intro__info justify-content-center">
                                <div class="article-intro__date">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>{{$article->created_at}}</span>
                                </div>
                            </div>
                            <div class="article-intro__content">
                                <div class="line-clamp5"> {{$article['description_'.app()->getLocale()]}} </div>
                            </div>
                            <div class="article-intro__bottom row justify-content-center">
                                <div class="article-intro__more align-self-center">
                                    <a class="uk-button" href="{{route('get.new',$article->id)}}">
                                        {{__('general.More')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
                </div>
                {{$articles->links()}}
                @endif
            </div>
        </main>
@endsection

@section('scripts')@endsection

