@extends('layouts.website.app')

@section('title') Careers @endsection

@section('styles')@endsection

@section('pageName')
    <body class="page-home dm-dark"> @endsection

    @section('content')
        <main class="page-main">
            <div class="section-first-screen">
                <div class="first-screen__bg"
                     style="background-image: url({{asset('website-assets/img/pages/contacts/career.jpg')}})"></div>
                <div class="first-screen__content">
                    <div class="uk-container">
                        <div class="first-screen__box">
                            <h2 class="first-screen__title">{{__('general.Careers')}}</h2>
                            <div class="first-screen__breadcrumb">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <div class="uk-section uk-container uk-container-small">
                    @if(Session::has('success'))
                        <div class="row mr-2 ml-2">
                            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"
                                    id="type-error">{{Session::get('success')}}
                            </button>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="row mr-2 ml-2" >
                            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                    id="type-error">{{Session::get('error')}}
                            </button>
                        </div>
                    @endif
                    @if(isset($jobs))
                        @foreach($jobs as $job)
                            <!--<div class="article-full__info"></div>-->
                            <!--<div class="article-full__content">-->
                            <!--    <article class="article-intro">-->
                            <!--        <div class="article-intro__body">-->
                            <!--            <div class="article-intro__info">-->
                            <!--                <div class="article-intro__date"><i-->
                            <!--                        class="fas fa-calendar-alt"></i><span>{{$job->created_at}}</span>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--            <h2 class="article-intro__title">{{$job['title_'.app()->getLocale()]}}</h2>-->
                            <!--            <div class="article-intro__content">-->
                            <!--                <div> {{$job['brief_description_'.app()->getLocale()]}} </div>-->
                            <!--            </div>-->
                            <!--            <div class="article-intro__bottom row justify-content-center">-->
                            <!--                <div class="article-intro__more">-->
                            <!--                    <a class="uk-button" href="{{route('get.career',$job->id)}}">{{__('contact_us.Read More')}}</a></div>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </article>-->
                            <!--</div>-->
                            <!--<div class="card">-->
                            <!--    <div class="card-body">-->
                            <!--        <div class="row">-->
                            <!--            <div class="col-3">-->
                            <!--                <img src="{{asset('website-assets/img/logokop.bmp')}}">-->
                            <!--            </div>-->
                            <!--            <div class="col-9">-->
                            <!--                <h4>{{$job['title_'.app()->getLocale()]}}</h4>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--        <div class="row">-->
                            <!--            <div class="col-12">-->
                            <!--                {{$job->created_at}}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--        <div class="row">-->
                            <!--            <div class="col-12">-->
                            <!--                {{$job['brief_description_'.app()->getLocale()]}}-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="article-full__info">
                                <h2 class="article-intro__title">{{$job['title_'.app()->getLocale()]}}</h2>
                            </div>
                            <div class="article-full__content">
                                <article class="article-intro">
                                    <div class="article-intro__body">
                                        <div class="article-intro__info">
                                            <div class="article-intro__date"><i
                                                    class="fas fa-calendar-alt"></i><span>{{$job->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="article-intro__content">
                                            <div> {{$job['brief_description_'.app()->getLocale()]}} </div>
                                        </div>
                                        <div class="article-intro__bottom row justify-content-center">
                                            <div class="article-intro__more">
                                                <a class="uk-button" href="{{route('get.career',$job->id)}}">{{__('contact_us.Read More')}}</a></div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </main>
@endsection

@section('scripts')

@endsection

